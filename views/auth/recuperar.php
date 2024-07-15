<h1 class="nombre-pagina">Reestablecer Password</h1>
<p class="descripcion-pagina">Escribir tu nuevo password.</p>

<?php include_once __DIR__ . '/../template/alertas.php'; ?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Tu nuevo password" name="password">
        <i class="fa-solid fa-eye"></i>
    </div>

    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Guardar">

        <a href="/" class="boton btn-rojo">Cancelar</a>
    </div>
</form>

<?php 
    $script = "<script src='build/js/principal.js'></script>";
?>