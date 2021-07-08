<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php require 'parts/head_view.php'    ?>
    <link rel='stylesheet' type='text/css' href='assets/css/form.css' />
    <link rel='stylesheet' type='text/css' href='assets/css/notification.css' />
    <link rel='stylesheet' type='text/css' href='assets/css/botones.css'/>
</head>

<body>
    <?php require 'parts/header_view.php';    ?>
    <main>
        <h2>REGISTRARSE</h2>
        <section>
            <?php require 'parts/notification_view.php'; ?>

            <!--<img src="/assets/img/Imagen_Registrar.jpg" alt="Imagen para Registrarse" width="300">-->

            <form action="#" method="POST" target="_self">
                <fieldset>
                    <label for="nombre" class="required">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Fulano" autofocus required tabindex="1" autocomplete="on" />

                    <label for="apellido" class="required">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="De tal" required tabindex="2" autocomplete="on" />

                    <label for="dni" class="required">DNI:</label>
                    <input type="text" id="dni" name="dni" placeholder="30.200.100" required tabindex="3" autocomplete="on" />
                    
                    <label for="fnac" class="required">Fecha de Nacimiento</label>
                    <input type="date" id="fnac" name="fnac" required tabindex="4" autocomplete="on" />
                </fieldset>

                <fieldset>
                    <!-- pattern="+[0-9]{2}[0-9]{1}[0-9]{4}"-->
                    <label for="celular" class="required">Celular</label>
                    <input type="tel" id="celular" name="celular" placeholder="+54 9 1144556677" required tabindex="5" autocomplete="on" />
                </fieldset>

                <fieldset>
                    <label for="mail" class="required">Correo Electrónico</label>
                    <input type="mail" id="mail" name="mail" placeholder="usuario@correo.com" required tabindex="6" autocomplete="on" />

                    <label for="conf_mail" class="required">Confirmación</label>
                    <input type="mail" id="conf_mail" name="conf_mail" placeholder="usuario@correo.com" required tabindex="7" />
                </fieldset>

                <fieldset>
                    <label for="pwd" class="required">Contraseña</label>
                    <input type="password" id="pwd" name="pwd" placeholder="Contraseña" required tabindex="8" />

                    <label for="conf_pwd" class="required">Confirmación</label>
                    <input type="password" id="conf_pwd" name="conf_pwd" placeholder="Contraseña" required tabindex="9" />
                </fieldset>
                <input type="submit" value="Registrarse" class="main_button"/>
            </form>
        </section>
    </main>

    <?php require 'parts/footer_view.php';    ?>
</body>

</html>