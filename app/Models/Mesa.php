<?php

class Mesa extends Model
{
    public function getmesas()
    {
        $this->db->query('SELECT m.id, p.nombre as piso, m.numero, m.capacidad FROM mesas m JOIN piso p ON m.piso_id = p.id');
        return $this->db->resultSet();
    }


    public function createMesa($data)
    {
        $this->db->query('INSERT INTO mesas (piso_id, numero, capacidad) VALUES (:piso_id, :numero, :capacidad)');
        $this->db->bind(':piso_id', $data['piso_id']);
        $this->db->bind(':numero', $data['numero']);
        $this->db->bind(':capacidad', $data['capacidad']);
        return $this->db->execute();
    }

    public function getMesaById($id)
    {
        $this->db->query('SELECT mesas.id, mesas.piso_id, mesas.numero, mesas.capacidad, piso.nombre AS nombre_piso FROM mesas AS mesas JOIN piso AS piso ON mesas.piso_id = piso.id WHERE mesas.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function getMesasByPisoId($piso_id)
    {
        $this->db->query('SELECT mesas.id, mesas.piso_id, mesas.numero, mesas.capacidad, piso.nombre AS nombre_piso FROM mesas AS mesas JOIN piso AS piso ON mesas.piso_id = piso.id WHERE mesas.piso_id = :piso_id');
        $this->db->bind(':piso_id', $piso_id);
        return $this->db->resultSet();
    }


    public function mesasCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM mesas');
        return $this->db->single()['count'];
    }
    public function getmesasByPiso($piso_id)
    {
        $this->db->query('SELECT m.id, m.numero, m.capacidad, m.estado FROM mesas m WHERE m.piso_id = :piso_id');
        $this->db->bind(':piso_id', $piso_id);
        return $this->db->resultSet();
    }
    public function mesaEstado($id)
    {
        $this->db->query('SELECT estado FROM mesas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single()['estado'];
    }

    public function updateEstado($id, $estado)
    {
        $this->db->query('UPDATE mesas SET estado = :estado WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':estado', $estado);
        return $this->db->execute();
    }


    public function updateMesa($data)
    {
        $this->db->query('UPDATE mesas SET piso_id = :piso_id, numero = :numero, capacidad = :capacidad WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':piso_id', $data['piso_id']);
        $this->db->bind(':numero', $data['numero']);
        $this->db->bind(':capacidad', $data['capacidad']);
        return $this->db->execute();
    }

    public function deleteMesa($id)
    {
        $this->db->query('DELETE FROM mesas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
