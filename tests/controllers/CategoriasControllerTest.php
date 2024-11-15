<?php
require_once __DIR__ . '/../Helpers/SessionMock.php';
use PHPUnit\Framework\TestCase;

class CategoriasControllerTest extends TestCase
{
    private $controller;
    private $categoriaModelMock;
    private $usuarioModelMock;
    private $sessionMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock de Session
        require_once __DIR__ . '/../../app/core/Session.php';
        $this->sessionMock = $this->createMock(Session::class);

        // Mock del modelo Categoria
        $this->categoriaModelMock = $this->createMock(Categoria::class);

        // Mock del modelo Usuario
        $this->usuarioModelMock = $this->createMock(Usuario::class);

        // Crear el controlador
        $this->controller = $this->getMockBuilder(CategoriasController::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['model', 'view'])
            ->getMock();

        // Configurar el mock del método model
        $this->controller->method('model')
            ->will($this->returnValueMap([
                ['Categoria', $this->categoriaModelMock],
                ['Usuario', $this->usuarioModelMock]
            ]));
    }
    public function test_index_redirects_when_not_authenticated()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(null);

        // Act
        ob_start();
        $this->controller->index();
        $output = ob_get_clean();

        // Assert
        $headers = headers_list();
        $this->assertStringContainsString('Location: ' . SALIR, $headers[0]);
    }
    
    public function test_index_shows_categorias_when_authenticated()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(1);

        $categorias = [
            ['id' => 1, 'nombre' => 'Pizzas'],
            ['id' => 2, 'nombre' => 'Bebidas']
        ];

        $rolUsuario = ['id' => 1, 'nombre' => 'admin'];

        $this->categoriaModelMock->expects($this->once())
            ->method('getCategorias')
            ->willReturn($categorias);

        $this->usuarioModelMock->expects($this->once())
            ->method('getRolesUsuarioAutenticado')
            ->with(1)
            ->willReturn($rolUsuario);

        $this->controller->expects($this->once())
            ->method('view')
            ->with(
                'categorias/index',
                ['categorias' => $categorias, 'rolUsuario' => $rolUsuario]
            );

        // Act
        $this->controller->index();
    }

    public function test_create_stores_categoria_successfully()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(1);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nombre'] = 'Nueva Categoría';

        $this->categoriaModelMock->expects($this->once())
            ->method('createCategoria')
            ->with(['nombre' => 'Nueva Categoría'])
            ->willReturn(true);

        // Act
        ob_start();
        $this->controller->create();
        $output = ob_get_clean();

        // Assert
        $this->assertStringContainsString(
            'Location: /PIZZA4/public/categorias?success=',
            headers_list()[0]
        );
    }

    public function test_edit_updates_categoria_successfully()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(1);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nombre'] = 'Categoría Actualizada';
        $id = 1;

        $this->categoriaModelMock->expects($this->once())
            ->method('updateCategoria')
            ->with([
                'id' => $id,
                'nombre' => 'Categoría Actualizada'
            ])
            ->willReturn(true);

        // Act
        ob_start();
        $this->controller->edit($id);
        $output = ob_get_clean();

        // Assert
        $this->assertStringContainsString(
            'Location: /PIZZA4/public/categorias?success=',
            headers_list()[0]
        );
    }

    public function test_edit_shows_form_with_categoria_data()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(1);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $id = 1;
        $categoria = ['id' => 1, 'nombre' => 'Pizzas'];
        $rolUsuario = ['id' => 1, 'nombre' => 'admin'];

        $this->categoriaModelMock->expects($this->once())
            ->method('getCategoriaById')
            ->with($id)
            ->willReturn($categoria);

        $this->usuarioModelMock->expects($this->once())
            ->method('getRolesUsuarioAutenticado')
            ->with(1)
            ->willReturn($rolUsuario);

        $this->controller->expects($this->once())
            ->method('view')
            ->with(
                'categorias/edit',
                ['categoria' => $categoria, 'rolUsuario' => $rolUsuario]
            );

        // Act
        $this->controller->edit($id);
    }

    public function test_delete_removes_categoria_successfully()
    {
        // Arrange
        Session::setMock($this->sessionMock);
        $this->sessionMock->method('get')
            ->with('usuario_id')
            ->willReturn(1);

        $id = 1;

        $this->categoriaModelMock->expects($this->once())
            ->method('deleteCategoria')
            ->with($id)
            ->willReturn(true);

        // Act
        ob_start();
        $this->controller->delete($id);
        $output = ob_get_clean();

        // Assert
        $this->assertStringContainsString(
            'Location: /PIZZA4/public/categorias?success=',
            xdebug_get_headers()[0]
        );
    }
}
