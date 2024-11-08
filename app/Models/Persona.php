<?php

class Persona extends Model
{
    public function create($nombre, $email, $telefono, $direccion, $dni)
    {
        // if ($this->emailExists($email)) {
        //     throw new \Exception("El email ya existe");
        // }
        $this->db->query("INSERT INTO personas (nombre, email, telefono, direccion,dni) VALUES (:nombre, :email, :telefono, :direccion,:dni)");
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':email', $email);
        $this->db->bind(':telefono', $telefono);
        $this->db->bind(':direccion', $direccion);
        $this->db->bind(':dni', $dni);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            throw new \Exception("Error al crear la persona");
        }
    }
    public function deletePersona($personaId)
    {
        $this->db->query('DELETE FROM personas WHERE id = :id');
        $this->db->bind(':id', $personaId);
        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al eliminar los datos personales");
        }
    }

    public function emailExists($email)
    {
        $this->db->query("SELECT id FROM personas WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
    public function update($id, $nombre, $email, $telefono, $direccion, $dni)
    {
        $this->db->query('UPDATE personas SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion, dni = :dni WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':email', $email);
        $this->db->bind(':telefono', $telefono);
        $this->db->bind(':direccion', $direccion);
        $this->db->bind(':dni', $dni);

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Error al actualizar los datos de la persona");
        }
    }
}
