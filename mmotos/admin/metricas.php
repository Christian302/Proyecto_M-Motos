<?php 
require_once '../includes/auth.php'; 
require_once '../includes/header.php'; 
require '../includes/db.php';
?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-black mb-8 flex items-center gap-3">
        <i class="fa-solid fa-chart-bar"></i> Métricas de Ventas y Cotizaciones
    </h1>

    <!-- Tarjetas generales -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl text-center">
            <i class="fa-solid fa-envelope text-6xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Total Cotizaciones</h3>
            <?php 
            $total_cot = $pdo->query("SELECT COUNT(*) FROM cotizaciones")->fetchColumn(); 
            echo "<p class='text-6xl font-black text-red-600'>$total_cot</p>";
            ?>
        </div>
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl text-center">
            <i class="fa-solid fa-road text-6xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Total Pruebas de Manejo</h3>
            <?php 
            $total_pru = $pdo->query("SELECT COUNT(*) FROM pruebas")->fetchColumn(); 
            echo "<p class='text-6xl font-black text-red-600'>$total_pru</p>";
            ?>
        </div>
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl text-center">
            <i class="fa-solid fa-users text-6xl text-red-600 mb-4"></i>
            <h3 class="text-2xl font-bold">Vendedores Activos</h3>
            <?php 
            $total_ven = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE rol = 'vendedor'")->fetchColumn(); 
            echo "<p class='text-6xl font-black text-red-600'>$total_ven</p>";
            ?>
        </div>
    </div>

    <!-- Métricas por vendedor -->
    <h2 class="text-3xl font-bold mb-6">Por Vendedor</h2>
    <table class="w-full text-left">
        <thead>
            <tr class="bg-black text-white">
                <th class="p-4">Vendedor</th>
                <th class="p-4 text-center">Cotizaciones</th>
                <th class="p-4 text-center">Pruebas de Manejo</th>
            </tr>
        </thead>
        <tbody class="divide-y dark:divide-slate-700">
        <?php
        $stmt = $pdo->query("
            SELECT u.nombre, 
                   COUNT(DISTINCT c.id) as cotizaciones,
                   COUNT(DISTINCT p.id) as pruebas
            FROM usuarios u
            LEFT JOIN cotizaciones c ON c.vendedor_id = u.id
            LEFT JOIN pruebas p ON p.vendedor_id = u.id
            WHERE u.rol = 'vendedor'
            GROUP BY u.id
            ORDER BY cotizaciones DESC
        ");
        while ($v = $stmt->fetch()) {
            echo "
            <tr class='hover:bg-slate-100 dark:hover:bg-slate-800'>
                <td class='p-4 font-semibold'>{$v['nombre']}</td>
                <td class='p-4 text-center text-2xl font-bold text-blue-600'>{$v['cotizaciones']}</td>
                <td class='p-4 text-center text-2xl font-bold text-red-600'>{$v['pruebas']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>