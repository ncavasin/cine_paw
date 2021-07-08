<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>
    <link rel="stylesheet" type='text/css' href="assets/css/index.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/main.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/sel_tickets.css" />
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>
    <main>
        <h2>Resumen de compra</h2>
        <section class='content card'>
            <h3><?= $movie . ' (' . $lang . ' - ' . $lang . ')' ?></h3>
            <p><?= $date . ' ' . $hour . ' hs' ?></p>
            <p><?= $general ?> general</p>
            <p><?= $child ?> niños</p>
           
        </section>
    </main>
    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>