<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <section class="py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="p-4">
                    <h2 class="text-2xl font-semibold leading-tight dark:text-white">Datos de la Sedes</h2>
                </div>
                <div class="overflow-x-auto">
                    <?php if (isset($data['sedes']) && !empty($data['sedes'])) : ?>
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Nombre</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['sedes'] as $sede) : ?>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700">
                                            <p class=" dark:text-gray-300"><?php echo htmlspecialchars($sede['nombre']); ?></p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700">
                                            <p class=" dark:text-gray-300"><?php echo htmlspecialchars($sede['direccion']); ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="p-4 text-red-500">No se encontraron sedes.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>