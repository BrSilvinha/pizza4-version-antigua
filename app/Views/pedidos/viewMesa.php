<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <!-- Card principal con detalles del pedido -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Encabezado con información general -->
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3">
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                Pedido Actual
                            </h2>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                Activo
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Información de la mesa y usuario -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <!-- Usuario -->
                    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900 dark:to-blue-800 rounded-xl shadow-lg border border-blue-200 dark:border-blue-700 transform transition-all hover:scale-105">
                        <!-- Círculo decorativo -->
                        <div class="absolute -top-6 -right-6 w-20 h-20 bg-blue-200 dark:bg-blue-600 rounded-full opacity-20"></div>

                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-200 dark:bg-blue-600 rounded-xl shadow-inner">
                                <svg class="w-8 h-8 text-blue-700 dark:text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="relative">
                                <p class="text-sm font-bold text-blue-700 dark:text-blue-200 uppercase tracking-wider mb-1">
                                    Atendido por
                                </p>
                                <p class="text-xl font-extrabold text-blue-900 dark:text-white">
                                    <?php echo htmlspecialchars($data['usuario']->nombre); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Mesa - Diseño Mejorado -->
                    <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-xl hover:shadow-2xl transform hover:scale-102 transition-all duration-300 border border-purple-100 dark:border-purple-700">
                        <!-- Fondo con gradiente y efecto de cristal -->
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-blue-500/10 dark:from-purple-600/20 dark:to-blue-600/20"></div>

                        <!-- Círculos decorativos -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-300 dark:bg-purple-600 rounded-full opacity-10 blur-2xl"></div>
                        <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-blue-300 dark:bg-blue-600 rounded-full opacity-10 blur-xl"></div>

                        <!-- Contenido principal -->
                        <div class="relative p-6">
                            <div class="flex items-center gap-5">
                                <!-- Icono con efecto de resplandor -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-purple-400 dark:bg-purple-500 rounded-xl blur-sm opacity-30"></div>
                                    <div class="relative p-3 bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-700 dark:to-purple-600 rounded-xl shadow-lg">
                                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Información de la mesa -->
                                <div class="flex flex-col gap-2">
                                    <!-- Título con efecto de resplandor -->
                                    <div class="relative">
                                        <span class="absolute inset-0 bg-purple-400 dark:bg-purple-500 opacity-10 blur-sm"></span>
                                        <h3 class="relative text-lg font-bold text-purple-700 dark:text-purple-200">
                                            Mesa <?php echo htmlspecialchars($data['mesa']->numero); ?>
                                        </h3>
                                    </div>

                                    <!-- Detalles con diseño mejorado -->
                                    <div class="flex items-center gap-3">
                                        <!-- Capacidad -->
                                        <div class="flex items-center gap-1.5 bg-purple-50 dark:bg-purple-900/50 px-3 py-1.5 rounded-full">
                                            <svg class="w-4 h-4 text-purple-500 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span class="text-sm font-medium text-purple-700 dark:text-purple-200">
                                                Capacidad: <?php echo htmlspecialchars($data['mesa']->capacidad); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Línea decorativa inferior -->
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-blue-500 opacity-75"></div>
                    </div>

                    <!-- ID Pedido - Diseño Mejorado -->
                    <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-xl hover:shadow-2xl transform hover:scale-102 transition-all duration-300 border border-blue-100 dark:border-blue-700">
                        <!-- Fondo con gradiente y efecto de cristal -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-emerald-500/10 to-blue-500/10 dark:from-blue-600/20 dark:via-emerald-600/20 dark:to-blue-600/20"></div>

                        <!-- Elementos decorativos -->
                        <div class="absolute -top-12 -right-12 w-40 h-40 bg-blue-300 dark:bg-blue-600 rounded-full opacity-10 blur-2xl"></div>
                        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-emerald-300 dark:bg-emerald-600 rounded-full opacity-10 blur-xl"></div>

                        <!-- Patrón de fondo sutil -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 1px); background-size: 24px 24px;"></div>
                        </div>

                        <!-- Contenido principal -->
                        <div class="relative p-6">
                            <div class="flex items-center gap-5">
                                <!-- Icono con efectos -->
                                <div class="relative group">
                                    <!-- Efecto de resplandor -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-emerald-400 rounded-xl blur opacity-30 group-hover:opacity-40 transition-opacity"></div>

                                    <!-- Contenedor del icono -->
                                    <div class="relative p-3.5 bg-gradient-to-br from-blue-50 to-emerald-50 dark:from-blue-800 dark:to-emerald-800 rounded-xl shadow-lg">
                                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Información del pedido -->
                                <div class="flex flex-col">
                                    <!-- Etiqueta de Pedido -->
                                    <div class="relative mb-1">
                                        <div class="inline-flex items-center">
                                            <span class="text-sm font-semibold text-blue-600 dark:text-blue-300 uppercase tracking-wider">
                                                Pedido ID
                                            </span>
                                            <!-- Badge de estado opcional -->
                                            <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full">
                                                Activo
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Número de Pedido -->
                                    <div class="relative group">
                                        <span class="absolute inset-0 bg-blue-400 dark:bg-blue-500 opacity-10 blur-sm group-hover:opacity-20 transition-opacity"></span>
                                        <p class="relative text-3xl font-black text-gradient bg-gradient-to-r from-blue-600 to-emerald-600 dark:from-blue-300 dark:to-emerald-300">
                                            #<?php echo htmlspecialchars($data['pedido']['pedido_id']); ?>
                                        </p>
                                    </div>

                                    <!-- Fecha opcional -->
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        <?php echo date('d M Y, H:i'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Barra de progreso o estado (opcional) -->
                        <div class="absolute bottom-0 left-0 right-0 h-1">
                            <div class="h-full bg-gradient-to-r from-blue-500 via-emerald-500 to-blue-500" style="width: 75%"></div>
                        </div>
                    </div>

                    <!-- Estilos adicionales necesarios -->
                    <style>
                        .text-gradient {
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                        }
                    </style>
                </div>

                <!-- Tabla de productos -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Producto</th>
                                <th scope="col" class="px-6 py-3">Precio</th>
                                <th scope="col" class="px-6 py-3">Cantidad</th>
                                <th scope="col" class="px-6 py-3">Descripción</th>
                                <th scope="col" class="px-6 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0; // Inicializa la variable $total
                            ?>
                            <?php foreach ($data['pedidos'] as $pedido) :
                                $subtotal = $pedido['precio'] * $pedido['cantidad'];
                                $total += $subtotal;
                            ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <?php echo htmlspecialchars($pedido['producto_nombre']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        S/. <?php echo htmlspecialchars($pedido['precio']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($pedido['cantidad']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($pedido['producto_descripcion']); ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        S/. <?php echo number_format($subtotal, 2); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <td class="px-6 py-3" colspan="4">TOTAL</td>
                                <td class="px-6 py-3">S/. <?php echo number_format($total, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-wrap gap-4 p-4">
                    <button type="button" id="cobrar-button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Cobrar Pedido
                    </button>
                    <button type="button" onclick="window.location.href='/PIZZA4/public/pedidos/create/<?php echo htmlspecialchars($data['mesa_id']); ?>?cliente_id=<?php echo htmlspecialchars($data['pedido']['cliente_id']); ?>'" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Agregar Producto
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Pago -->
    <div id="payment-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Procesar Pago
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="payment-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>

                <!-- Modal body (continuación) -->
                <form id="paymentForm" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <!-- Método de Pago -->
                        <div>
                            <label for="payment-method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Método de Pago
                            </label>
                            <select id="payment-method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="efectivo">Efectivo</option>
                                <option value="yape">Yape</option>
                                <option value="tarjeta">Tarjeta</option>
                            </select>
                        </div>

                        <!-- Campos dinámicos de pago -->
                        <div id="payment-fields" class="space-y-4"></div>

                        <!-- Boleta -->
                        <div>
                            <label for="boleta" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                ¿Desea Boleta?
                            </label>
                            <select id="boleta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" data-modal-hide="payment-modal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Procesar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Script para manejar el pago -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar modal de Flowbite
    const modal = new Modal(document.getElementById('payment-modal'));

    // Botón para mostrar modal
    document.getElementById('cobrar-button').addEventListener('click', function() {
        modal.show();
    });

    // Manejar cambios en el método de pago
    document.getElementById('payment-method').addEventListener('change', function() {
        const paymentFields = document.getElementById('payment-fields');
        const total = <?php echo $total; ?>; // Obtener el total del PHP

        paymentFields.innerHTML = ''; // Limpiar campos anteriores

        switch (this.value) {
            case 'efectivo':
                paymentFields.innerHTML = `
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Monto Recibido
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                S/.
                            </span>
                            <input type="number" 
                                   id="payment-amount" 
                                   step="0.10" 
                                   class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                   required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Total a Pagar
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                S/.
                            </span>
                            <input type="text" 
                                   value="${total.toFixed(2)}" 
                                   class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                   readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Vuelto
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                S/.
                            </span>
                            <input type="text" 
                                   id="change-amount" 
                                   class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                   readonly>
                        </div>
                    </div>
                `;

                // Calcular vuelto automáticamente
                document.getElementById('payment-amount').addEventListener('input', function() {
                    const paymentAmount = parseFloat(this.value) || 0;
                    const changeAmount = paymentAmount - total;
                    document.getElementById('change-amount').value = changeAmount >= 0 ? changeAmount.toFixed(2) : '0.00';
                });
                break;

            case 'yape':
                paymentFields.innerHTML = `
                    <div class="text-center space-y-4">
                        <img src="http://localhost/PIZZA4/public/img/qr.jpg" class="mx-auto max-w-sm rounded-lg" alt="QR Yape">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Escanea el código QR para pagar S/. ${total.toFixed(2)}</p>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Número de Operación
                            </label>
                            <input type="text" 
                                   id="operation-number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                   required>
                        </div>
                    </div>
                `;
                break;

            case 'tarjeta':
                paymentFields.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Número de Tarjeta
                            </label>
                            <input type="text" 
                                   id="card-number"
                                   placeholder="1234 5678 9012 3456" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                   maxlength="19"
                                   required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Fecha de Expiración
                                </label>
                                <input type="text" 
                                       id="card-expiry"
                                       placeholder="MM/AA" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                       maxlength="5"
                                       required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    CVV
                                </label>
                                <input type="password" 
                                       id="card-cvv"
                                       placeholder="123" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                       maxlength="4"
                                       required>
                            </div>
                        </div>
                    </div>
                `;
                break;
        }
    });

    // Manejar envío del formulario
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Obtener el método de pago seleccionado
        const paymentMethod = document.getElementById('payment-method').value;
        const pedidoId = <?php echo $data['pedido']['pedido_id']; ?>;
        const total = <?php echo $total; ?>;

        // Validar según el método de pago
        let isValid = true;
        let formData = new FormData();

        formData.append('pedido_id', pedidoId);
        formData.append('total', total);
        formData.append('tipo', paymentMethod);

        switch(paymentMethod) {
            case 'efectivo':
                const montoRecibido = parseFloat(document.getElementById('payment-amount').value);
                if (montoRecibido < total) {
                    alert('El monto recibido debe ser mayor o igual al total');
                    isValid = false;
                }
                formData.append('monto_recibido', montoRecibido);
                break;

            case 'yape':
                const operationNumber = document.getElementById('operation-number').value;
                if (!operationNumber) {
                    alert('Por favor, ingrese el número de operación');
                    isValid = false;
                }
                formData.append('nro_operacion', operationNumber);
                break;

            case 'tarjeta':
                const cardNumber = document.getElementById('card-number').value;
                const cardExpiry = document.getElementById('card-expiry').value;
                const cardCvv = document.getElementById('card-cvv').value;
                
                if (!cardNumber || !cardExpiry || !cardCvv) {
                    alert('Por favor, complete todos los campos de la tarjeta');
                    isValid = false;
                }
                formData.append('card_number', cardNumber);
                formData.append('card_expiry', cardExpiry);
                break;
        }

        // Agregar campo para la boleta
        formData.append('boleta', 'si');

        if (!isValid) return;

        // Mostrar indicador de carga
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Procesando...
        `;

        // Enviar formulario
        fetch(`/PIZZA4/public/pedidos/cobrar/${pedidoId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.text();
        })
        .then(result => {
            // Mostrar mensaje de éxito
            const successAlert = `
                <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        Pago procesado exitosamente.
                    </div>
                </div>
            `;
            document.querySelector('.modal-body').insertAdjacentHTML('afterbegin', successAlert);

            // Redireccionar después de 2 segundos
            setTimeout(() => {
                window.location.href = '/PIZZA4/public/mesas';
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
            
            const errorAlert = `
                <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        Error al procesar el pago. Por favor, intente nuevamente.
                    </div>
                </div>
            `;
            document.querySelector('.modal-body').insertAdjacentHTML('afterbegin', errorAlert);
        });
    });
});
</script>