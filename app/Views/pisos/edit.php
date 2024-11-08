<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Editar Piso</h2>
            <?php if (isset($error)) : ?>
                <p class="text-red-500"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="/PIZZA4/public/pisos/edit/<?php echo $data['piso']['id']; ?>" method="post" class="space-y-8">
                <div>
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $data['piso']['nombre']; ?>" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
                </div>
                <div>
                    <label for="sede_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sede:</label>
                    <select id="sede_id" name="sede_id" required class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light">
                        <?php foreach ($data['sedes'] as $sede) : ?>
                            <option value="<?php echo $sede['id']; ?>" <?php if ($data['piso']['sede_id'] == $sede['id']) echo 'selected'; ?>><?php echo $sede['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Actualizar</button>
                </div>

            </form>
        </div>
    </section>
</main>