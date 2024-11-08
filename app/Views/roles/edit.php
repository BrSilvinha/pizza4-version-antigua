<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Editar Rol</h1>
            <?php if (isset($data['error'])) : ?>
                <p class="text-red-500 text-gray-900 dark:text-white"><?php echo $data['error']; ?></p>
            <?php endif; ?>
            <form action="/PIZZA4/public/roles/edit/<?php echo $data['rol']['id']; ?>" method="POST" class="space-y-4">
                <div>
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $data['rol']['nombre']; ?>" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded transition-colors duration-300">Guardar Cambios</button>
            </form>
        </div>
    </section>

</main>