<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100">

<!-- Sidebar -->
<aside class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-gray-200">
    <div class="flex items-center justify-center h-16 border-b">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8">
    </div>
    <div class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded">
                    Perfil
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Contenido principal -->
<div class="ml-64">
    <!-- Navbar superior -->
    <nav class="flex justify-end items-center p-4 bg-white border-b">
        <button id="userMenuButton" data-dropdown-toggle="userDropdown" class="flex items-center space-x-2">
            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="User">
            <span class="text-sm font-medium">John Doe</span>
        </button>

        <!-- Dropdown -->
        <div id="userDropdown" class="hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <div class="px-4 py-3 text-sm text-gray-900">
                <div>John Doe</div>
                <div class="font-medium truncate">name@company.com</div>
            </div>
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="userMenuButton">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Perfil</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Configuración</a></li>
            </ul>
            <div class="py-2">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Salir</a>
            </div>
        </div>
    </nav>

    <!-- Texto dinámico de prueba -->
    <main class="p-6">
        <h1 class="text-2xl font-bold">Hola desde admin</h1>
        <p class="mt-2 text-gray-600">Si ves esto, Tailwind + Flowbite funcionan 🎉</p>
    </main>
</div>

<!-- Script de Flowbite -->
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
