<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 p-8 bg-white dark:bg-gray-800 shadow-lg max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Registrar Nuevo Piso</h1>
        <?php if (isset($error)) : ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="<?php echo PISO_CREATE ?>" method="post">
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-lg">
            </div>
            <div class="mb-6">
                <label for="sede_id" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Sede:</label>
                <select id="sede_id" name="sede_id" required class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-lg">
                    <?php foreach ($data['sedes'] as $sede) : ?>
                        <option value="<?php echo $sede['id']; ?>"><?php echo $sede['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Registrar" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded cursor-pointer transition duration-300">
            </div>
        </form>
    </div>
</main>