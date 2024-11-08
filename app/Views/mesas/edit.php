<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <h1 class="text-2xl font-bold mb-4 dark:text-white">Editar Mesa</h1>
                </div>
                <?php if (isset($error)) : ?>
                    <p class="px-4 py-3 text-red-500"><?php echo $error; ?></p>
                <?php endif; ?>
                <div class="px-4 py-3">
                    <form action="/PIZZA4/public/mesas/edit/<?php echo $data['mesa']['id']; ?>" method="post">
                        <div class="mb-4">
                            <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número:</label>
                            <input type="text" id="numero" name="numero" value="<?php echo $data['mesa']['numero']; ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="mb-4">
                            <label for="capacidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Capacidad:</label>
                            <input type="text" id="capacidad" name="capacidad" value="<?php echo $data['mesa']['capacidad']; ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="mb-4">
                            <label for="piso_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Piso:</label>
                            <select id="piso_id" name="piso_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <?php foreach ($data['pisos'] as $piso) : ?>
                                    <option value="<?php echo $piso['id']; ?>" <?php if ($data['mesa']['piso_id'] == $piso['id']) echo 'selected'; ?>><?php echo $piso['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="Actualizar" class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-2 px-4 rounded cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>