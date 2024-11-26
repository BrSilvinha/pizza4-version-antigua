<?php
class Producto extends Model
{
    public function getAllProductos()
    {
        try {
            // Nota que cambiamos 'Categoría' por 'categoría' para que coincida con el nombre en la base de datos
            $this->db->query('SELECT p.id, p.nombre, p.descripcion, p.precio, p.disponible, c.nombre as categoria 
                             FROM productos p 
                             JOIN categoría c ON p.categoria_id = c.id');
            
            $result = $this->db->resultSet();
            
            if ($result === false) {
                throw new Exception("Error al obtener los productos");
            }
            
            return $result;
        } catch (Exception $e) {
            error_log("Error en Producto->getAllProductos: " . $e->getMessage());
            return false;
        }
    }

    public function countProductos()
    {
        try {
            $this->db->query('SELECT COUNT(*) as count FROM productos');
            $result = $this->db->single();
            return isset($result['count']) ? $result['count'] : 0;
        } catch (Exception $e) {
            error_log("Error en Producto->countProductos: " . $e->getMessage());
            return 0;
        }
    }

    public function createProducto($data)
    {
        try {
            $this->db->query('INSERT INTO productos (nombre, descripcion, precio, disponible, categoria_id) 
                             VALUES (:nombre, :descripcion, :precio, :disponible, :categoria_id)');
            
            $this->db->bind(':nombre', $data['nombre']);
            $this->db->bind(':descripcion', $data['descripcion']);
            $this->db->bind(':precio', $data['precio']);
            $this->db->bind(':disponible', $data['disponible']);
            $this->db->bind(':categoria_id', $data['categoria_id']);
            
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error en Producto->createProducto: " . $e->getMessage());
            return false;
        }
    }

    public function getProductoById($id)
    {
        try {
            $this->db->query('SELECT p.*, c.nombre as categoria_nombre 
                             FROM productos p 
                             JOIN categoría c ON p.categoria_id = c.id 
                             WHERE p.id = :id');
            
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            
            if ($result === false) {
                throw new Exception("Producto no encontrado");
            }
            
            return $result;
        } catch (Exception $e) {
            error_log("Error en Producto->getProductoById: " . $e->getMessage());
            return false;
        }
    }

    public function updateProducto($data)
    {
        try {
            $this->db->query('UPDATE productos 
                             SET nombre = :nombre, 
                                 descripcion = :descripcion, 
                                 precio = :precio, 
                                 disponible = :disponible, 
                                 categoria_id = :categoria_id 
                             WHERE id = :id');
            
            $this->db->bind(':nombre', $data['nombre']);
            $this->db->bind(':descripcion', $data['descripcion']);
            $this->db->bind(':precio', $data['precio']);
            $this->db->bind(':disponible', $data['disponible']);
            $this->db->bind(':categoria_id', $data['categoria_id']);
            $this->db->bind(':id', $data['id']);
            
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error en Producto->updateProducto: " . $e->getMessage());
            return false;
        }
    }

    public function deleteProducto($id)
    {
        try {
            // Primero verificar si hay registros relacionados en detallespedido
            $this->db->query('SELECT COUNT(*) as count FROM detallespedido WHERE producto_id = :id');
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            
            if ($result['count'] > 0) {
                throw new Exception("No se puede eliminar el producto porque tiene pedidos asociados");
            }

            $this->db->query('DELETE FROM productos WHERE id = :id');
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("Error en Producto->deleteProducto: " . $e->getMessage());
            return false;
        }
    }
}