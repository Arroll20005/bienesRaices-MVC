 
 <main class="contenedor seccion">
        <h1>Aministradir BienesRaices</h1>

  <?php
  $resultado = $_GET['resultado'] ?? null;
if ($resultado) {
    $mensaje = mostrarNotificacion(intval($resultado)); //intval convierte en int
    if ($mensaje) { ?>
        <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php } 
}
?>


        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
         <a href="vendedores/crear" class="boton boton-verde">Nuevo Vendedor</a>
        <h2>Bienes Raices</h2>
        <table class="propiedades">
            <thead> 
                <th>ID</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </thead>
            <tbody> <!--- Mostrar resultado--> 
                

            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td ><img   src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Casa en la playa" class="imagen-tabla"></td>
                    <td>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton boton-verde-block">Actualizar</a>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>"/>
                            <input type="hidden" name="tipo" value="propiedad"/>
                               <input type="submit" value="Eliminar" class="boton boton-rojo-block">
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>







        <h2>Vendedores</h2>

          <table class="propiedades">
            <thead> 
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </thead>
            <tbody> <!--- Mostrar resultado--> 
                

            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->idvendedores; ?></td>
                    <td><?php echo $vendedor->nombre. " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->idvendedores; ?>" class="boton boton-verde-block">Actualizar</a>
                        <form method="POST" class="w-100" action="vendedores/eliminar?id =<?php echo $vendedor->idvendedores; ?>">
                            <input type="hidden" name="id" value="<?php echo $vendedor->idvendedores; ?>"/>
                            <input type="hidden" name="tipo" value="vendedor"/>
                               <input type="submit" value="Eliminar" class="boton boton-rojo-block">
                        </form>
                      
                       
                    </td>
                </tr>
            <?php endforeach; ?>
            
            </tbody>
        </table>
 </main>