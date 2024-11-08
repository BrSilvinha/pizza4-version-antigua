<?php if (Session::get('usuario_id')) : ?>
    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd" />
                        </svg>

                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <br>
                <!-- INICIO -->
                <li>
                    <a href="<?php echo INICIO ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd" />
                        </svg>


                        <span class="ms-3">Inicio</span>
                    </a>
                </li>

                <!-- Ventas Menu -->
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="venta-menu" data-collapse-toggle="venta-menu">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ventas</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="venta-menu" class="hidden py-2 space-y-2">
                        <li>
                            <a href="<?php echo ORDER ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Atender</a>
                        </li>
                        <li>
                            <a href="<?php echo ORDER_ALL ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Pedidos</a>
                        </li>
                        <?php if ($data['rolUsuario'] == 'Administrador') { ?>
                            <li>
                                <a href="<?php echo VENTAS_MOSTRAR ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Ver ventas</a>
                            </li>
                            <li>
                                <a href="<?php echo PRODUCT ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Productos</a>
                            </li>
                            <li>
                                <a href="<?php echo CATEGORY ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Categorias</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($data['rolUsuario'] == 'Administrador') { ?>

                    <!-- Gestión de Usuarios Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="usuarios-menu" data-collapse-toggle="usuarios-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7,14c-2.21,0-4-1.79-4-4s1.79-4,4-4,4,1.79,4,4-1.79,4-4,4Zm7,10H0v-5c0-1.65,1.35-3,3-3H11c1.65,0,3,1.35,3,3v5ZM21,0H8c-1.65,0-3,1.35-3,3v1.35c.63-.22,1.3-.35,2-.35,2.74,0,5.05,1.84,5.77,4.35l2.23,2.23,3.59-3.59h-2.59v-2h4c1.1,0,2,.9,2,2v4h-2v-2.59l-5,5-2.15-2.15c-.23,1.06-.74,2.01-1.44,2.78,2.23,.18,4.05,1.81,4.49,3.96h8.1V3c0-1.65-1.35-3-3-3Z" />
                            </svg>

                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Usuarios</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="usuarios-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo USER ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Usuarios</a>
                            </li>
                            <li>
                                <a href="<?php echo USER_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Usuario</a>
                            </li>
                        </ul>
                    </li>
                    <!-- gestión de clientes -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="clientes-menu" data-collapse-toggle="clientes-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8,12c-3.309,0-6-2.691-6-6S4.691,0,8,0s6,2.691,6,6-2.691,6-6,6Zm6.744,12c-.211,0-.422-.067-.6-.2-.34-.254-.481-.696-.354-1.101l.941-3.016-2.377-1.934c-.32-.271-.437-.713-.292-1.107.145-.394.519-.655.938-.655h3.001l1.062-2.98c.146-.391.52-.651.937-.651s.791.26.937.651l1.062,2.98h3.001c.42,0,.795.263.939.657s.026.837-.295,1.108l-2.366,1.927.979,2.98c.134.403-.002.847-.339,1.106-.337.259-.801.277-1.156.046l-2.754-1.793-2.708,1.812c-.168.113-.362.169-.556.169Zm-4.807,0H1c-.552,0-1-.448-1-1,0-4.962,4.038-9,9-9h.937c.346,0,.667.18.85.474.182.294.199.662.045.971-.552,1.11-.832,2.307-.832,3.555s.28,2.444.832,3.555c.154.31.137.678-.045.972-.182.294-.504.473-.85.473Z" />
                            </svg>

                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Clientes</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="clientes-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo CLIENT ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Clientes</a>
                            </li>
                            <li>
                                <a href="<?php echo CLIENT_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Clientes</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Gestión de Roles Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="roles-menu" data-collapse-toggle="roles-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Roles</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="roles-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo ROL ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Roles</a>
                            </li>
                            <li>
                                <a href="<?php echo ROL_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Rol</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Gestión de Productos Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="productos-menu" data-collapse-toggle="productos-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M1,19V17A11.01,11.01,0,0,1,11,6.051V4.723a2,2,0,1,1,2,0V6.051A11.01,11.01,0,0,1,23,17v2ZM0,21v2H24V21Z" />
                            </svg>

                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Productos</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="productos-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo PRODUCT ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Productos</a>
                            </li>
                            <li>
                                <a href="<?php echo PRODUCT_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Producto</a>
                            </li>
                        </ul>
                    </li>
                    <!-- gestión de pisos Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="pisos-menu" data-collapse-toggle="pisos-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="m11,22.824L0,17.549v-3.381l11,5.284v3.372Zm2-.002l11-5.312v-3.323l-11,5.267v3.369ZM12,.714L0,6.5v5.536l11,5.274v-3.372L2,9.616v-2.166l10,4.751,10-4.751v2.181l-9,4.309v3.369l11-5.312v-5.497L12,.714Z" />
                            </svg>

                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Pisos</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="pisos-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo PISOS ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Pisos</a>
                            </li>
                            <li>
                                <a href=" <?php echo PISO_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear pisos</a>
                            </li>
                        </ul>
                    </li>
                    <!-- gestión de mesas Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="mesas-menu" data-collapse-toggle="mesas-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 6h14a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1zm14 8H3a1 1 0 0 1-1-1v-1h16v1a1 1 0 0 1-1 1z" />
                            </svg>

                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Mesas</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="mesas-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo TABLE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Mesas</a>
                            </li>
                            <li>
                                <a href="<?php echo TABLE_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Mesa</a>
                            </li>

                        </ul>
                    </li>
                    <!-- Gestión de Categorías Menu -->
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="categorias-menu" data-collapse-toggle="categorias-menu">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="m24,1v6c0,2.414-1.721,4.434-4,4.899v11.101c0,.552-.448,1-1,1s-1-.448-1-1v-11.101c-2.279-.465-4-2.484-4-4.899V1c0-.552.448-1,1-1s1,.448,1,1v6c0,1.302.839,2.402,2,2.816V1c0-.552.448-1,1-1s1,.448,1,1v8.816c1.161-.414,2-1.514,2-2.816V1c0-.552.448-1,1-1s1,.448,1,1Zm-8,17.918c-1.178.684-2.542,1.082-4,1.082-4.411,0-8-3.589-8-8S7.589,4,12,4V1c0-.349.071-.679.181-.991-.061,0-.12-.009-.181-.009C5.373,0,0,5.373,0,12s5.373,12,12,12c1.416,0,2.768-.258,4.029-.708-.01-.097-.029-.192-.029-.292v-4.082Zm-10-6.918c0,3.309,2.691,6,6,6,1.538,0,2.937-.586,4-1.54v-3.145c-2.361-1.126-4-3.53-4-6.315v-1c-3.309,0-6,2.691-6,6Z" />
                            </svg>


                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Categorías</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="categorias-menu" class="hidden py-2 space-y-2">
                            <li>
                                <a href="<?php echo CATEGORY ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Listar Categorias</a>
                            </li>
                            <li>
                                <a href="<?php echo CATEGORY_CREATE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Crear Categoria</a>
                            </li>
                        </ul>

                    </li>
                <?php }  ?>
        </div>
    </aside>
<?php endif; ?>