<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <?php
            require 'parts/head_view.php'
        ?>
        <link rel='stylesheet' type='text/css' href='assets/css/form.css' />
        <link rel='stylesheet' type='text/css' href='assets/css/notification.css' />
        <link rel='stylesheet' type='text/css' href='assets/css/botones.css'/>
    </head>
    <body>
        <?php 
            require 'parts/header_view.php';
        ?>
        <main>
            <?php require 'parts/notification_view.php'; ?>
            <h2>INICIAR SESIÓN</h2>
            <section>
                <?php if ($procesado) : ?>
                    <?php if ($is_valid) : ?>
                        <p style='color: green'>Logeado con éxito</p>
                    <?php else : ?>
                        <p style='color: red'>Usuario o contraseña incorrecto</p>
                    <?php endif; ?>
                <?php endif; ?>
                <form action="#" method="POST" target="_self">
                    <fieldset>
                        <label for="mail">Correo Electrónico:</label>
                        <input type="email" id="mail" name="mail" 
                        placeholder="usuario@correo.com" 
                        required tabindex="1" autocomplete="on"/>
                        
                        <label for="pwd">Contraseña:</label>
                        <input type="password" id="pwd" name="pwd" 
                        placeholder="ultra secure password" 
                        required tabindex="2" autocomplete="on"/>
                    </fieldset>

                    <a href="/reset_password" target="_self">¿Olvidaste tu contraseña?</a>
                    <a href="/register" target="_self">Registrarse</a>

                    <input type="submit" value="Ingresar" class="main_button"/>
                </form>
            </section>
        </main>
        
        <?php 
            require 'parts/footer_view.php';
        ?>
    </body>
</html>
