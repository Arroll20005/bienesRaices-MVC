
<fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="vendedores[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedores->nombre) ; ?>">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="vendedores[apellido]" placeholder="Apellido Vendedor" value="<?php echo s($vendedores->apellido) ; ?>">

            <legend>Información de Contacto</legend>

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="vendedores[telefono]" placeholder="Teléfono Vendedor" value="<?php echo s($vendedores->telefono) ; ?>">


    


        </fieldset>