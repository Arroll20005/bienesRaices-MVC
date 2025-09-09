<main class="contenedor seccion">
    <h1>Crear</h1>
    
        <?php if (!empty($errores)): ?>
        <div class="alerta error">
            <?php foreach ($errores as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!--Formulario de creación-->
    <form action= "/propiedades/crear" class="formulario"  method="POST" enctype="multipart/form-data">
      <?php include __DIR__ . '/formulario.php'; ?>
    <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
  
</main>