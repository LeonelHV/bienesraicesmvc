<main class="contenedor seccion contenido-centrado">
    <h2 data-cy="heading-login">Iniciar Sesión</h2>
    <?php foreach ($errores as $error) : ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tú E-mail" id="email" />

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tú Password" id="password" />

        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>