<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Escribir email para recuperar contraseña</p>

<?php include_once __DIR__ . '/../template/alertas.php'; ?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Tu email" name="email">
    </div>

    <div class="botones">
        <input type="submit" class="boton btn-azul" value="Recuperar">
        
        <a href="/" class="boton btn-rojo">Cancelar</a>
        
    </div>
</form>