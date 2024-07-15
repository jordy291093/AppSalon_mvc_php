<h1 class="nombre-pagina">crear cuenta</h1>
<p class="descripcion-pagina">Llenar el formulario para crear una cuenta</p>

<?php 
    include_once __DIR__ . "/../template/alertas.php";
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre); ?>" name="nombre">
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido); ?>" name="apellido">
    </div>

    <div class="campo">
        <label for="fechaNac">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNac" value="<?php echo s($usuario->fechaNac); ?>" name="fechaNac">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" placeholder="Tu teléfono" value="<?php echo s($usuario->telefono); ?>" name="telefono">
    </div>

    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Tu email" value="<?php echo s($usuario->email); ?>" name="email">
    </div>

    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
        <i class="fa-solid fa-eye"></i>
    </div>

    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Crear cuenta">

        <a href="/" class="boton btn-rojo">Cancelar</a>
    </div>
</form>

<?php 
    $script = "<script src='build/js/principal.js'></script>";
?>