<?php

require_once __DIR__ . '/../../config/config.php';
class CategoriaTest extends \PHPUnit\Framework\TestCase
{
    private $categoria;
    private $dbMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear un mock de la clase Database
        $this->dbMock = $this->getMockBuilder('Database')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        // Crear instancia de Categoria con el mock de Database
        $this->categoria = new Categoria($this->dbMock);
    }

    public function test_get_categorias_returns_array()
    {
        $expectedData = [
            ['id' => 1, 'nombre' => 'Pizzas'],
            ['id' => 2, 'nombre' => 'Bebidas']
        ];

        $this->dbMock->expects($this->once())
             ->method('query')
             ->with('SELECT * FROM categoría');

        $this->dbMock->expects($this->once())
             ->method('resultSet')
             ->willReturn($expectedData);

        $result = $this->categoria->getCategorias();

        $this->assertIsArray($result);
        $this->assertEquals($expectedData, $result);
    }

    public function test_create_categoria_successful()
    {
        $data = ['nombre' => 'Nueva Categoría'];

        $this->dbMock->expects($this->once())
             ->method('query')
             ->with('INSERT INTO categoría (nombre) VALUES (:nombre)');

        $this->dbMock->expects($this->once())
             ->method('bind')
             ->with(':nombre', $data['nombre']);

        $this->dbMock->expects($this->once())
             ->method('execute')
             ->willReturn(true);

        $result = $this->categoria->createCategoria($data);

        $this->assertTrue($result);
    }

    public function test_get_categoria_by_id_returns_correct_data()
    {
        $id = 1;
        $expectedData = ['id' => 1, 'nombre' => 'Pizzas'];

        $this->dbMock->expects($this->once())
             ->method('query')
             ->with('SELECT * FROM categoría WHERE id = :id');

        $this->dbMock->expects($this->once())
             ->method('bind')
             ->with(':id', $id);

        $this->dbMock->expects($this->once())
             ->method('single')
             ->willReturn($expectedData);

        $result = $this->categoria->getCategoriaById($id);

        $this->assertEquals($expectedData, $result);
    }
}