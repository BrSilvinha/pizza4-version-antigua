<?php

class ListRoles extends Model
{
    public function assignRole($usuarioId, $rolId)
    {
        $this->db->query('INSERT INTO listroles (usuario_id, rol_id, fecha_inicio) VALUES (:usuario_id, :rol_id, NOW())');
        $this->db->bind(':usuario_id', $usuarioId);
        $this->db->bind(':rol_id', $rolId);
        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al asignar el rol");
        }
    }
    public function deleteRolesByUsuarioId($usuarioId)
    {
        $this->db->query('DELETE FROM listroles WHERE usuario_id = :usuario_id');
        $this->db->bind(':usuario_id', $usuarioId);
        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al eliminar roles del usuario");
        }
    }
    public function rolesCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM listroles');
        return $this->db->single()['count'];
    }

    public function updateRole($usuarioId, $rolId)
    {
        $this->db->query('UPDATE listroles SET rol_id = :rol_id WHERE usuario_id = :usuario_id');
        $this->db->bind(':usuario_id', $usuarioId);
        $this->db->bind(':rol_id', $rolId);

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al actualizar el rol del usuario");
        }
    }
}
