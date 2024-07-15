<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Modifica la información del formulario</p>

<?php include_once __DIR__ . '/../template/alertas.php'; ?>

<form class="formulario" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    
    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Actualizar">

        <a href="/servicios" class="boton btn-rojo">Cancelar</a>
    </div>
</form>