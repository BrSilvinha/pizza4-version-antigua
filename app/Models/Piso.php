<?php

class Piso extends Model
{
    public function getPisos()
    {
        $this->db->query('SELECT * FROM piso');
        return $this->db->resultSet();
    }

    public function getPisosWithMesasCount()
    {
        $this->db->query('
            SELECT p.id, p.nombre, COUNT(m.id) as mesas_count
            FROM piso p
            LEFT JOIN mesas m ON p.id = m.piso_id
            GROUP BY p.id, p.nombre
        ');
        return $this->db->resultSet();
    }
    public function pisosCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM piso');
        return $this->db->single()['count'];
    }

    public function createPiso($data)
    {
        $this->db->query('INSERT INTO piso (nombre, sede_id) VALUES (:nombre, :sede_id)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':sede_id', $data['sede_id']);
        return $this->db->execute();
    }

    public function getPisoById($id)
    {
        $this->db->query('SELECT * FROM piso WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePiso($data)
    {
        $this->db->query('UPDATE piso SET nombre = :nombre, sede_id = :sede_id WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':sede_id', $data['sede_id']);
        return $this->db->execute();
    }

    public function deletePiso($id)
    {
        $this->db->query('DELETE FROM piso WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
