let currentProductId = null;

function showModal(html) {
    document.getElementById('modal-content').innerHTML = html;
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

function cotizar(id, nombre) {
    currentProductId = id;
    const html = `
        <h2 class="text-3xl font-black mb-6">Cotizar ${nombre}</h2>
        <form action="process_cotizacion.php" method="POST">
            <input type="hidden" name="producto_id" value="${id}">
            <input type="text" name="nombre_cliente" placeholder="Tu nombre" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="email" name="email" placeholder="Correo electrónico" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="tel" name="telefono" placeholder="Teléfono" required class="w-full mb-4 border rounded-2xl p-4">
            <textarea name="mensaje" placeholder="Mensaje adicional (opcional)" rows="3" class="w-full mb-6 border rounded-2xl p-4"></textarea>
            <div class="flex gap-4">
                <button type="button" onclick="closeModal()" class="flex-1 py-4 border rounded-2xl">Cancelar</button>
                <button type="submit" class="flex-1 bg-red-600 text-white py-4 rounded-2xl font-bold">Enviar cotización</button>
            </div>
        </form>
    `;
    showModal(html);
}

function reservarPrueba(id, nombre) {
    currentProductId = id;
    const html = `
        <h2 class="text-3xl font-black mb-6">Prueba de manejo - ${nombre}</h2>
        <form action="process_prueba.php" method="POST">
            <input type="hidden" name="producto_id" value="${id}">
            <input type="text" name="nombre_cliente" placeholder="Tu nombre" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="email" name="email" placeholder="Correo electrónico" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="tel" name="telefono" placeholder="Teléfono" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="date" name="fecha_prueba" required class="w-full mb-4 border rounded-2xl p-4">
            <input type="time" name="hora_prueba" required class="w-full mb-4 border rounded-2xl p-4">
            <textarea name="mensaje" placeholder="Mensaje adicional" rows="3" class="w-full mb-6 border rounded-2xl p-4"></textarea>
            <div class="flex gap-4">
                <button type="button" onclick="closeModal()" class="flex-1 py-4 border rounded-2xl">Cancelar</button>
                <button type="submit" class="flex-1 bg-red-600 text-white py-4 rounded-2xl font-bold">Reservar Prueba</button>
            </div>
        </form>
    `;
    showModal(html);
}

// Cerrar modal con Escape
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});