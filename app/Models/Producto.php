<?php
class Producto extends Model
{

    public function getAllProductos()
    {
        $this->db->query('SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, productos.disponible, Categoría.nombre as categoria FROM productos 
                          JOIN Categoría ON productos.categoria_id = Categoría.id');
        return $this->db->resultSet();
    }
    public function countProductos()
    {
        $this->db->query('SELECT COUNT(*) as count FROM productos');
        return $this->db->single()['count'];
    }
    public function createProducto($data)
    {
        $this->db->query('INSERT INTO productos (nombre, descripcion, precio, disponible, categoria_id) VALUES (:nombre, :descripcion, :precio, :disponible, :categoria_id)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':precio', $data['precio']);
        $this->db->bind(':disponible', $data['disponible']);
        $this->db->bind(':categoria_id', $data['categoria_id']);
        return $this->db->execute();
    }

    public function getProductoById($id)
    {
        $this->db->query('SELECT * FROM productos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateProducto($data)
    {
        $this->db->query('UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, disponible = :disponible, categoria_id = :categoria_id WHERE id = :id');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':precio', $data['precio']);
        $this->db->bind(':disponible', $data['disponible']);
        $this->db->bind(':categoria_id', $data['categoria_id']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function deleteProducto($id)
    {
        $this->db->query('DELETE FROM productos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
