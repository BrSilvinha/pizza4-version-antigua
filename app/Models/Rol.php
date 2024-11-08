<?php

class Rol extends Model
{
    public function getAllRoles()
    {
        $this->db->query('SELECT * FROM roles');
        return $this->db->resultSet();
    }
    // crear un rol
    public function createRol($nombre)
    {
        $this->db->query('INSERT INTO roles (nombre) VALUES (:nombre)');
        $this->db->bind(':nombre', $nombre);
        $this->db->execute();
    }
    public function getRolById($id)
    {
        $this->db->query('SELECT * FROM roles WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function contadorDeRoles()
    {
        $this->db->query('SELECT COUNT(*) as total FROM roles');
        return $this->db->single()['total'];
    }
    public function updateRol($id, $nombre)
    {
        $this->db->query('UPDATE roles SET nombre = :nombre WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':nombre', $nombre);
        $this->db->execute();
    }
    public function deleteRol($id)
    {
        $this->db->query('DELETE FROM roles WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
