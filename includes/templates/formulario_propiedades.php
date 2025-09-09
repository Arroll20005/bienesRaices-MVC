<?php 


?>
<fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="propiedades[titulo]" placeholder="Título Propiedad" value="<?php echo s($propiedades->titulo) ; ?>">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="propiedades[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedades->precio) ; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="propiedades[imagen]" accept="image/jpeg, image/png">

            <?php  if(isset($propiedades) && $propiedades?->imagen):?>
            <p>Imagen Actual:</p>

            <img src="../../imagenes/<?php echo $propiedades->imagen ?>" alt="Imagen Propiedad" class="imagen-small">

            <?php endif; ?>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="propiedades[descripcion]" placeholder="Descripción"><?php echo s($propiedades->descripcion  )?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Adicional</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedades[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedades->habitaciones ); ?>">

            <label for="WC">Baños</label>
            <input type="number" id="WC" name="propiedades[WC]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedades->WC ); ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="propiedades[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedades->estacionamiento ); ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <label for ="vendedor">Vendedor</label>
            <select name="propiedades[vendedores_idvendedores]" id="vendedor">
    <option value="" disabled selected>--Seleccione--</option>
    <?php foreach($vendedores as $vendedor){ ?>
       
       <option 
    value="<?php echo $vendedor->idvendedores ?>"
    <?php echo $propiedades->vendedores_idvendedores == $vendedor->idvendedores ? 'selected' : ''; ?>
>
    <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
</option>
    <?php };?>
</select>
        </fieldset>
