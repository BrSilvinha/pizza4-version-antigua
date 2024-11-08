<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <h1 class="text-2xl font-bold mb-4 dark:text-white">Mesas en <?php echo $data['piso']['nombre']; ?></h1>
                    <a href="/PIZZA4/public/mesas/create" class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-2 px-4 rounded mb-4 inline-block dark:bg-primary-600 dark:hover:bg-primary-700">Crear Mesa</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Número</th>
                                <th class="px-4 py-3">Capacidad</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['mesas'] as $mesa) : ?>
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3"><?php echo $mesa['numero']; ?></td>
                                    <td class="px-4 py-3"><?php echo $mesa['capacidad']; ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2">
                                            <a href="/PIZZA4/public/mesas/edit/<?php echo $mesa['id']  ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                            <a href="/PIZZA4/public/mesas/delete/<?php echo $mesa['id']  ?>" onclick="return confirm('¿Estás seguro de eliminar esta mesa?');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (empty($data['mesas'])) : ?>
                        <p class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No hay mesas registradas en este piso</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>