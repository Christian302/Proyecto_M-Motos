<?php 
require_once '../includes/auth.php'; 
require_once '../includes/header.php'; 
?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-black mb-8">Gestión de Productos</h1>

    <!-- FORMULARIO AGREGAR / EDITAR -->
    <form action="productos.php" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 p-8 rounded-3xl mb-12 shadow-xl">
        <input type="hidden" name="id" id="edit_id" value="">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" required class="border rounded-2xl p-4">
            <select name="categoria" id="categoria" class="border rounded-2xl p-4">
                <option value="moto">Moto</option>
                <option value="accesorio">Accesorio</option>
                <option value="repuesto">Repuesto</option>
            </select>
            <input type="number" step="0.01" name="precio" id="precio" placeholder="Precio $" required class="border rounded-2xl p-4">
            <input type="number" name="ano" id="ano" placeholder="Año (ej: 2025)" class="border rounded-2xl p-4">
            <input type="text" name="modelo" id="modelo" placeholder="Modelo" class="border rounded-2xl p-4">
            <input type="text" name="color" id="color" placeholder="Color" class="border rounded-2xl p-4">
            <textarea name="descripcion" id="descripcion" placeholder="Descripción" rows="3" class="border rounded-2xl p-4 col-span-2"></textarea>
            <input type="file" name="imagen" class="border rounded-2xl p-4">
        </div>
        
        <button type="submit" name="guardar" class="mt-8 bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-2xl font-bold text-lg">
            💾 Guardar Producto
        </button>
    </form>

    <!-- TABLA DE PRODUCTOS -->
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-black text-white">
                <th class="p-4 rounded-tl-3xl">Imagen</th>
                <th class="p-4">Nombre</th>
                <th class="p-4">Categoría</th>
                <th class="p-4">Precio</th>
                <th class="p-4 rounded-tr-3xl">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y dark:divide-slate-700">
        <?php
        require '../includes/db.php';
        $stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
        while ($p = $stmt->fetch()) {
            echo "
            <tr class='hover:bg-slate-100 dark:hover:bg-slate-800'>
                <td class='p-4'><img src='../uploads/{$p['imagen']}' class='w-16 h-16 object-cover rounded-2xl'></td>
                <td class='p-4 font-semibold'>{$p['nombre']}</td>
                <td class='p-4'><span class='px-4 py-1 bg-red-100 text-red-600 rounded-full text-sm'>{$p['categoria']}</span></td>
                <td class='p-4 font-bold text-xl'>\${$p['precio']}</td>
                <td class='p-4'>
                    <button onclick='editar(".json_encode($p).")' class='text-blue-600 hover:underline mr-4'>✏️ Editar</button>
                    <a href='?eliminar={$p['id']}' onclick=\"return confirm('¿Eliminar este producto?')\" class='text-red-600 hover:underline'>🗑️ Eliminar</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
function editar(p) {
    document.getElementById('edit_id').value = p.id;
    document.getElementById('nombre').value = p.nombre;
    document.getElementById('categoria').value = p.categoria;
    document.getElementById('precio').value = p.precio;
    document.getElementById('ano').value = p.ano || '';
    document.getElementById('modelo').value = p.modelo || '';
    document.getElementById('color').value = p.color || '';
    document.getElementById('descripcion').value = p.descripcion || '';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<?php
// ==================== PROCESAR FORMULARIO ====================
require '../includes/db.php';

if (isset($_POST['guardar'])) {
    $id          = $_POST['id'] ?? null;
    $nombre      = $_POST['nombre'];
    $categoria   = $_POST['categoria'];
    $precio      = $_POST['precio'];
    $ano         = $_POST['ano'] ?? null;
    $modelo      = $_POST['modelo'] ?? null;
    $color       = $_POST['color'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;

    // Subir imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen = time() . '_' . uniqid() . '.' . $ext;
        $ruta = '../uploads/' . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    }

    if ($id) {
        // ==================== ACTUALIZAR ====================
        $sql = "UPDATE productos SET nombre=?, categoria=?, precio=?, ano=?, modelo=?, color=?, descripcion=?";
        if ($imagen) $sql .= ", imagen=?";
        $sql .= " WHERE id=?";

        $stmt = $pdo->prepare($sql);
        $params = [$nombre, $categoria, $precio, $ano, $modelo, $color, $descripcion];
        if ($imagen) $params[] = $imagen;
        $params[] = $id;
        $stmt->execute($params);
    } else {
        // ==================== INSERTAR ====================
        $sql = "INSERT INTO productos (nombre, categoria, precio, ano, modelo, color, descripcion, imagen) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $categoria, $precio, $ano, $modelo, $color, $descripcion, $imagen]);
    }

    header("Location: productos.php");
    exit;
}

// ==================== ELIMINAR ====================
if (isset($_GET['eliminar'])) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$_GET['eliminar']]);
    header("Location: productos.php");
    exit;
}
?>

<?php require_once '../includes/footer.php'; ?>