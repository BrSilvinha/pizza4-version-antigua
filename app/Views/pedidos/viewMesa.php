<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <h1 class="text-2xl font-bold mb-4 dark:text-white">Pedidos Existentes en la Mesa</h1>
                </div>
                <div class="px-4 py-3">
                    <?php if (isset($error)) : ?>
                        <p class="text-red-500"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <?php if (isset($data['pedido'])) : ?>
                        <div>
                            <label for="usuario_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Usuario: <?php echo htmlspecialchars($data['usuario']->nombre); ?>
                            </label>
                            <?php if (isset($data['mesa']) && isset($data['mesa']->capacidad) && isset($data['mesa']->numero) && isset($data['mesa']->id)) : ?>
                                <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 m-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <span>Piso: <?php echo htmlspecialchars($data['mesa']->nombre_piso); ?></span> -
                                    <span>N° Mesa: <?php echo htmlspecialchars($data['mesa']->numero); ?></span> -
                                    <span>Capacidad: <?php echo htmlspecialchars($data['mesa']->capacidad); ?></span>
                                    <span>Pedido ID: <?php echo htmlspecialchars($data['pedido']['pedido_id']); ?></span>
                                </div>
                            <?php else : ?>
                                <div class="text-red-500">No se encontró información de la mesa.</div>
                            <?php endif; ?>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="bg-gray-200 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-2 px-4 border dark:border-gray-600 dark:text-white">Producto</th>
                                        <th class="py-2 px-4 border dark:border-gray-600 dark:text-white">Precio</th>
                                        <th class="py-2 px-4 border dark:border-gray-600 dark:text-white">Cantidad</th>
                                        <th class="py-2 px-4 border dark:border-gray-600 dark:text-white">Descripción</th>
                                        <th class="py-2 px-4 border dark:border-gray-600 dark:text-white">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="pedido-body">
                                    <?php
                                    $total = 0;
                                    foreach ($data['pedidos'] as $pedido) :
                                        $subtotal = $pedido['precio'] * $pedido['cantidad'];
                                        $total += $subtotal;
                                    ?>
                                        <tr class="border-b dark:border-gray-600 producto">
                                            <td class="py-2 px-4 border dark:border-gray-600 dark:text-white nombre"><?php echo htmlspecialchars($pedido['producto_nombre']); ?></td>
                                            <td class="py-2 px-4 border dark:border-gray-600 dark:text-white precio" data-precio="<?php echo htmlspecialchars($pedido['precio']); ?>"> S/. <?php echo htmlspecialchars($pedido['precio']); ?></td>
                                            <td class="py-2 px-4 border dark:border-gray-600 dark:text-white"><?php echo htmlspecialchars($pedido['cantidad']); ?></td>
                                            <td class="py-2 px-4 border dark:border-gray-600 dark:text-white"><?php echo htmlspecialchars($pedido['producto_descripcion']); ?></td>
                                            <td class="py-2 px-4 border dark:border-gray-600 dark:text-white subtotal">S/. <?php echo number_format($subtotal, 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 m-2">
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total:</label>
                            <p id="total" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
                                S/. <?php echo number_format($total, 2); ?>
                            </p>
                        </div>
                        <button type="button" id="cobrar-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cobrar Pedido</button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button" onclick="window.location.href='/PIZZA4/public/pedidos/create/<?php echo htmlspecialchars($data['mesa_id']); ?>?cliente_id=<?php echo htmlspecialchars($data['pedido']['cliente_id']); ?>'">Agregar Nuevo Producto</button>
                    <?php else : ?>
                        <p class="text-red-500">No se encontró información del pedido.</p>
                        <br>
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href='/PIZZA4/public/pedidos/create/<?php echo htmlspecialchars($data['mesa_id']); ?>'">Agregar Producto</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="form-pago" class="hidden bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Pago de Pedido</h2>
            <form id="paymentForm" class="space-y-8" action="/PIZZA4/public/pedidos/cobrar/<?php echo $pedido['id']; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
                <input type="hidden" name="cliente_id" value="<?php echo $data['cliente']["id"] ?>">
                <input type="hidden" name="mesa_id" value="<?php echo $data['mesa_id']; ?>">
                <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="total" value="<?php echo number_format($total, 2); ?>">
                <input type="hidden" name="pedido_id" value="<?php echo $data['pedido']['pedido_id'] ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Método de Pago</label>
                    <select name="tipo" id="payment-method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="efectivo">Efectivo</option>
                        <option value="yape">Yape</option>
                        <option value="tarjeta">Tarjeta</option>
                    </select>
                </div>
                <div id="payment-fields">
                    <!-- Campos de pago dinámicos se generarán aquí -->
                </div>
                <!-- opcion de seleccionar si se decea una boleta o no  -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">¿Desea Boleta?</label>
                    <select name="boleta" id="boleta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pagar</button>
            </form>
        </div>
    </section>
</main>



<script>
    document.getElementById('cobrar-button').addEventListener('click', function() {
        const formPago = document.getElementById('form-pago');
        formPago.classList.toggle('hidden');
    });

    document.getElementById('payment-method').addEventListener('change', function() {
        const paymentFields = document.getElementById('payment-fields');
        paymentFields.innerHTML = ''; // Limpiar campos anteriores

        switch (this.value) {
            case 'efectivo':
                paymentFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Cantidad con la que Paga</label>
                        <input type="number" id="payment-amount" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Monto Total</label>
                        <input type="number" id="total-amount" value="<?php echo number_format($total, 2); ?>" step="0.01" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Vuelto</label>
                        <input type="number" id="change-amount" step="0.01" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                `;

                document.getElementById('payment-amount').addEventListener('input', function() {
                    const paymentAmount = parseFloat(this.value) || 0;
                    const totalAmount = parseFloat(document.getElementById('total-amount').value) || 0;
                    const changeAmount = paymentAmount - totalAmount;
                    document.getElementById('change-amount').value = changeAmount >= 0 ? changeAmount.toFixed(2) : 0;
                });
                break;
            case 'tarjeta':
                paymentFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Número de Tarjeta</label>
                        <input type="text" id="card-number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Fecha de Expiración</label>
                        <input type="text" id="expiry-date" placeholder="MM/AA" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Código CVV</label>
                        <input type="text" id="cvv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                `;
                break;
            case 'yape':
                paymentFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Escanea el código QR con Yape</label>
                        <img src="http://localhost/PIZZA4/public/img/qr.jpg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        `;
                break;
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        calcularTotal();
    });

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.producto').forEach(producto => {
            const cantidad = parseFloat(producto.querySelector('.cantidad').textContent);
            const precio = parseFloat(producto.querySelector('.precio').dataset.precio);
            total += cantidad * precio;
        });
        document.getElementById('total').textContent = `S/. ${total.toFixed(2)}`;
        // Actualiza el campo de total en el formulario de pago
        document.getElementById('total-amount').value = total.toFixed(2);
    }
</script>