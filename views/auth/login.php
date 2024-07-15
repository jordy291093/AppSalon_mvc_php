<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . '/../template/alertas.php'; ?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Tu email" name="email">
    </div>

    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
        <i class="fa-solid fa-eye"></i>
    </div>
    
    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Iniciar Sesión">
    </div>
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>

<?php 
    $script = "<script src='build/js/principal.js'></script>";
?>