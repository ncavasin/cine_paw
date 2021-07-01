<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <?php
            require 'parts/head_view.php'
        ?>
        <link rel="stylesheet" type='text/css' href="assets/css/index.css"/>   
        <link rel="stylesheet" type='text/css' href="assets/css/main.css"/>   
    </head>
    <body>
        <?php 
            require 'parts/header_view.php';
        ?>
        
        <main>
            <h2><?= $titulo ?? "" ?></h2>
        </main>
        <?php 
            require 'parts/footer_view.php';
        ?>
    </body>
</html>
