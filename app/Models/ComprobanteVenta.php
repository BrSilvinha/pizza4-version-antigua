<?php
class ComprobanteVenta extends Model
{
    public function getVentas()
    {
        $this->db->query('        
        SELECT 
            comprobanteventa.id AS comprobante_id,
            comprobanteventa.pedido_id,
            comprobanteventa.fecha,
            comprobanteventa.tipo,
            comprobanteventa.monto,
            pedidoscomanda.fecha AS pedido_fecha,
            pedidoscomanda.total AS pedido_total,
            personas.nombre AS usuario_nombre,
            cliente_persona.nombre AS cliente_nombre,
            cliente_persona.telefono AS cliente_telefono,
            cliente_persona.direccion AS cliente_direccion,
            cliente_persona.email AS cliente_email,
            mesas.numero AS mesa_numero,
            piso.nombre AS piso_nombre,
            GROUP_CONCAT(
                CONCAT(
                    "Producto ID: ", detallespedido.producto_id, 
                    ", Cantidad: ", detallespedido.cantidad, 
                    ", Precio: ", detallespedido.precio, 
                    ", Nombre: ", productos.nombre, 
                    ", Descripción: ", productos.descripcion
                ) 
                SEPARATOR " | "
            ) AS detalles_pedido
        FROM 
            comprobanteventa
        JOIN 
            pedidoscomanda ON comprobanteventa.pedido_id = pedidoscomanda.id
        JOIN 
            usuarios ON pedidoscomanda.usuario_id = usuarios.id
        JOIN 
            personas ON usuarios.persona_id = personas.id
        JOIN 
            clientes ON pedidoscomanda.cliente_id = clientes.id
        JOIN 
            personas AS cliente_persona ON clientes.persona_id = cliente_persona.id
        JOIN 
            mesas ON pedidoscomanda.mesa_id = mesas.id
        JOIN 
            piso ON mesas.piso_id = piso.id
        JOIN 
            detallespedido ON pedidoscomanda.id = detallespedido.pedido_id
        JOIN 
            productos ON detallespedido.producto_id = productos.id
        GROUP BY 
            comprobanteventa.id,
            comprobanteventa.pedido_id,
            comprobanteventa.fecha,
            comprobanteventa.tipo,
            comprobanteventa.monto,
            pedidoscomanda.fecha,
            pedidoscomanda.total,
            personas.nombre,
            cliente_persona.nombre,
            cliente_persona.telefono,
            cliente_persona.direccion,
            cliente_persona.email,
            mesas.numero,
            piso.nombre');

        return $this->db->resultSet();
    }

    public function createComprobante($data)
    {

        $this->db->query('INSERT INTO comprobanteventa (pedido_id, tipo, monto) 
        VALUES (:pedido_id, :tipo, :monto)');
        $this->db->bind(':pedido_id', $data['pedido_id']);
        $this->db->bind(':tipo', $data['tipo']);
        $this->db->bind(':monto', $data['monto']);
        return $this->db->execute();
    }
}
