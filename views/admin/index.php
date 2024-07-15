<?php include_once __DIR__ . '/../template/barra.php'; ?>

<h1 class="nombre-pagina">Panel de Administración</h1>

<h2>Buscar Citas:</h2>
<div class="busqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha: </label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php 
    if (count($citas) === 0) {
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCita = 0;
            foreach ($citas as $key => $cita) {
                if ($idCita !== $cita->id) { 
                    $total = 0;
        ?>  <!--Evitar repetir id-->
            <li>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                <p>Email: <span><?php echo $cita->email; ?></span></p>
                <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>

                <h2>Servicios</h2>
        <?php
                $idCita = $cita->id;
                } // fin de if 
            $total += $cita->precio;
        ?>
                <p class="servicio"><?php echo $cita->servicio . " - $" . $cita->precio; ?></p>
        <?php
            $actual = $cita->id; // Verifica cada id de la cita
            $proximo = $citas[$key + 1]->id ?? 0;
            
            if (esUltimo($actual, $proximo)) { ?>
                <p class="total">Total: <span>$<?php echo $total; ?></span></p>

                <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">

                    <input type="submit" class="boton btn-rojo" value="Eliminar">
                </form>
        <?php } 
        } // fin de foreach ?>
    </ul>
</div>

<?php 
    $script = "<script src='build/js/buscador.js'></script>";
?>