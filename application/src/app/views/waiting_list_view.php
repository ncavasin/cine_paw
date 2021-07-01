<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>
    <link rel='stylesheet' type='text/css' href='assets/css/notification.css' />
    <link rel='stylesheet' type='text/css' href='assets/css/botones.css' />
    <link rel='stylesheet' type='text/css' href='assets/css/waiting_list.css' />
    <script src=<?= $isMedic? '/js/components/WaitingListMedic.js' : '/js/components/WaitingListUser.js' ?>></script>
</head>

<body>
    <?php
        require 'parts/header_view.php';
    ?>
    <main>
        <h2>Cargando, por favor espere..</h2>
    </main>
    <?php
        require 'parts/footer_view.php';
    ?>
</body>

</html>