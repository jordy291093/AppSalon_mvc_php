<h1 class="nombre-pagina">Nuevo Servicios</h1>
<p class="descripcion-pagina">Llenar los campos para agregar un nuevo servicio</p>

<?php include_once __DIR__ . '/../template/alertas.php'; ?>

<form class="formulario" action="/servicios/crear" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    
    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Guardar Servicio">

        <a href="/servicios" class="boton btn-rojo">Cancelar</a>
    </div>
</form>