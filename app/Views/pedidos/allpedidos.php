<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <div class="flex items-center flex-1 space-x-4">
                        <h5>
                            <span class="text-gray-500">Total Pedidos:</span>
                            <span class="dark:text-white"><?php echo isset($data['pedidosAgrupados']) ? count($data['pedidosAgrupados']) : 0; ?></span>
                        </h5>
                    </div>
                    <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                        <a href="/PIZZA4/public/pedidos/index" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Volver a la lista de mesas
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Mesa</th>
                                <th scope="col" class="px-4 py-3">Usuario</th>
                                <th scope="col" class="px-4 py-3">Fecha</th>
                                <th scope="col" class="px-4 py-3">Estado</th>
                                <th scope="col" class="px-4 py-3">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($data['pedidosAgrupados']) && is_array($data['pedidosAgrupados'])) : ?>
                                <?php foreach ($data['pedidosAgrupados'] as $pedido) : ?>
                                    <tr class="bg-gray-200 dark:bg-gray-700">
                                        <?php if ($pedido['estado'] == 'pagado') : ?>
                                        <?php else : ?>
                                            <td class="px-4 py-3"><?php echo $pedido['mesa']; ?></td>
                                            <td class="px-4 py-3"><?php echo $pedido['usuario']; ?></td>
                                            <td class="px-4 py-3"><?php echo $pedido['fecha']; ?></td>
                                            <td class="px-4 py-3"><?php echo $pedido['estado']; ?></td>
                                            <td class="px-4 py-3"><?php echo $pedido['descripcion']; ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center">No hay pedidos registrados</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>