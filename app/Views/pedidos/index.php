<main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Seleccionar Piso</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-4">
        <?php foreach ($data['pisos'] as $piso) : ?>
            <a href="/PIZZA4/public/pedidos/selectMesa/<?php echo $piso['id']; ?>" class="piso-cuadro">
                <div class="contenido-cuadro p-4 rounded-lg text-white">
                    <div class="texto-contenido bg-black bg-opacity-50 rounded p-2">
                        <p class="text-xl text-gray-100"><?php echo $piso['nombre']; ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>



<style>
    /* Estilo para los cuadros de los pisos */
    .piso-cuadro {
        border: 2px solid #ccc;
        height: 20rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background-size: cover;
        background-position: center;
        transition: transform 0.3s;
        border-radius: 10px;
        overflow: hidden;
        background-image: url('https://i.pinimg.com/originals/a6/ba/7f/a6ba7f7f6881e49a5f9da0c26dfc9859.jpg');
    }

    .contenido-cuadro {
        text-align: center;
        padding: 1rem;
        border-radius: 8px;
        transition: background-color 0.3s;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .texto-contenido {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 1rem;
        border-radius: 8px;
    }

    .piso-cuadro:hover {
        transform: scale(1.05);
    }
</style>