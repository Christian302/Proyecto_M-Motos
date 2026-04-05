<?php require_once '../includes/auth.php'; ?>
<?php require_once '../includes/header.php'; ?>
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-5xl font-black text-center mb-12">Panel de Control M-MOTOS</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <a href="productos.php" class="bg-white dark:bg-slate-900 p-10 rounded-3xl text-center hover:shadow-2xl transition">
            <i class="fa-solid fa-motorcycle text-7xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Gestionar Productos</h3>
        </a>
        <a href="solicitudes.php" class="bg-white dark:bg-slate-900 p-10 rounded-3xl text-center hover:shadow-2xl transition">
            <i class="fa-solid fa-envelope text-7xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Ver Solicitudes</h3>
        </a>
        <?php if($rol === 'maestro'): ?>
        <a href="usuarios.php" class="bg-white dark:bg-slate-900 p-10 rounded-3xl text-center hover:shadow-2xl transition">
            <i class="fa-solid fa-users text-7xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Gestionar Vendedores</h3>
        </a>
        <?php endif; ?>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>