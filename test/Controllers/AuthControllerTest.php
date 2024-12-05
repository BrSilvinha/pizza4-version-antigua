<?php

use PHPUnit\Framework\TestCase;

/**
 * Clase de pruebas para el controlador de autenticación
 * Esta clase verifica el funcionamiento correcto del proceso de inicio de sesión
 */
class AuthControllerTest extends TestCase
{
    private $authController;
    private $db;
    
    /**
     * Método que se ejecuta antes de cada prueba
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Definir constantes necesarias para el entorno de pruebas
        if (!defined('TESTING')) {
            define('TESTING', true);
        }
        
        if (!defined('INICIO')) define('INICIO', '/home');
        if (!defined('LOGIN')) define('LOGIN', '/login');
        
        // Inicializar array de sesión vacío
        $_SESSION = [];
        
        // Inicializar conexión a base de datos y preparar datos de prueba
        $this->db = new Database();
        $this->cleanDatabase();
        $this->createTestUser();
        
        // Crear instancia del controlador
        $this->authController = new AuthController();
    }
    
    /**
     * Limpia la base de datos antes de las pruebas
     * Desactiva temporalmente las restricciones de claves foráneas para permitir el truncado
     */
    private function cleanDatabase()
    {
        // Desactivar verificación de claves foráneas
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->execute();
        
        // Limpiar tablas
        $this->db->query('TRUNCATE TABLE usuarios');
        $this->db->execute();
        $this->db->query('TRUNCATE TABLE personas');
        $this->db->execute();
        
        // Reactivar verificación de claves foráneas
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        $this->db->execute();
    }
    
    /**
     * Crea un usuario de prueba en la base de datos
     * Este usuario se utilizará para todas las pruebas de autenticación
     */
    private function createTestUser()
    {
        // Insertar datos en la tabla personas
        $this->db->query('INSERT INTO personas (nombre, email, telefono) VALUES (:nombre, :email, :telefono)');
        $this->db->bind(':nombre', 'Test User');
        $this->db->bind(':email', 'test@example.com');
        $this->db->bind(':telefono', '123456789');
        $this->db->execute();
        $personaId = $this->db->lastInsertId();
        
        // Crear contraseña hasheada y guardar usuario
        $hashedPassword = password_hash('test123', PASSWORD_DEFAULT);
        $this->db->query('INSERT INTO usuarios (persona_id, contrasena) VALUES (:persona_id, :contrasena)');
        $this->db->bind(':persona_id', $personaId);
        $this->db->bind(':contrasena', $hashedPassword);
        $this->db->execute();
    }
    
    /**
     * Prueba el escenario de inicio de sesión exitoso
     * Verifica que un usuario válido pueda iniciar sesión correctamente
     * 
     * @test
     * @testdox Verifica inicio de sesión exitoso con credenciales válidas
     */
    public function testLoginWithValidCredentials()
    {
        echo "\nPrueba de inicio de sesión exitoso:";
        
        // Simular datos POST de inicio de sesión
        $_POST = [
            'email' => 'test@example.com',
            'contraseña' => 'test123'
        ];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        // Ejecutar login y verificar redirección
        $result = $this->authController->login();
        $this->assertEquals(INICIO, $result);
        
        // Mostrar mensajes de éxito
        echo "\n✓ Usuario inició sesión correctamente";
        echo "\n✓ Redirigido a la página de inicio (" . INICIO . ")";
        echo "\n✓ Credenciales verificadas exitosamente";
    }
    
    /**
     * Prueba el escenario de contraseña incorrecta
     * Verifica que se maneje adecuadamente el intento de inicio de sesión con contraseña errónea
     * 
     * @test
     * @testdox Verifica que se rechace el inicio de sesión con contraseña incorrecta
     */
    public function testLoginWithInvalidPassword()
    {
        echo "\nPrueba de contraseña inválida:";
        
        // Simular datos POST con contraseña incorrecta
        $_POST = [
            'email' => 'test@example.com',
            'contraseña' => 'wrongpassword'
        ];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        // Ejecutar login y verificar mensaje de error
        $result = $this->authController->login();
        $this->assertEquals('Contraseña incorrecta.', $result);
        
        // Mostrar mensajes de verificación
        echo "\n✓ Se detectó contraseña incorrecta";
        echo "\n✓ Se mostró mensaje de error apropiado";
        echo "\n✓ Se impidió el acceso al sistema";
    }
    
    /**
     * Prueba el límite de intentos de inicio de sesión
     * Verifica que la cuenta se bloquee después de múltiples intentos fallidos
     * 
     * @test
     * @testdox Verifica bloqueo después de múltiples intentos fallidos
     */
    public function testMaxLoginAttempts()
    {
        echo "\nPrueba de máximos intentos de inicio de sesión:";
        
        // Simular datos POST y establecer contador de intentos
        $_POST = [
            'email' => 'test@example.com',
            'contraseña' => 'wrongpassword'
        ];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SESSION['login_attempts'] = 5; // Establecer máximo de intentos
        
        // Ejecutar login y verificar mensaje de bloqueo
        $result = $this->authController->login();
        $this->assertEquals('Demasiados intentos fallidos. Inténtalo más tarde.', $result);
        
        // Mostrar mensajes de verificación
        echo "\n✓ Se detectaron múltiples intentos fallidos";
        echo "\n✓ Se bloqueó el acceso después de 5 intentos";
        echo "\n✓ Se mostró mensaje de bloqueo apropiado";
    }
    
    /**
     * Método que se ejecuta después de cada prueba
     * Limpia el entorno de pruebas para la siguiente ejecución
     */
    protected function tearDown(): void
    {
        // Limpiar base de datos y variables globales
        $this->cleanDatabase();
        $_SESSION = [];
        $_POST = [];
        
        parent::tearDown();
    }
}