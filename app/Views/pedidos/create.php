<script>
    const TOKEN = <?php echo json_encode(TOKEN) ?>; // Asume que TOKEN está definido en PHP

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.producto').forEach(producto => {
            const cantidad = producto.querySelector('.cantidad').value;
            if (cantidad > 0) {
                const precio = producto.querySelector('.precio').dataset.precio;
                total += cantidad * precio;
            }
        });
        document.getElementById('total').value = total;
    }

    function buscarProductos() {
        const filtro = document.getElementById('filtro').value.toLowerCase();
        document.querySelectorAll('.producto').forEach(producto => {
            const nombre = producto.querySelector('.nombre').textContent.toLowerCase();
            const precio = producto.querySelector('.precio').dataset.precio.toLowerCase();
            const categoria = producto.querySelector('.categoria').textContent.toLowerCase();
            if (nombre.includes(filtro) || precio.includes(filtro) || categoria.includes(filtro)) {
                producto.style.display = '';
            } else {
                producto.style.display = 'none';
            }
        });
    }

    function validarFormulario(event) {
        const productosSeleccionados = document.querySelectorAll('.producto .cantidad');
        let alMenosUnProductoSeleccionado = false;

        productosSeleccionados.forEach(producto => {
            if (producto.value > 0) {
                alMenosUnProductoSeleccionado = true;
            }
        });

        const clienteSeleccionado = document.getElementById('clienteSeleccionado').value;

        if (!alMenosUnProductoSeleccionado || !clienteSeleccionado) {
            event.preventDefault();
            let mensaje = '';
            if (!alMenosUnProductoSeleccionado) {
                mensaje += 'Debes seleccionar al menos un producto. ';
            }
            if (!clienteSeleccionado) {
                mensaje += 'Debes seleccionar un cliente.';
            }
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,
            });
        }
    }

    function obtenerClienteIdDeUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('cliente_id');
    }

    function actualizarUIConClienteSeleccionado(clienteId) {
        if (clienteId) {
            document.getElementById('clienteSeleccionado').value = clienteId;
            // Aquí deberías añadir lógica para mostrar la información del cliente
            // o marcar en la UI que el cliente ha sido seleccionado.
        }
    }

    function mostrarFormularioNuevoCliente() {
        Swal.fire({
            title: 'Registrar Nuevo Cliente',
            html: `
            <form id="nuevoClienteForm" class="space-y-4">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">DNI</label>
                    <div class="flex">
                        <input type="text" id="dni" name="dni" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        <button type="button" id="btn-search" class="ml-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 flex items-center">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre y Apellido:</label>
                    <input type="text" id="nombre" name="nombre" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                    <input type="email" id="email" name="email" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" pattern="\\d{9}" title="El número de teléfono debe tener exactamente 9 dígitos" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
            </form>`,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            didOpen: () => {
                document.getElementById('btn-search').addEventListener('click', buscarDNI);
            },
            preConfirm: () => {
                return new Promise((resolve, reject) => {
                    const form = document.getElementById('nuevoClienteForm');
                    const formData = new FormData(form);

                    fetch('<?php echo CLIENT_CREATE ?>', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                resolve(data.cliente);
                            } else {
                                reject(data.message || 'Error al registrar el cliente');
                            }
                        })
                        .catch(error => {
                            reject('Error de conexión');
                        });
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                seleccionarCliente(result.value);
                Swal.fire('Registrado!', 'El cliente ha sido registrado con éxito.', 'success');
            }
        }).catch(error => {
            Swal.fire('Error!', error, 'error');
        });
    }

    async function buscarDNI() {
        const dni = document.getElementById('dni').value;
        if (!dni || dni.length !== 8) {
            Swal.showValidationMessage("Ingrese un número de DNI válido");
            return;
        }

        try {
            Swal.showLoading();
            const response = await getAjaxByToken(`http://apiconsultas.lyracorp.pro/api/dni/${dni}`, TOKEN);
            Swal.hideLoading();
            if (response && response.data) {
                document.getElementById('nombre').value = response.data.nombre_completo;
            } else {
                Swal.showValidationMessage("No se encontraron datos para el DNI ingresado");
            }
        } catch (error) {
            console.error("Error en la consulta", error);
            Swal.showValidationMessage("Error en la consulta");
        }
    }

    const getAjaxByToken = async (url, token) => {
        try {
            const response = await fetch(url, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return await response.json();
        } catch (error) {
            console.error("Error en la consulta", error);
            throw error;
        }
    };

    function seleccionarCliente(cliente) {
        document.getElementById('clienteSeleccionado').value = cliente.id;
        document.getElementById('busquedaCliente').value = `${cliente.nombre} - ${cliente.dni}`;
        document.getElementById('resultadosCliente').innerHTML = '';
    }

    function buscarClientes() {
        const busqueda = document.getElementById('busquedaCliente').value.toLowerCase();
        const clientes = <?php echo json_encode($data['clientes']); ?>;
        const resultadosDiv = document.getElementById('resultadosCliente');
        resultadosDiv.innerHTML = '';

        const clientesFiltrados = clientes.filter(cliente =>
            cliente.dni.toLowerCase().includes(busqueda) ||
            cliente.nombre.toLowerCase().includes(busqueda) ||
            cliente.telefono.toLowerCase().includes(busqueda) ||
            cliente.direccion.toLowerCase().includes(busqueda) ||
            cliente.email.toLowerCase().includes(busqueda)
        );

        if (clientesFiltrados.length > 0) {
            clientesFiltrados.forEach(cliente => {
                const clienteDiv = document.createElement('div');
                clienteDiv.classList.add('p-2', 'border', 'text-gray-900', 'dark:text-white', 'rounded', 'mt-1', 'cursor-pointer', 'hover:bg-blue-900');
                clienteDiv.textContent = `${cliente.nombre} - ${cliente.dni}`;
                clienteDiv.addEventListener('click', () => seleccionarCliente(cliente));
                resultadosDiv.appendChild(clienteDiv);
            });
        } else {
            resultadosDiv.innerHTML = `
            <p class="categoria text-sm text-gray-800 dark:text-white">No se encontraron clientes.</p>
            <button type="button" onclick="mostrarFormularioNuevoCliente()" class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Registrar Nuevo Cliente
            </button>`;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.cantidad').forEach(cantidad => {
            cantidad.addEventListener('input', calcularTotal);
        });
        document.getElementById('filtro').addEventListener('input', buscarProductos);
        document.querySelector('form').addEventListener('submit', validarFormulario);
        document.getElementById('buscarClienteBtn').addEventListener('click', function() {
            document.getElementById('busquedaClienteContainer').classList.toggle('hidden');
        });
        document.getElementById('busquedaCliente').addEventListener('input', buscarClientes);

        const clienteId = obtenerClienteIdDeUrl();
        actualizarUIConClienteSeleccionado(clienteId);
    });
</script>


<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 p-4">
        <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Registrar Pedido</h1>

        <div class="mb-4">
            <button type="button" id="buscarClienteBtn" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Buscar Cliente
            </button>
        </div>
        <div id="busquedaClienteContainer" class="mb-4 hidden">
            <input type="text" id="busquedaCliente" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Buscar por DNI, nombre, teléfono, dirección o email">
            <div id="resultadosCliente" class="mt-2"></div>
        </div>

        <?php if (isset($error)) : ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="/PIZZA4/public/pedidos/create/<?php echo $data['mesa_id']; ?>" method="post">
            <input type="hidden" id="clienteSeleccionado" name="cliente_id" value="">
            <div class="mb-4">
                <label for="filtro" class="block text-sm font-medium text-gray-900 dark:text-white">Buscar Productos:</label>
                <input type="text" id="filtro" name="filtro" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light cantidad">
            </div>
            <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php foreach ($data['productos'] as $producto) : ?>
                    <div class="producto border-2 border-gray-300 rounded-lg dark:border-gray-600 p-4">
                        <p class="nombre font-medium text-lg text-gray-900 dark:text-white"><?php echo $producto['nombre']; ?></p>
                        <p class="categoria text-sm text-gray-800 dark:text-white"><?php echo $producto['categoria']; ?></p>
                        <p class="precio text-sm text-gray-500" data-precio="<?php echo $producto['precio']; ?>">Precio: <?php echo $producto['precio']; ?></p>
                        <input type="number" name="productos[<?php echo $producto['id']; ?>][cantidad]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light cantidad" placeholder="Cantidad">
                        <input type="text" name="productos[<?php echo $producto['id']; ?>][descripcion2]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light cantidad" placeholder="Descripcion del producto">
                        <input type="hidden" name="productos[<?php echo $producto['id']; ?>][id]" value="<?php echo $producto['id']; ?>">
                        <input type="hidden" name="productos[<?php echo $producto['id']; ?>][precio]" value="<?php echo $producto['precio']; ?>">
                        <input type="hidden" name="productos[<?php echo $producto['id']; ?>][descripcion]" value="<?php echo $producto['descripcion']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-4">
                <label for="total" class="block text-sm font-medium text-gray-900 dark:text-white">Total:</label>
                <input type="text" id="total" name="total" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light cantidad" readonly>
            </div>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Registrar Pedido
            </button>
            <a href="<?= ORDER_VIEW . $data['mesa_id'] ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Ver Pedido
            </a>
            <a href="<?= ORDER ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Regresar
            </a>
        </form>
    </div>
</main>