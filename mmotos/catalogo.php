<?php require_once 'includes/header.php'; ?>
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-5xl font-black text-center mb-10 flex items-center justify-center gap-4">
        <i class="fa-solid fa-motorcycle text-red-600"></i>
        Catálogo M-Motos
        <i class="fa-solid fa-motorcycle text-red-600"></i>
    </h1>

    <!-- FILTROS -->
    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl mb-12">
        <form method="GET" class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <select name="categoria" class="border border-slate-300 dark:border-slate-700 rounded-2xl p-4">
                <option value="">Todas las categorías</option>
                <option value="moto">Motos</option>
                <option value="accesorio">Accesorios</option>
                <option value="repuesto">Repuestos</option>
            </select>
            <input type="number" name="precio_min" placeholder="Precio mínimo" class="border border-slate-300 dark:border-slate-700 rounded-2xl p-4">
            <input type="number" name="precio_max" placeholder="Precio máximo" class="border border-slate-300 dark:border-slate-700 rounded-2xl p-4">
            <select name="ano" class="border border-slate-300 dark:border-slate-700 rounded-2xl p-4">
                <option value="">Año</option>
                <?php for($i=2020; $i<=2026; $i++) echo "<option value='$i'>$i</option>"; ?>
            </select>
            <button type="submit" class="bg-red-600 text-white rounded-2xl font-bold flex items-center justify-center gap-2">
                <i class="fa-solid fa-filter"></i> FILTRAR
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8" id="productos-grid">
        <?php
        require 'includes/db.php';
        
        $where = [];
        $params = [];

        if (!empty($_GET['categoria'])) { $where[] = "categoria = ?"; $params[] = $_GET['categoria']; }
        if (!empty($_GET['precio_min'])) { $where[] = "precio >= ?"; $params[] = $_GET['precio_min']; }
        if (!empty($_GET['precio_max'])) { $where[] = "precio <= ?"; $params[] = $_GET['precio_max']; }
        if (!empty($_GET['ano'])) { $where[] = "ano = ?"; $params[] = $_GET['ano']; }

        $sql = "SELECT * FROM productos";
        if (count($where) > 0) $sql .= " WHERE " . implode(" AND ", $where);
        $sql .= " ORDER BY precio DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        $contador = 0;
        while ($p = $stmt->fetch()) {
            $contador++;
            $esMoto = ($p['categoria'] === 'moto');
            
            echo '
            <div class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-xl hover:-translate-y-2 transition-all">
                <img src="uploads/'.$p['imagen'].'" class="w-full h-64 object-cover group-hover:scale-105 transition" onerror="this.src=\'https://via.placeholder.com/400x300?text=Sin+imagen\'">
                <div class="p-6">
                    <span class="uppercase text-xs tracking-widest text-red-600 flex items-center gap-1">
                        <i class="fa-solid fa-tag"></i> '.$p['categoria'].'
                    </span>
                    <h3 class="text-2xl font-bold mt-1">'.$p['nombre'].'</h3>
                    <p class="text-4xl font-black text-red-600">$' . number_format($p['precio'], 2) . '</p>
                    
                    <div class="flex gap-3 mt-6">';
            
            // Botón Cotizar (siempre)
            echo '<button onclick="cotizar('.$p['id'].', \''.$p['nombre'].'\')" 
                        class="flex-1 bg-black text-white py-4 rounded-2xl font-semibold flex items-center justify-center gap-2">
                        <i class="fa-solid fa-calculator"></i> Cotizar
                    </button>';
            
            // Botón Prueba SOLO para motos
            if ($esMoto) {
                echo '<button onclick="reservarPrueba('.$p['id'].', \''.$p['nombre'].'\')" 
                            class="flex-1 border-2 border-black dark:border-white py-4 rounded-2xl font-semibold flex items-center justify-center gap-2">
                        <i class="fa-solid fa-road"></i> Prueba
                    </button>';
            }
            
            echo '</div>
                </div>
            </div>';
        }
        
        if ($contador == 0) {
            echo '<div class="col-span-full text-center py-20 text-2xl text-slate-400">
                    <i class="fa-solid fa-motorcycle text-6xl mb-6 block"></i>
                    Aún no hay productos en esta categoría.<br>
                    <a href="admin/productos.php" class="text-red-600 underline flex items-center justify-center gap-2 mt-4">
                        <i class="fa-solid fa-plus"></i> Agrega productos desde el panel
                    </a>
                  </div>';
        }
        ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="assets/js/script.js"></script>