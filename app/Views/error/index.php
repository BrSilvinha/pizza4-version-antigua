<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes pulseRing {
            0% { transform: scale(0.95); opacity: 0.5; }
            50% { transform: scale(1.05); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.5; }
        }

        .error-icon-float {
            animation: floatIcon 3s ease-in-out infinite;
        }

        .error-container {
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            position: relative;
            overflow: hidden;
        }

        .pulse-effect::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid currentColor;
            opacity: 0.5;
            animation: pulseRing 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center error-container">
            <!-- Decorative circles -->
            <div class="absolute -top-10 -right-10 w-20 h-20 bg-blue-50 rounded-full opacity-40"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-red-50 rounded-full opacity-40"></div>
            
            <!-- Error icon with animations -->
            <div class="relative mb-6 error-icon-float">
                <div class="w-16 h-16 mx-auto relative pulse-effect">
                    <svg class="w-full h-full text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Error message with gradient text -->
            <h1 class="text-2xl font-bold mb-4 bg-gradient-to-r from-red-600 to-red-500 bg-clip-text text-transparent">
                Ha ocurrido un error
            </h1>
            
            <p class="text-gray-600 mb-8">
                <?php echo isset($data['mensaje']) ? $data['mensaje'] : 'Lo sentimos, algo no salió como esperábamos.'; ?>
            </p>

            <!-- Improved button with hover effects -->
            <a href="<?php echo APP_URL; ?>" 
               class="group inline-flex items-center px-6 py-2 text-sm font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 hover:shadow-md">
                <svg class="w-4 h-4 mr-2 transform transition-transform group-hover:-translate-x-1" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al inicio
            </a>
        </div>
    </div>
</body>
</html>