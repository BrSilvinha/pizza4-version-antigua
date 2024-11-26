<main>
    <section class="bg-gray-100 dark:bg-gray-900 min-h-screen flex justify-center items-center">
        <div class="container mx-auto flex justify-center items-center">
            <div class="max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex items-center">
                <div class="w-1/2">
                    <img src="https://img.freepik.com/vector-premium/cartel-vertical-rebanada-pizza-pepperoni-margherita-hawaiana-mariscos-mexicanos-e-ingredientes-vintage-vector-colorido-grabado-ilustracion-caja-menu-fondo-madera_171932-1595.jpg?w=360" alt="Pizza" class="w-full h-full object-cover rounded-l-lg">
                </div>
                <div class="w-1/2 p-8 flex justify-center items-center">
                    <div class="w-full">
                        <h2 class="mb-6 text-4xl tracking-tight font-bold text-gray-900 dark:text-white text-center">Crear Categoría</h2>
                        <?php if (isset($data['error'])) : ?>
                            <p class="text-red-500 text-center"><?php echo $data['error']; ?></p>
                        <?php endif; ?>
                        <form action="<?=CATEGORY_CREATE?>" method="POST" class="space-y-6">
                            <div>
                                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre de la Categoría</label>
                                <input type="text" name="nombre" id="nombre" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-3 focus:outline-none" required>
                            </div>
                            <div>
                                <button type="submit" class="w-full py-4 px-6 text-sm font-semibold text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">Crear Categoría</button>
                                <a href="<?php echo CATEGORY ?>" class="block text-center text-blue-500 hover:text-blue-700 transition-colors duration-300 mt-6">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>