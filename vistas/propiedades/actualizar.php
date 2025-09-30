<main class="contenedor seccion">
    <h1>Actualizar</h1>
    
        <?php if (!empty($errores)): ?>
        <div class="alerta error">
            <?php foreach ($errores as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!--Formulario de creación-->
    <a href="/admin" class="boton boton-verde">Volver</a>
    <form action= "/propiedades/actualizar?id= <?php echo $propiedades->id; ?>" class="formulario"  method="POST" enctype="multipart/form-data">
      <?php include __DIR__ . '/formulario.php'; ?>
    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
  
</main>