<?php

class Sede extends Model
{
    public function getAllSedes()
    {
        $this->db->query('SELECT * FROM sede');
        return $this->db->resultSet();
    }

    public function countSedes()
    {
        $this->db->query('SELECT COUNT(*) as count FROM sede');
        $row = $this->db->single();
        return $row['count'];  // Ajuste: Asegurarse de devolver el valor correcto del array.
    }

    public function createSede($data)
    {
        $this->db->query('INSERT INTO sede (nombre, direccion) VALUES (:nombre, :direccion)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':direccion', $data['direccion']);
        return $this->db->execute();
    }

    // mostrar los datos de la sede
    public function getSedeById($id)
    {
        $this->db->query('SELECT * FROM sede WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
