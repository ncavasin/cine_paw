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
    <script src="/js/components/DragAndDrop.js"></script>
    <script src="/js/components/FetchApi.js"></script>
    <script src="/js/components/TurnsForm.js"></script>
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>

    <main>
        <?php require 'parts/notification_view.php'; ?>
        <section>
            <h2>NUEVO TURNO</h2>
            <form action="" method="POST" id="form-turnos" target="_self" enctype="multipart/form-data">
                <fieldset id='fieldset-inputs'>
                    <label for="especialidad">Especialidad</label>
                    <input list="especialidad-lista" id="especialidad" name="especialidad" placeholder="Kinesiología" autocomplete="off" autofocus/>
                    <label for="especialista">Especialista</label>
                    <input list="especialista-lista" id="especialista" name="especialista" placeholder="Fulano" autocomplete="off"/>
                    <label for='orden_medica' id='label_orden' class='label_orden'>Orden Médica
                        <input type="file" id='orden_medica' class="orden_medica input_hidden"
                                name='orden_medica' 
                                accept="application/pdf" 
                        />
                    </label>
                </fieldset>
                <fieldset id='fieldset-buttons'>
                    <input id='reset' type="reset" form="form-turnos" name="reset" value="Limpiar" class="limpiar"/>
                </fieldset>
            </form>
        </section>
    </main>
    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>