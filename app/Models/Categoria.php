<?php

class Categoria extends Model
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getCategorias()
    {
        $this->db->query('SELECT * FROM categoría');
        return $this->db->resultSet();
    }

    public function createCategoria($data)
    {
        $this->db->query('INSERT INTO categoría (nombre) VALUES (:nombre)');
        $this->db->bind(':nombre', $data['nombre']);
        return $this->db->execute();
    }

    public function getCategoriaById($id)
    {
        $this->db->query('SELECT * FROM categoría WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateCategoria($data)
    {
        $this->db->query('UPDATE categoría SET nombre = :nombre WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        return $this->db->execute();
    }

    public function deleteCategoria($id)
    {
        $this->db->query('DELETE FROM categoría WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function categoriasCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM categoría');
        $result = $this->db->single();
        return $result['count'];
    }
}
