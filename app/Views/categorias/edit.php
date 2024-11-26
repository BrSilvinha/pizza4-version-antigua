<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Editar Categoría</h2>
        <?php if (isset($data['error'])) : ?>
            <p class="text-red-500"><?php echo $data['error']; ?></p>
        <?php endif; ?>
        <form action="<?= CATEGORY_EDIT?><?php echo $data['categoria']['id']; ?>" method="POST" class="space-y-8">
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre de la Categoría</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $data['categoria']['nombre']; ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" required>
            </div>
            <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-green-800 sm:w-fit hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar Cambios</button>
        </form>
    </div>
</main>