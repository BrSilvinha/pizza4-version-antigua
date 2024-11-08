<?php
class Usuario extends Model
{
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM usuarios JOIN personas ON usuarios.persona_id = personas.id WHERE personas.email = :email');
        $this->db->bind(':email', $email);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function login($email, $contrasena)
    {
        $this->db->query('SELECT usuarios.id, personas.nombre, personas.email, usuarios.contrasena FROM usuarios 
                          JOIN personas ON usuarios.persona_id = personas.id 
                          WHERE personas.email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($row && password_verify($contrasena, $row['contrasena'])) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUsuarios()
    {
        $this->db->query('
            SELECT 
                u.id, 
                p.nombre, 
                p.email, 
                p.telefono, 
                GROUP_CONCAT(r.nombre SEPARATOR ", ") AS roles
            FROM 
                usuarios u 
            JOIN 
                personas p ON u.persona_id = p.id
            LEFT JOIN 
                listroles lr ON u.id = lr.usuario_id
            LEFT JOIN 
                roles r ON lr.rol_id = r.id
            GROUP BY 
                u.id, p.nombre, p.email, p.telefono
        ');
        return $this->db->resultSet();
    }


    public function getAllUsuarios()
    {
        $this->db->query('SELECT u.id, p.nombre FROM usuarios u JOIN personas p ON u.persona_id = p.id');
        return $this->db->resultSet();
    }

    public function countUsuarios()
    {
        $this->db->query('SELECT COUNT(*) as count FROM usuarios');
        return $this->db->single()['count'];
    }

    public function createUsuario($data)
    {
        $this->db->query('INSERT INTO usuarios (persona_id, contrasena) VALUES (:persona_id, :contrasena)');
        $this->db->bind(':persona_id', $data['persona_id']);
        $this->db->bind(':contrasena', $data['contrasena']);
        $this->db->execute();

        return $this->db->lastInsertId(); // Devuelve el ID del nuevo usuario
    }

    public function getUsuarioById($id)
    {
        $this->db->query("
                SELECT 
                u.id, 
                p.nombre, 
                p.email, 
                p.telefono, 
                p.direccion,
                p.dni,
                IFNULL(GROUP_CONCAT(DISTINCT r.nombre SEPARATOR ', '), 'No roles') AS roles,
                GROUP_CONCAT(DISTINCT lr.id SEPARATOR ', ') AS rol_id
            FROM 
                usuarios u 
            JOIN 
                personas p ON u.persona_id = p.id 
            LEFT JOIN 
                listroles lr ON u.id = lr.usuario_id
            LEFT JOIN 
                roles r ON lr.rol_id = r.id
            WHERE 
                u.id = :id
            GROUP BY 
            u.id, p.nombre, p.email, p.telefono, p.direccion;");$this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getRolesUsuarioAutenticado($userId)
    {
        $this->db->query('
        SELECT 
            IFNULL(GROUP_CONCAT(r.nombre SEPARATOR ", "), "No roles") AS roles 
        FROM 
            usuarios u 
        LEFT JOIN 
            listroles lr ON u.id = lr.usuario_id
        LEFT JOIN 
            roles r ON lr.rol_id = r.id
        WHERE 
            u.id = :id');
        $this->db->bind(':id', $userId);
        $result = $this->db->single();

        return $result ? $result['roles'] : ['error' => 'No roles found for this user'];
    }

    public function getPersonaIdByUsuarioId($usuarioId)
    {
        $this->db->query('SELECT persona_id FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $usuarioId);
        return $this->db->single()['persona_id'];
    }

    public function updateUsuario($data)
    {
        $this->db->query('UPDATE personas SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion 
        WHERE id = (SELECT persona_id FROM usuarios WHERE id = :id)');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        return $this->db->execute();
    }

    public function updateUsuarioContrasenia($data)
    {
        $this->db->query('UPDATE usuarios SET contrasena = IFNULL(:contrasena, contrasena) WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':contrasena', $data['contrasena']);

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al actualizar el usuario");
        }
    }

    public function deleteUsuario($id)
    {
        $this->db->query('DELETE FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
