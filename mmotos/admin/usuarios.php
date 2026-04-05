<?php 
require_once '../includes/auth.php'; 
if ($rol !== 'maestro') die("<div class='text-center text-red-600 text-3xl mt-20'>Solo el maestro puede gestionar vendedores</div>");

require_once '../includes/header.php'; 
require '../includes/db.php';
?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-black mb-8 flex items-center gap-3">
        <i class="fa-solid fa-users"></i> Gestionar Vendedores
    </h1>

    <!-- FORMULARIO AGREGAR VENDEDOR -->
    <form method="POST" class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="nombre" placeholder="Nombre completo" required class="border rounded-2xl p-4">
            <input type="email" name="email" placeholder="Correo electrónico" required class="border rounded-2xl p-4">
            <input type="password" name="password" placeholder="Contraseña" required class="border rounded-2xl p-4">
        </div>
        <button type="submit" name="agregar" class="mt-8 bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-2xl font-bold flex items-center gap-2">
            <i class="fa-solid fa-user-plus"></i> Agregar Vendedor
        </button>
    </form>

    <!-- LISTA DE VENDEDORES -->
    <table class="w-full text-left">
        <thead>
            <tr class="bg-black text-white">
                <th class="p-4">Nombre</th>
                <th class="p-4">Email</th>
                <th class="p-4">Fecha de creación</th>
                <th class="p-4">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y dark:divide-slate-700">
        <?php
        $stmt = $pdo->query("SELECT * FROM usuarios WHERE rol = 'vendedor' ORDER BY id DESC");
        while ($v = $stmt->fetch()) {
            echo "
            <tr class='hover:bg-slate-100 dark:hover:bg-slate-800'>
                <td class='p-4 font-semibold'>{$v['nombre']}</td>
                <td class='p-4'>{$v['email']}</td>
                <td class='p-4'>{$v['creado_en']}</td>
                <td class='p-4'>
                    <a href='?eliminar={$v['id']}' onclick=\"return confirm('¿Eliminar este vendedor?')\" 
                       class='text-red-600 hover:underline flex items-center gap-1'>
                        <i class='fa-solid fa-trash'></i> Eliminar
                    </a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
// PROCESAR AGREGAR
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'vendedor')");
    $stmt->execute([$nombre, $email, $pass]);

    header("Location: usuarios.php");
    exit;
}

// PROCESAR ELIMINAR
if (isset($_GET['eliminar'])) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ? AND rol = 'vendedor'");
    $stmt->execute([$_GET['eliminar']]);
    header("Location: usuarios.php");
    exit;
}
?>

<?php require_once '../includes/footer.php'; ?>