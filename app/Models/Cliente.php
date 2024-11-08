<?php
class Cliente extends Model
{
    public function getAllclientes()
    {
        $this->db->query('SELECT clientes.id, personas.nombre, personas.email, personas.telefono, personas.direccion ,personas.dni FROM clientes 
                          JOIN personas ON clientes.persona_id = personas.id');
        return $this->db->resultSet();
    }

    public function createCliente($data)
    {
        $this->db->query('INSERT INTO personas (nombre, email, telefono, direccion, dni) VALUES (:nombre, :email, :telefono, :direccion, :dni)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':dni', $data['dni']);
        if ($this->db->execute()) {
            $personaId = $this->db->lastInsertId();
            $this->db->query('INSERT INTO clientes (persona_id) VALUES (:persona_id)');
            $this->db->bind(':persona_id', $personaId);
            if ($this->db->execute()) {
                return $personaId;  // Retornamos el ID de la persona/cliente
            }
        }
        return false;
    }

    public function getClienteById($id)
    {

        $this->db->query('SELECT clientes.id , personas.nombre , personas.telefono ,personas.direccion ,personas.email ,personas.dni FROM clientes JOIN personas ON clientes.persona_id = personas.id 
        WHERE clientes.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function countClientes()
    {
        $this->db->query('SELECT COUNT(*) as count FROM clientes');
        return $this->db->single()['count'];
    }

    public function updateCliente($data)
    {

        $this->db->query('UPDATE personas SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion ,dni = :dni
         WHERE id = (SELECT persona_id FROM clientes WHERE id = :id)
    ');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':dni', $data['dni']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            error_log('Actualización exitosa para el cliente ID: ' . $data['id']);
            return true;
        } else {
            error_log('Error al actualizar el cliente ID: ' . $data['id']);
            return false;
        }
    }


    public function deleteCliente($id)
    {
        $this->db->query('DELETE FROM clientes WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
