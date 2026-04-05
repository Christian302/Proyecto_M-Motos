<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-MOTOS | Motos, Accesorios y Repuestos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-all duration-300">
<nav class="bg-black text-white sticky top-0 z-50 shadow-2xl">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <a href="index.php" class="flex items-center gap-3 text-4xl font-black">
            <i class="fa-solid fa-motorcycle text-red-600"></i> M-MOTOS
        </a>
        
        <div class="hidden md:flex items-center gap-8 text-lg font-medium">
            <a href="index.php" class="hover:text-red-600 transition">Inicio</a>
            <a href="catalogo.php" class="hover:text-red-600 transition">Catálogo</a>
            <a href="nosotros.php" class="hover:text-red-600 transition">Nosotros</a>
        </div>

        <div class="flex items-center gap-6">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="admin/index.php" class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl flex items-center gap-2 font-semibold">
                    <i class="fa-solid fa-user-tie"></i> PANEL
                </a>
                <a href="logout.php" class="text-red-600 hover:text-red-500 flex items-center gap-2 font-medium">
                    <i class="fa-solid fa-right-from-bracket"></i> SALIR
                </a>
            <?php else: ?>
                <a href="login.php" class="font-semibold hover:text-red-600">Vendedores</a>
            <?php endif; ?>

            <!-- Toggle Dark Mode Mejorado -->
            <button onclick="toggleDarkMode()" class="text-3xl hover:text-red-600 transition">
                <i id="themeIcon" class="fa-solid fa-moon"></i>
            </button>
        </div>
    </div>
</nav>

<script>
function toggleDarkMode() {
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');
    
    html.classList.toggle('dark');
    
    if (html.classList.contains('dark')) {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
        localStorage.theme = 'dark';
    } else {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
        localStorage.theme = 'light';
    }
}

// Cargar preferencia guardada
if (localStorage.theme === 'dark' || (!('theme' in localStorage))) {
    document.documentElement.classList.add('dark');
    document.getElementById('themeIcon').classList.add('fa-moon');
} else {
    document.getElementById('themeIcon').classList.add('fa-sun');
}
</script>