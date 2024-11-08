<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <h1 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Clientes</h1>
                    <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                        <a href="<?php echo APP_URL ?>" class="block text-center text-blue-500 hover:text-blue-700 transition-colors duration-300 mt-4">Inicio</a>
                        <a href="<?php echo CLIENT_CREATE ?>" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Crear Cliente
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nombre y Apellido</th>
                                <th scope="col" class="px-4 py-3">DNI</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Teléfono</th>
                                <th scope="col" class="px-4 py-3">Dirección</th>
                                <th scope="col" class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($data['clientes']) && is_array($data['clientes'])) : ?>
                                <?php foreach ($data['clientes'] as $cliente) : ?>
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-3"><?php echo $cliente['nombre']; ?></td>
                                        <td class="px-4 py-3"><?php echo $cliente['dni']; ?></td>
                                        <td class="px-4 py-3"><?php echo $cliente['email']; ?></td>
                                        <td class="px-4 py-3"><a href="tel:+51<?php echo $cliente['telefono']; ?>"><?php echo $cliente['telefono']; ?></a></td>
                                        <td class="px-4 py-3"><?php echo $cliente['direccion']; ?></td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-2">
                                                <a href="<?= CLIENT_EDIT . $cliente['id'] ?>" class="text-blue-500 hover:text-blue-700 transition-colors duration-300">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z" />
                                                    </svg>
                                                </a>
                                                <span>|</span>
                                                <a href="<?= CLIENT_DELETE . $cliente['id']; ?>" class="text-red-500 hover:text-red-700 transition-colors duration-300 delete-client-btn">
                                                    <svg class="w-[35px] h-[35px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center">No hay clientes registrados</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(".delete-client-btn").on("click", function(e) {
            e.preventDefault();
            const href = $(this).attr("href");

            Swal.fire({
                title: '¿Estás seguro de eliminar este cliente?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>