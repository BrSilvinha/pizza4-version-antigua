<div class="antialiased bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- nav -->
    <?php include_once __DIR__ . '/inc/navbar.php'; ?>
    <!-- nav -->
    <!-- Sidebar -->
    <?php include_once __DIR__ . '/inc/sidebar.php'; ?>
    <!-- sidebar -->

    <main class="p-4 md:ml-64 h-auto pt-20">
        <!-- Título del Dashboard -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Panel</h1>
        </div>

        <!-- Cuadros -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Usuarios -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple-400 dark:bg-purple-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['usuariosCount']; ?></h3>
                                    <p>Usuarios</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/user.png" alt="Usuarios" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo USER ?>" class="block text-white bg-purple-500 dark:bg-purple-700 text-center py-2 rounded-b-lg hover:bg-purple-600 dark:hover:bg-purple-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Clientes -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-blue-400 dark:bg-blue-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['clientesCount']; ?></h3>
                                    <p>Clientes</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/conference-call.png" alt="Clientes" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo CLIENT ?>" class="block text-white bg-blue-500 dark:bg-blue-700 text-center py-2 rounded-b-lg hover:bg-blue-600 dark:hover:bg-blue-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Productos -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-red-400 dark:bg-red-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['productosCount']; ?></h3>
                                    <p>Productos</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/box.png" alt="Productos" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo PRODUCT ?>" class="block text-white bg-red-500 dark:bg-red-700 text-center py-2 rounded-b-lg hover:bg-red-600 dark:hover:bg-red-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Pisos -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange-500 dark:bg-orange-450 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['pisoCount']; ?></h3>
                                    <p>Pisos</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/building.png" alt="Pisos" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo PISOS ?>" class="block text-white bg-orange-400 dark:bg-orange-700 text-center py-2 rounded-b-lg hover:bg-orange-600 dark:hover:bg-orange-700 hover:text-orange-800 dark:hover:text-orange-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Mesas -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-red-500 dark:bg-red-700 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['mesasCount']; ?></h3>
                                    <p>Mesas</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/table.png" alt="Mesas" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo TABLE ?>" class="block text-white bg-red-700 dark:bg-red-700 text-center py-2 rounded-b-lg hover:bg-red-600 dark:hover:bg-red-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Categorías -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-yellow-300 dark:bg-yellow-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['categoriasCount']; ?></h3>
                                    <p>Categorías</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/list.png" alt="Categorías" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo ORDER_ALL ?>" class="block text-white bg-yellow-400 dark:bg-green-700 text-center py-2 rounded-b-lg hover:bg-yellow-600 dark:hover:bg-yellow-600 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Roles -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-gray-300 dark:bg-gray-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="text-white">
                                    <h3 class="text-3xl font-bold"><?php echo $data['rolesCount']; ?></h3>
                                    <p>Roles</p>
                                </div>
                                <div class="ml-auto">
                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/key.png" alt="Roles" class="icon-size">
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo ROL ?>" class="block text-white bg-gray-400 dark:bg-gray-700 text-center py-2 rounded-b-lg hover:bg-gray-600 dark:hover:bg-gray-800 transition duration-200">
                            Más info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <!-- Pedidos -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-green-400 dark:bg-green-600 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="text-white">
                                <h3 class="text-3xl font-bold"><?php echo $data['pedidosCount']; ?></h3>
                                <p>Pedidos pendientes</p>
                            </div>
                            <div class="ml-auto">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/shopping-cart.png" alt="Pedidos" class="icon-size">
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo ORDER_ALL ?>" class="block text-white bg-green-500 dark:bg-green-700 text-center py-2 rounded-b-lg hover:bg-green-600 dark:hover:bg-green-800 transition duration-200">
                        Más info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <br>



            <canvas id="pedidosChart" class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-6 bg-white dark:bg-gray-800 shadow-lg"></canvas>
            <canvas id="productosMasVendidosChart" class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-6 bg-white dark:bg-gray-800 shadow-lg" width="100" height="100"></canvas>

        <div class="grid grid-cols-2 gap-6">
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 bg-white dark:bg-gray-800 shadow-lg"></div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 bg-white dark:bg-gray-800 shadow-lg"></div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 bg-white dark:bg-gray-800 shadow-lg"></div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 bg-white dark:bg-gray-800 shadow-lg"></div>
        </div>

        <?php include_once __DIR__ . '/inc/footer.php'; ?>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalPedidosPorEstado = <?php echo json_encode($data['totalPedidosPorEstado']); ?>;
        const labels = totalPedidosPorEstado.map(item => item.estado);
        const totals = totalPedidosPorEstado.map(item => item.total);

        const ctx = document.getElementById('pedidosChart').getContext('2d');
        const pedidosChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total de Pedidos',
                    data: totals,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('productosMasVendidosChart').getContext('2d');
        const productos = <?php echo json_encode(array_column($data['productosMasVendidos'], 'nombre')); ?>;
        const cantidades = <?php echo json_encode(array_column($data['productosMasVendidos'], 'total_vendido')); ?>;

        // Asegúrate de que cantidades sean números
        const cantidadesNumericas = cantidades.map(Number);

        function generateColors(numColors) {
            const colors = [];
            for (let i = 0; i < numColors; i++) {
                const hue = (i * 137.508) % 360; // Distribuye los colores uniformemente
                colors.push(`hsl(${hue}, 70%, 60%)`);
            }
            return colors;
        }

        const backgroundColors = generateColors(productos.length);
        const borderColors = backgroundColors.map(color => color.replace('0.6', '1'));

        const config = {
            type: 'pie',
            data: {
                labels: productos,
                datasets: [{
                    label: 'Total Vendido',
                    data: cantidadesNumericas,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Productos más vendidos',
                        color: 'Gray' // Ajusta esto según el tema de tu sitio
                    },
                },
                // Ajustes para modo oscuro
                color: 'Gray', // Color del texto en el gráfico
                scales: {
                    x: {
                        ticks: {
                            color: 'Gray'
                        }
                    },
                    y: {
                        ticks: {
                            color: 'Gray'
                        }
                    }
                }
            }
        };
        new Chart(ctx2, config);
    });
</script>