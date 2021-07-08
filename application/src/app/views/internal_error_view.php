<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <?php
            require 'parts/head_view.php'
        ?>
        <link rel="stylesheet" type='text/css' href="assets/css/index.css"/>   
        <link rel="stylesheet" type='text/css' href="assets/css/main.css"/>
        <link rel="stylesheet" type='text/css' href="assets/css/not_found.css"/>
    </head>
    <body>
        <?php 
            require 'parts/header_view.php';
        ?>
        
        <main>
            <h2><?= $titulo ?? "ERROR 500 - ERROR INTERNO DEL SERVIDOR" ?></h2>
            <section>

            </section>
        </main>
        <?php 
            require 'parts/footer_view.php';
        ?>
    </body>
</html>
