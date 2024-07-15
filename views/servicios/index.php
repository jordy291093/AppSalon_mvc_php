<?php include_once __DIR__ . '/../template/barra.php'; ?>

<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de servicios</p>

<ul class="servicios">
    <?php foreach ($servicios as $servicio) { ?>
    <li>
        <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>

        <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>

        <div class="botones">
            <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton btn-azul">Actualizar</a>
            <form action="/servicios/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">

                <input type="submit" value="Eliminar" class="boton btn-rojo">
            </form>
        </div>
    </li>
    <?php } ?>
</ul>