<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>
    <link rel="stylesheet" type='text/css' href="assets/css/form.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/turnos.css" />
    <link rel='stylesheet' type='text/css' href='assets/css/notification.css' />
    <link rel='stylesheet' type='text/css' href='assets/css/botones.css' />
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>

    <main>
        <section>
            <a class='navigation-button' target='_self' href="/newturn">Nuevo turno</a>
            <a class='navigation-button' target='_self' href="/waiting_list">Sala de espera</a>
            <a class='navigation-button' target='_self' href="/waiting_list?rol=medic">Sala de espera (Medico)</a>
        </section>
        <section>
            <h2>HISTORIAL DE TURNOS</h2>
            <p>Aún no tenes turnos registrados</p>
<!--             <table id="table-mis-turnos">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th>Especialidad</th>
                        <th>Especialista</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="especialidad">Resonancia</td>
                        <td class="especialista">Fulano</td>
                        <td class="fecha">16/04/2021</td>
                        <td class="hora">16:30</td>
                    </tr>
                    <tr>
                        <td class="especialidad">Resonancia</td>
                        <td class="especialista">Fulano</td>
                        <td class="fecha">16/04/2021</td>
                        <td class="hora">16:30</td>
                    </tr>
                    <tr>
                        <td class="especialidad">Resonancia</td>
                        <td class="especialista">Fulano</td>
                        <td class="fecha">16/04/2021</td>
                        <td class="hora">16:30</td>
                    </tr>
                </tbody>
            </table> -->
        </section>
    </main>

    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>