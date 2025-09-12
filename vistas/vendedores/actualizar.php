<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php if (!empty($errores)): ?>
        <div class="alerta error">
            <?php foreach ($errores as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form class="formulario" action="/vendedores/actualizar" method="POST" enctype="multipart/form-data">
         <?php include __DIR__ . '/formulario.php'; ?>
        
        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>
</main>