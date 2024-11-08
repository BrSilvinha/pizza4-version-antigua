<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold underline">Registro de Usuario</h1>
        <?php if (isset($error)) : ?>
            <div class="bg-red-500 text-white p-4 mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="/register" method="POST" class="mt-4">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-gray-700">Dirección:</label>
                <textarea name="direccion" id="direccion" class="border rounded w-full py-2 px-3" required></textarea>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nombre de usuario:</label>
                <input type="text" name="username" id="username" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña:</label>
                <input type="password" name="password" id="password" class="border rounded w-full py-2 px-3" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Registrar</button>
        </form>
    </div>
</main>