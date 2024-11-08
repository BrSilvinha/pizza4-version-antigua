<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Editar Producto</h2>
            <form action="<?php echo PRODUCT_EDIT ?><?php echo $data['producto']['id']; ?>" method="POST" class="space-y-8">
                <div>
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $data['producto']['nombre']; ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" required>
                </div>
                <div>
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required><?php echo $data['producto']['descripcion']; ?></textarea>
                </div>
                <div>
                    <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Precio:</label>
                    <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $data['producto']['precio']; ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" required>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="disponible" id="disponible" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php echo $data['producto']['disponible'] ? 'checked' : ''; ?>>
                    <label for="disponible" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disponible</label>
                </div>
                <div>
                    <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Categoría:</label>
                    <select name="categoria_id" id="categoria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <?php foreach ($data['categorias'] as $categoria) : ?>
                            <option value="<?php echo $categoria['id']; ?>" <?php if ($data['producto']['categoria_id'] == $categoria['id']) echo 'selected'; ?>><?php echo $categoria['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Guardar cambios</button>
            </form>
        </div>
    </section>
</main>