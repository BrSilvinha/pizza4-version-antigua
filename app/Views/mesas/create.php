<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h1 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Registrar Nueva Mesa</h1>
        <?php if (isset($error)) : ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="/PIZZA4/public/mesas/create" method="post" class="space-y-8">
            <div>
                <label for="piso_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Piso:</label>
                <select id="piso_id" name="piso_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <?php foreach ($data['pisos'] as $piso) : ?>
                        <option value="<?php echo $piso['id']; ?>"><?php echo $piso['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número:</label>
                <input type="text" id="numero" name="numero" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
            </div>
            <div>
                <label for="capacidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Capacidad:</label>
                <input type="text" id="capacidad" name="capacidad" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
            </div>
            <div>
                <input type="submit" value="Registrar" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
            </div>
        </form>
    </div>
</main>