<div class="barra">
    <p class="usuario">Bienvenido(a): <span><?php echo $nombre ?? ''; ?></span></p>
    <a class="boton btn-rojo" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a class="boton btn-azul" href="/admin">Ver citas</a>
        <a class="boton btn-azul" href="/servicios">Ver servicios</a>
        <a class="boton btn-azul" href="/servicios/crear">Nuevo Servicio</a>
    </div>
<?php } ?>