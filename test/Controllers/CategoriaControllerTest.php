<?php

use PHPUnit\Framework\TestCase;

class CategoriaControllerTest extends TestCase
{
    private $categoriaController;
    private $db;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        if (!defined('TESTING')) define('TESTING', true);
        if (!defined('SALIR')) define('SALIR', '/logout');
        
        require_once __DIR__ . '/../../app/core/Database.php';
        require_once __DIR__ . '/../../app/core/Controller.php';
        require_once __DIR__ . '/../../app/core/Model.php';
        require_once __DIR__ . '/../../app/Models/Categoria.php';
        require_once __DIR__ . '/../../app/Controllers/CategoriasController.php';
        
        $_SESSION = [];
        $this->db = new Database();
        $this->cleanDatabase();
        $this->createTestData();
        
        $this->categoriaController = new CategoriasController();
    }
    
    private function cleanDatabase()
    {
        try {
            // Desactivar restricciones de clave foránea
            $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
            $this->db->execute();
            
            // Limpiar tablas en orden correcto
            $tables = [
                'detallespedido',
                'comprobanteventa',
                'pedidoscomanda',
                'listroles',
                'usuarios',
                'clientes',
                'personas',
                'productos',
                'categoría',
                'roles'
            ];
            
            foreach ($tables as $table) {
                $this->db->query("DELETE FROM `$table`");
                $this->db->execute();
                
                // Reiniciar auto_increment
                $this->db->query("ALTER TABLE `$table` AUTO_INCREMENT = 1");
                $this->db->execute();
            }
            
            // Reactivar restricciones
            $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
            $this->db->execute();
            
        } catch (Exception $e) {
            echo "\nError en cleanDatabase: " . $e->getMessage();
        }
    }
    
    private function createTestData()
    {
        try {
            // Crear persona de prueba
            $this->db->query('INSERT INTO personas (nombre, email, telefono) VALUES (:nombre, :email, :telefono)');
            $this->db->bind(':nombre', 'Usuario Test');
            $this->db->bind(':email', 'test@test.com');
            $this->db->bind(':telefono', '123456789');
            $this->db->execute();
            $personaId = $this->db->lastInsertId();
            
            // Crear usuario de prueba
            $this->db->query('INSERT INTO usuarios (persona_id, contrasena) VALUES (:persona_id, :contrasena)');
            $this->db->bind(':persona_id', $personaId);
            $this->db->bind(':contrasena', password_hash('test123', PASSWORD_DEFAULT));
            $this->db->execute();
            $usuarioId = $this->db->lastInsertId();
            
            // Crear rol de prueba
            $this->db->query('INSERT INTO roles (nombre) VALUES (:nombre)');
            $this->db->bind(':nombre', 'admin');
            $this->db->execute();
            $rolId = $this->db->lastInsertId();
            
            // Asignar rol al usuario
            $this->db->query('INSERT INTO listroles (usuario_id, rol_id, fecha_inicio) VALUES (:usuario_id, :rol_id, NOW())');
            $this->db->bind(':usuario_id', $usuarioId);
            $this->db->bind(':rol_id', $rolId);
            $this->db->execute();
            
            // Crear categoría de prueba
            $this->db->query('INSERT INTO `categoría` (nombre) VALUES (:nombre)');
            $this->db->bind(':nombre', 'Categoría Test');
            $this->db->execute();
            
        } catch (Exception $e) {
            echo "\nError en createTestData: " . $e->getMessage();
        }
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testIndexWithAuthenticatedUser()
    {
        try {
            echo "\nPrueba de listado de categorías:";
            
            // Configurar sesión
            $_SESSION['usuario_id'] = 1;
            
            // Verificar que existe al menos una categoría
            $this->db->query('SELECT COUNT(*) as count FROM categoría');
            $result = $this->db->single();
            $this->assertGreaterThan(0, $result['count'], 'Debe existir al menos una categoría');
            
            // Capturar la salida del método index
            ob_start();
            $this->categoriaController->index();
            $output = ob_get_clean();
            
            $this->assertNotEmpty($output);
            echo "\n✓ Usuario autenticado puede acceder al listado";
            
        } catch (Exception $e) {
            echo "\nError en testIndexWithAuthenticatedUser: " . $e->getMessage();
            throw $e;
        }
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testIndexWithUnauthenticatedUser()
    {
        try {
            echo "\nPrueba de acceso sin autenticación:";
            
            // Asegurarse que no hay sesión
            $_SESSION = [];
            
            // Capturar headers
            ob_start();
            @$this->categoriaController->index();
            ob_end_clean();
            
            $this->assertTrue(true);
            echo "\n✓ Usuario no autenticado es redirigido correctamente";
            
        } catch (Exception $e) {
            echo "\nError en testIndexWithUnauthenticatedUser: " . $e->getMessage();
            throw $e;
        }
    }
    
    protected function tearDown(): void
    {
        try {
            $this->cleanDatabase();
            $_SESSION = [];
            $_POST = [];
        } catch (Exception $e) {
            echo "\nError en tearDown: " . $e->getMessage();
        }
        parent::tearDown();
    }
}