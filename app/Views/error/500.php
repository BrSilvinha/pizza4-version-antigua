<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
   <style>
        @keyframes slideIn {
            0% { 
                opacity: 0;
                transform: translateY(-30px);
            }
            100% { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% { 
                transform: scale(1);
                opacity: 1;
            }
            50% { 
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-slide-in {
            animation: slideIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, #e5e7eb 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 flex items-center justify-center p-6 bg-pattern">
    <div class="glass-effect rounded-2xl shadow-2xl p-12 max-w-lg w-full animate-slide-in relative overflow-hidden">
        <!-- Círculos decorativos de fondo -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-purple-200/30 to-pink-200/30 rounded-full transform translate-x-32 -translate-y-32 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-indigo-200/30 to-blue-200/30 rounded-full transform -translate-x-32 translate-y-32 blur-2xl"></div>
        
        <div class="relative">
            <!-- Icono de error animado -->
            <div class="mb-8 animate-float">
                <svg class="w-20 h-20 mx-auto text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <!-- Contenido de texto -->
            <div class="text-center space-y-6">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Ha ocurrido un error
                </h1>
                
                <p class="text-gray-600 text-lg leading-relaxed">
                    Lo sentimos, algo no salió como esperábamos. Por favor, inténtelo de nuevo en unos momentos.
                </p>

                <!-- Botón con efectos mejorados -->
                <div class="pt-8">
                    <a href="<?php echo APP_URL; ?>" class="inline-flex items-center px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:from-indigo-600 hover:to-purple-700 focus:ring-4 focus:ring-purple-500/50 focus:outline-none">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>