<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 p-8 bg-white dark:bg-gray-800 shadow-lg max-w-lg mx-auto">
        <h1 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-gray-300">Crear sede</h1>
        <?php if (isset($data['error'])) : ?>
            <p class="text-red-500 mb-4"><?php echo $data['error']; ?></p>
        <?php endif; ?>
        <form action="<?php echo FORM_URL ?>/sede/registro" method="POST" class="space-y-4">
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light input-translucido">
            </div>
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">direccion:</label>
                <input type="text" name="direccion" id="direccion" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light input-translucido">
            </div>

            <div class="text-center">
                <input type="submit" value="Registrar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
            </div>
        </form>
    </div>
</main>