   <link rel="stylesheet" href="http://localhost/PIZZA4/public/css/style.css">

   <main class="p-4 md:ml-64 h-auto pt-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
       <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
           <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
               <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                   <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                       <h1 class="text-2xl font-bold mb-4 dark:text-white">Mesas</h1>
                       <a href="/PIZZA4/public/mesas/create" class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-2 px-4 rounded mb-4 inline-block dark:bg-primary-600 dark:hover:bg-primary-700">Crear Mesa</a>
                   </div>
                   <div class="overflow-x-auto bg-blue-500 dark:bg-gray-800">
                       <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                           <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                               <tr>
                                   <th class="px-4 py-3">Número</th>
                                   <th class="px-4 py-3">Capacidad</th>
                                   <th class="px-4 py-3">Piso</th>
                                   <th class="px-4 py-3">Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php foreach ($data['mesas'] as $mesa) : ?>
                                   <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                       <td class="px-4 py-3"><?php echo $mesa['numero']; ?></td>
                                       <td class="px-4 py-3"><?php echo $mesa['capacidad']; ?></td>
                                       <td class="px-4 py-3"><?php echo $mesa['piso']; ?></td>
                                       <td class="px-4 py-3">
                                           <div class="flex items-center space-x-2">
                                               <a href="/PIZZA4/public/mesas/edit/<?php echo $mesa['id']; ?>" class="Btn edit-btn">
                                                   Editar
                                                   <svg class="svg" viewBox="0 0 512 512">
                                                       <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                                   </svg>
                                               </a>
                                               <span>|</span>
                                               <!-- Enlace para eliminar rol -->
                                               <a href="/PIZZA4/public/mesas/delete/<?php echo $mesa['id']; ?>" class="Btn delete-btn" onclick="return confirm('¿Estás seguro de eliminar este mesa?');">
                                                   Borrar
                                                   <svg class="svg" viewBox="0 0 448 512">
                                                       <path d="M135.2 17.8C140.4 7.1 150.8 0 162.4 0h123.2c11.7 0 22 7.1 27.2 17.8L328.6 32H432c8.8 0 16 7.2 16 16s-7.2 16-16 16h-16.4L397.4 467.1c-1.8 35.3-31.1 62.9-66.5 62.9H117.1c-35.4 0-64.7-27.6-66.5-62.9L32.4 64H16c-8.8 0-16-7.2-16-16s7.2-16 16-16h103.4l17.8-14.2zM384 64H64l17.1 403.4c.5 10.3 9.1 18.6 19.4 18.6H347.4c10.3 0 18.9-8.3 19.4-18.6L384 64zM192 416c8.8 0 16-7.2 16-16V144c0-8.8-7.2-16-16-16s-16 7.2-16 16v256c0 8.8 7.2 16 16 16zm128 0c8.8 0 16-7.2 16-16V144c0-8.8-7.2-16-16-16s-16 7.2-16 16v256c0 8.8 7.2 16 16 16z"></path>
                                                   </svg>
                                               </a>
                                           </div>
                                       </td>
                                   </tr>
                               <?php endforeach; ?>
                           </tbody>
                       </table>
                       <?php if (empty($data['mesas'])) : ?>
                           <p class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No hay mesas registradas</p>
                       <?php endif; ?>
                   </div>
               </div>
           </div>
       </section>
   </main>