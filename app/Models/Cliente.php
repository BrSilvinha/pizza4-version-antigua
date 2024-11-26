<?php
class Cliente extends Model
{
    public function getAllclientes()
    {
        try {
            $this->db->query('SELECT c.id, p.nombre, p.email, p.telefono, p.direccion, p.dni 
                             FROM clientes c
                             JOIN personas p ON c.persona_id = p.id');
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log("Error en getAllClientes: " . $e->getMessage());
            return false;
        }
    }

    public function createCliente($data)
    {
        try {
            // Iniciar transacción
            $this->db->beginTransaction();

            // Insertar persona
            $this->db->query('INSERT INTO personas (nombre, email, telefono, direccion, dni) 
                             VALUES (:nombre, :email, :telefono, :direccion, :dni)');
            
            $this->db->bind(':nombre', $data['nombre']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':telefono', $data['telefono']);
            $this->db->bind(':direccion', $data['direccion']);
            $this->db->bind(':dni', $data['dni']);

            if (!$this->db->execute()) {
                throw new Exception("Error al insertar persona");
            }

            $personaId = $this->db->lastInsertId();

            // Insertar cliente
            $this->db->query('INSERT INTO clientes (persona_id) VALUES (:persona_id)');
            $this->db->bind(':persona_id', $personaId);

            if (!$this->db->execute()) {
                throw new Exception("Error al insertar cliente");
            }

            // Confirmar transacción
            $this->db->commit();
            return $personaId;

        } catch (Exception $e) {
            // Revertir cambios en caso de error
            $this->db->rollBack();
            error_log("Error en createCliente: " . $e->getMessage());
            return false;
        }
    }

    public function getClienteById($id)
    {
        try {
            $this->db->query('SELECT c.id, p.nombre, p.telefono, p.direccion, p.email, p.dni 
                             FROM clientes c 
                             JOIN personas p ON c.persona_id = p.id 
                             WHERE c.id = :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        } catch (Exception $e) {
            error_log("Error en getClienteById: " . $e->getMessage());
            return false;
        }
    }

    public function countClientes()
    {
        try {
            $this->db->query('SELECT COUNT(*) as count FROM clientes');
            $result = $this->db->single();
            return isset($result['count']) ? $result['count'] : 0;
        } catch (Exception $e) {
            error_log("Error en countClientes: " . $e->getMessage());
            return 0;
        }
    }

    public function updateCliente($data)
    {
        try {
            $this->db->query('UPDATE personas p
                             INNER JOIN clientes c ON p.id = c.persona_id
                             SET p.nombre = :nombre, 
                                 p.email = :email, 
                                 p.telefono = :telefono, 
                                 p.direccion = :direccion,
                                 p.dni = :dni
                             WHERE c.id = :id');

            $this->db->bind(':nombre', $data['nombre']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':telefono', $data['telefono']);
            $this->db->bind(':direccion', $data['direccion']);
            $this->db->bind(':dni', $data['dni']);
            $this->db->bind(':id', $data['id']);

            $result = $this->db->execute();
            
            if ($result) {
                error_log('Actualización exitosa para el cliente ID: ' . $data['id']);
            } else {
                error_log('Error al actualizar el cliente ID: ' . $data['id']);
            }

            return $result;

        } catch (Exception $e) {
            error_log("Error en updateCliente: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCliente($id)
    {
        try {
            // Primero verificar si el cliente tiene pedidos
            $this->db->query('SELECT COUNT(*) as count FROM pedidoscomanda WHERE cliente_id = :id');
            $this->db->bind(':id', $id);
            $result = $this->db->single();

            if ($result['count'] > 0) {
                throw new Exception("No se puede eliminar el cliente porque tiene pedidos asociados");
            }

            // Iniciar transacción
            $this->db->beginTransaction();

            // Obtener el persona_id
            $this->db->query('SELECT persona_id FROM clientes WHERE id = :id');
            $this->db->bind(':id', $id);
            $cliente = $this->db->single();

            if (!$cliente) {
                throw new Exception("Cliente no encontrado");
            }

            // Eliminar cliente
            $this->db->query('DELETE FROM clientes WHERE id = :id');
            $this->db->bind(':id', $id);
            
            if (!$this->db->execute()) {
                throw new Exception("Error al eliminar cliente");
            }

            // Eliminar persona
            $this->db->query('DELETE FROM personas WHERE id = :persona_id');
            $this->db->bind(':persona_id', $cliente['persona_id']);
            
            if (!$this->db->execute()) {
                throw new Exception("Error al eliminar persona");
            }

            // Confirmar transacción
            $this->db->commit();
            return true;

        } catch (Exception $e) {
            // Revertir cambios en caso de error
            $this->db->rollBack();
            error_log("Error en deleteCliente: " . $e->getMessage());
            return false;
        }
    }
}