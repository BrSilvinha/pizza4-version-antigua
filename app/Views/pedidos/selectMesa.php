<main class="main class=p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">&nbsp;Seleccionar Mesa</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 ml-4"> <!-- Ajuste aquí -->
        <?php foreach ($data['mesas'] as $mesa) : ?>
            <div class="border-2 piso-cuadro <?php echo $mesa['estado'] == 'ocupada' ? 'border-red-500 bg-red-100' : 'border-green-500 bg-green-100'; ?> rounded-lg h-32 md:h-64 flex flex-col justify-between p-4 transition duration-300 custom-bg-image">
                <a href="/PIZZA4/public/pedidos/create/<?php echo $mesa['id']; ?>" class="flex items-center justify-center flex-col h-full">
                    <div class="text-center">
                        <p class="text-sm text-gray-500 text-blue-900 dark:text-white">Mesa <?php echo $mesa['numero']; ?></p>
                        <?php if ($mesa['estado'] == 'ocupada') : ?>
                            <p class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900"> ocupada </p>
                        <?php else : ?>
                            <p class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"> libre</p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php if ($mesa['estado'] == 'ocupada') : ?>
                    <div class="flex space-x-2 mt-4">
                        <a id="btn-pedido" href="/PIZZA4/public/pedidos/viewMesa/<?php echo $mesa['id']; ?>" class="flex items-center justify-center px-1 py-1 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-1 focus:ring-green-300 font-medium rounded-full text-sm px-2 py-2 text-center me-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">ver pedido</button>
                        </a>
                        <form id="liberar-mesa-form" action="<?= LIBERAR_MESA . $mesa['id']; ?>" method="post">
                            <!-- enviamos el id del piso -->
                            <input type="hidden" name="id" value="<?php echo $data['piso_id']; ?>">
                            <button type="button" id="liberar-mesa-button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-2 py-2 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Liberar mesa</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<style>
    .custom-bg-image {
        background-image: url('https://i.pinimg.com/564x/a2/0c/db/a20cdba311ce765be6c05a60f0b2cf0e.jpg');
        background-size: cover;
        background-position: center;
    }

    .piso-cuadro:hover {
        transform: scale(1.05);
        /* Ajusta el valor según tu preferencia */
    }

    /* ver pedido boton  */
</style>

<script>
    document.querySelectorAll('#liberar-mesa-button').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se eliminará el pedido al liberar la mesa.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, liberar mesa',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        });
    });
</script>