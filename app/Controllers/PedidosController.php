<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PedidosController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pisoModel = $this->model('Piso');
        $pisos = $pisoModel->getPisos();
        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('pedidos/index', [
            'pisos' => $pisos,
            'rolUsuario' => $rolUsuario
        ]);
    }

    public function selectMesa($piso_id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $mesaModel = $this->model('Mesa');
        $mesas = $mesaModel->getMesasByPiso($piso_id);
        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('pedidos/selectMesa', [
            'mesas' => $mesas,
            'piso_id' => $piso_id,
            'rolUsuario' => $rolUsuario
        ]);
    }

    public function viewMesa($mesa_id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pedidoModel = $this->model('Pedido');
        $pedidos = $pedidoModel->getPedidosByMesa($mesa_id);
        $productoModel = $this->model('Producto');
        $productos = $productoModel->getAllProductos();
        $clienteModel = $this->model('Cliente');
        $cliente = $clienteModel->getClienteById($pedidos[0]['cliente_id']);
        $usuarioModel = $this->model('Usuario');
        $usuario = $usuarioModel->getUsuarioById(Session::get('usuario_id'));
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        if ($usuario) {
            $usuario = (object) $usuario;
        }

        $mesaModel = $this->model('Mesa');
        $mesa = $mesaModel->getMesaById($mesa_id);

        if ($mesa) {
            $mesa = (object) $mesa;
        }

        $pedido = isset($pedidos[0]) ? $pedidos[0] : null;


        $this->view('pedidos/viewMesa', [
            'mesa_id' => $mesa_id,
            'pedidos' => $pedidos,
            'productos' => $productos,
            'cliente' => $cliente,
            'mesa' => $mesa,
            'usuario' => $usuario,
            'pedido' => $pedido,
            'rolUsuario' => $rolUsuario
        ]);
    }

    public function create($mesa_id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pedidoData = [
                'mesa_id' => $mesa_id,
                'cliente_id' => $_POST['cliente_id'],
                'usuario_id' => Session::get('usuario_id'),
                'estado' => 'pendiente',
                'total' => $_POST['total'],
                'fecha' => date('Y-m-d H:i:s')
            ];
            $pedidoModel = $this->model('Pedido');
            $pedidoId = $pedidoModel->createPedido($pedidoData);

            if ($pedidoId) {
                $mesaModel = $this->model('Mesa');
                $mesaModel->updateEstado($mesa_id, 'ocupada');

                if (isset($_POST['productos']) && is_array($_POST['productos'])) {
                    foreach ($_POST['productos'] as $producto) {
                        if ($producto['cantidad'] > 0) {
                            $detalleData = [
                                'pedido_id' => $pedidoId,
                                'producto_id' => $producto['id'],
                                'cantidad' => $producto['cantidad'],
                                'precio' => $producto['precio'],
                                'descripcion' => $producto['descripcion2'],
                                'estado' => 'pendiente'
                            ];
                            $pedidoModel->addDetalle($detalleData);
                        }
                    }
                }

                header('Location: /PIZZA4/public/pedidos/viewMesa/' . $mesa_id . "?success=pedido registrado con exito");
                exit();
            } else {
                $clienteModel = $this->model('Cliente');
                $productoModel = $this->model('Producto');

                $this->view('pedidos/create', [
                    'error' => 'Error al registrar el pedido.',
                    'mesa_id' => $mesa_id,
                    'clientes' => $clienteModel->getAllClientes(),
                    'productos' => $productoModel->getAllProductos()
                ]);
            }
        } else {
            $clienteModel = $this->model('Cliente');
            $clientes = $clienteModel->getAllClientes();

            $productoModel = $this->model('Producto');
            $productos = $productoModel->getAllProductos();
            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

            // Obtener el cliente_id de la URL si está presente
            $cliente_id = isset($_GET['cliente_id']) ? $_GET['cliente_id'] : null;

            $this->view('pedidos/create', [
                'mesa_id' => $mesa_id,
                'clientes' => $clientes,
                'productos' => $productos,
                'cliente_id' => $cliente_id, // Pasar cliente_id a la vista
                'rolUsuario' => $rolUsuario
            ]);
        }
    }

    public function update($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pedidoModel = $this->model('Pedido');
        $mesaModel = $this->model('Mesa');
        $clienteModel = $this->model('Cliente');
        $productoModel = $this->model('Producto');



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'mesa_id' => $_POST['mesa_id'],
                'cliente_id' => $_POST['cliente_id'],
                'usuario_id' => Session::get('usuario_id'),
                'estado' => $_POST['estado'],
                'total' => $_POST['total'],
                'fecha' => date('Y-m-d H:i:s')
            ];

            if ($pedidoModel->updatePedido($data)) {
                $pedidoModel->deleteDetallesByPedido($id);

                foreach ($_POST['productos'] as $producto_id => $detalle) {
                    if ($detalle['cantidad'] > 0) {
                        $producto = $productoModel->getProductoById($producto_id);
                        $detalleData = [
                            'pedido_id' => $id,
                            'producto_id' => $producto_id,
                            'cantidad' => $detalle['cantidad'],
                            'precio' => $producto->precio
                        ];
                        $pedidoModel->addDetalle($detalleData);
                    }
                }

                header('Location: /PIZZA4/public/pedidos/viewMesa/' . $_POST['mesa_id']);
                exit();
            } else {
                die('Error al actualizar el pedido');
            }
        } else {
            $pedido = $pedidoModel->getPedidoById($id);
            $mesas = $mesaModel->getAllMesas();
            $productos = $productoModel->getAllProductos();
            $clientes = $clienteModel->getAllClientes();

            $this->view('pedidos/update', [
                'pedido' => $pedido,
                'mesas' => $mesas,
                'clientes' => $clientes,
                'productos' => $productos
            ]);
        }
    }
    public function actualizarProducto($pedido_id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            Session::init();
            if (!Session::get('usuario_id')) {
                header('Location: ' . SALIR);
                exit();
            }

            $pedidoModel = $this->model('Pedido');
            $data = [
                "pedido_id" => $pedido_id,
                "cantidad" => $_POST["cantidad"]
            ];

            $success = $pedidoModel->updateDetallePedido($data);

            if ($success) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
                echo "ERROR";
                exit();
            }
        }
    }

    public function eliminarProducto($pedido_id, $producto_id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pedidoModel = $this->model('Pedido');
        if ($pedidoModel->deleteDetalle($pedido_id, $producto_id)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            die('Error al eliminar el producto del pedido');
        }
    }

    public function liberarMesa($mesa_id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pedidoModel = $this->model('Pedido');

        // Obtener todos los pedidos asociados a la mesa
        $pedidos = $pedidoModel->getPedidosByMesa($mesa_id);

        // Eliminar cada pedido y sus detalles
        foreach ($pedidos as $pedido) {
            $pedidoModel->deletePedido(['detalle_id' => $pedido['id'], 'comanda_id' => $pedido['pedido_id']]);
        }

        // Actualizar el estado de la mesa a 'libre'
        $mesaModel = $this->model('Mesa');
        $mesaModel->updateEstado($mesa_id, 'libre');

        header('Location: ' . ORDER_SELECTMESA . $_POST['id']);
        exit();
    }

    public function allPedidos()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }
        $pedidosModel = $this->model('Pedido');
        $pedidos = $pedidosModel->getAllPedidosWithDetails();
        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

        $pedidosAgrupados = [];
        foreach ($pedidos as $pedido) {
            $mesa = $pedido['mesa'];
            if (!isset($pedidosAgrupados[$mesa])) {
                $pedidosAgrupados[$mesa] = [
                    'mesa' => $mesa,
                    'usuario' => $pedido['usuario'],
                    'fecha' => $pedido['fecha'],
                    'estado' => $pedido['estado'],
                    'descripcion' => $pedido['descripcion']
                ];
            } else {
                $pedidosAgrupados[$mesa]['descripcion'] .= ', ' . $pedido['descripcion'];
            }
        }
        $this->view('pedidos/allPedidos', ['pedidosAgrupados' => $pedidosAgrupados, 'rolUsuario' => $rolUsuario]);
    }

    public function cobrar($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pedidoModel = $this->model('Pedido');
        $pedido = $pedidoModel->getPedidoById($_POST['pedido_id']);

        if ($pedido) {
            // Recoger datos del formulario
            $pedidoData = [
                'pedido_id' => $_POST['pedido_id'],
                'fecha' => date('Y-m-d H:i:s'),
                'estado' => 'pagado',
                'monto' => $_POST['total'],
                'tipo' => $_POST['tipo'],
            ];


            if ($pedidoModel->updateEstadoPedido($pedidoData)) {
                // Actualizar el estado de la mesa
                $mesaModel = $this->model('Mesa');
                $mesaModel->updateEstado($pedido['mesa_id'], 'libre');

                // Verificación adicional
                $pedidoExistente = $pedidoModel->getPedidoById($pedidoData['pedido_id']);
                if ($pedidoExistente) {
                    // Registrar el comprobante de venta
                    $comprobanteModel = $this->model('ComprobanteVenta');
                    if ($comprobanteModel->createComprobante($pedidoData)) {
                        if ($_POST['boleta'] === 'si') {
                            $boletaData = $pedidoModel->getDetailedPedidoById($pedidoData['pedido_id']);
                            // Imprimir boleta
                            $this->imprimirBoleta($boletaData);
                        }
                        // Redirigir a la vista de la mesa
                        header('Location: ' . ORDER . '?success= Pedido pagado con éxito , se ha enviado un correo con la boleta de pedido');
                        exit();
                    } else {
                        echo ('Error al registrar el comprobante de venta');
                        exit();
                    }
                } else {
                    echo ('El pedido no existe en la base de datos');
                    exit();
                }
            } else {
                error_log('Error al actualizar el estado del pedido');
                echo 'Error al actualizar el estado del pedido';
                exit();
            }
        } else {
            error_log('Error al encontrar el pedido');
            die('Error al encontrar el pedido');
            echo 'Error al encontrar el pedido';
            exit();
        }
    }
    public function imprimirBoleta($datos)
    {

        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }
        try {
            require_once(dirname(__FILE__) . '/../../vendor/tecnickcom/tcpdf/tcpdf.php');

            $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Tu Empresa');
            $pdf->SetTitle('Boleta de Pedido');
            $pdf->SetSubject('Boleta de Pedido');
            $pdf->SetKeywords('TCPDF, PDF, boleta, pedido');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(15, 15, 15);
            $pdf->AddPage();

            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->Cell(0, 10, 'Boleta de Pedido', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 10);

            $pdf->Ln(5);

            // Información del pedido
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(50, 6, 'Número de Pedido:', 0, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 6, $datos['pedido_id'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(50, 6, 'Fecha:', 0, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 6, $datos['fecha'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(50, 6, 'Atendido por:', 0, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 6, $datos['usuario_nombre'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(50, 6, 'Mesa:', 0, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 6, $datos['mesa_numero'] . ' (' . $datos['piso_nombre'] . ')', 0, 1);

            $pdf->Ln(5);

            // Información del cliente
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 8, 'Datos del Cliente', 0, 1);
            $pdf->SetFont('helvetica', '', 10);

            $pdf->Cell(50, 6, 'Nombre:', 0, 0);
            $pdf->Cell(0, 6, $datos['cliente_nombre'], 0, 1);

            $pdf->Cell(50, 6, 'Teléfono:', 0, 0);
            $pdf->Cell(0, 6, $datos['cliente_telefono'], 0, 1);

            $pdf->Cell(50, 6, 'Dirección:', 0, 0);
            $pdf->Cell(0, 6, $datos['cliente_direccion'], 0, 1);

            $pdf->Cell(50, 6, 'Email:', 0, 0);
            $pdf->Cell(0, 6, $datos['cliente_email'], 0, 1);

            $pdf->Ln(5);

            // Detalles del pedido en una tabla
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 8, 'Detalle del Pedido', 0, 1);
            $pdf->SetFont('helvetica', '', 10);

            // Encabezados de la tabla
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(60, 7, 'Producto', 1, 0, 'C', 1);
            $pdf->Cell(60, 7, 'Descripción', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Cantidad', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Precio', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Subtotal', 1, 1, 'C', 1);

            // Detalles de los productos
            $pdf->SetFont('helvetica', '', 9);
            $detalles = explode(' | ', $datos['detalles_pedido']);
            foreach ($detalles as $detalle) {
                $partes = explode(', ', $detalle);
                $producto = '';
                $descripcion = '';
                $cantidad = 0;
                $precio = 0;

                foreach ($partes as $parte) {
                    if (strpos($parte, 'Nombre:') !== false) {
                        $producto = trim(str_replace('Nombre:', '', $parte));
                    } elseif (strpos($parte, 'Descripción:') !== false) {
                        $descripcion = trim(str_replace('Descripción:', '', $parte));
                    } elseif (strpos($parte, 'Cantidad:') !== false) {
                        $cantidad = intval(trim(str_replace('Cantidad:', '', $parte)));
                    } elseif (strpos($parte, 'Precio:') !== false) {
                        $precio = floatval(trim(str_replace('Precio:', '', $parte)));
                    }
                }

                $subtotal = $cantidad * $precio;

                $pdf->Cell(60, 6, $producto, 1);
                $pdf->Cell(60, 6, $descripcion, 1);
                $pdf->Cell(20, 6, $cantidad, 1, 0, 'C');
                $pdf->Cell(25, 6, 'S/ ' . number_format($precio, 2), 1, 0, 'R');
                $pdf->Cell(25, 6, 'S/ ' . number_format($subtotal, 2), 1, 1, 'R');
            }

            $pdf->Ln(5);

            // Total
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(165, 8, 'Total:', 0, 0, 'R');
            $pdf->Cell(25, 8, 'S/ ' . number_format($datos['total'], 2), 0, 1, 'R');

            // Generar el PDF y guardarlo en el servidor
            $pdfFileName = 'boleta_' . $datos['pedido_id'] . "_" . $datos['cliente_nombre'] . '.pdf';
            $pdfFilePath = 'C:\\xampp\\htdocs\\pizza4\\ruta-temporal\\' . $pdfFileName;
            $pdf->Output($pdfFilePath, 'F');

            // Devolver la URL del PDF
            $rutaCompleta = 'C:\\xampp\\htdocs\\pizza4\\ruta-temporal\\' . $pdfFileName;

            $this->enviarCorreo($datos);
            return $rutaCompleta;
        } catch (Exception $e) {
            error_log('Error al generar el PDF: ' . $e->getMessage());
            return null;
        }
    }

    public function enviarCorreo($datos)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = USERNAME;
            $mail->Password   = CONTRASENA;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom(USERNAME, NOMBRE_EMPRE);
            $mail->addAddress($datos['cliente_email'], $datos['cliente_nombre']);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Boleta de Pedido #' . $datos['pedido_id'];
            $mail->Body    = $this->generarContenidoHTML($datos);

            $mail->send();
            return 'Correo enviado exitosamente';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit();
            error_log('Error al enviar el correo: ' . $mail->ErrorInfo);
            return null;
        }
    }
    private function generarContenidoHTML($datos)
    {
        $html = '
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                }
                h1, h2 {
                    color: #2c3e50;
                }
                h1 {
                    border-bottom: 2px solid #3498db;
                    padding-bottom: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                }
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th {
                    background-color: #3498db;
                    color: white;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                .total {
                    font-size: 1.125rem; /* Tamaño en rem para consistencia */
                    font-weight: bold;
                    text-align: right;
                    margin-top: 20px;
                }
                .info-section {
                    background-color: #ecf0f1;
                    padding: 15px;
                    border-radius: 5px;
                    margin-bottom: 20px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Sombra para efecto de profundidad */
                }
                p {
                    margin: 0.5em 0; /* Márgenes consistentes */
                }
                @media (max-width: 600px) {
                    body {
                        padding: 10px;
                    }
                    table, .info-section {
                        box-shadow: none; /* Eliminar sombras en dispositivos móviles */
                    }
                }
            </style>
        </head>
        <body>
            <h1>Boleta de Pedido</h1>
            <div class="info-section">
                <h2>Información del Pedido</h2>
                <p><strong>Número de Pedido:</strong> ' . htmlspecialchars($datos['pedido_id'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Fecha:</strong> ' . htmlspecialchars($datos['fecha'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Atendido por:</strong> ' . htmlspecialchars($datos['usuario_nombre'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Mesa:</strong> ' . htmlspecialchars($datos['mesa_numero'], ENT_QUOTES, 'UTF-8') . ' (' . htmlspecialchars($datos['piso_nombre'], ENT_QUOTES, 'UTF-8') . ')</p>
            </div>
    
            <div class="info-section">
                <h2>Datos del Cliente</h2>
                <p><strong>Nombre:</strong> ' . htmlspecialchars($datos['cliente_nombre'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Teléfono:</strong> ' . htmlspecialchars($datos['cliente_telefono'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Dirección:</strong> ' . htmlspecialchars($datos['cliente_direccion'], ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Email:</strong> ' . htmlspecialchars($datos['cliente_email'], ENT_QUOTES, 'UTF-8') . '</p>
            </div>
    
            <h2>Detalle del Pedido</h2>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>';

        $detalles = explode(' | ', $datos['detalles_pedido']);
        foreach ($detalles as $detalle) {
            $partes = explode(', ', $detalle);
            $producto = '';
            $descripcion = '';
            $cantidad = 0;
            $precio = 0;

            foreach ($partes as $parte) {
                if (strpos($parte, 'Nombre:') !== false) {
                    $producto = trim(str_replace('Nombre:', '', $parte));
                } elseif (strpos($parte, 'Descripción:') !== false) {
                    $descripcion = trim(str_replace('Descripción:', '', $parte));
                } elseif (strpos($parte, 'Cantidad:') !== false) {
                    $cantidad = intval(trim(str_replace('Cantidad:', '', $parte)));
                } elseif (strpos($parte, 'Precio:') !== false) {
                    $precio = floatval(trim(str_replace('Precio:', '', $parte)));
                }
            }

            $subtotal = $cantidad * $precio;

            $html .= '
                <tr>
                    <td>' . htmlspecialchars($producto, ENT_QUOTES, 'UTF-8') . '</td>
                    <td>' . htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8') . '</td>
                    <td>' . htmlspecialchars($cantidad, ENT_QUOTES, 'UTF-8') . '</td>
                    <td>S/ ' . number_format($precio, 2) . '</td>
                    <td>S/ ' . number_format($subtotal, 2) . '</td>
                </tr>';
        }

        $html .= '
            </table>
            <div class="total">Total: S/ ' . number_format($datos['total'], 2) . '</div>
        </body>
        </html>';

        return $html;
    }
}
