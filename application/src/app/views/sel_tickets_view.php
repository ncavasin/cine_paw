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
        <h2>Seleccion de entradas</h2>
        <section class='content card'>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>General</td>
                        <td>$700</td>
                        <td class='cant'>0</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td>Niño</td>
                        <td>$300</td>
                        <td class='cant'>0</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total:</td>
                        <td>$0</td>
                    </tr>
                </tbody>
            </table>

        </section>
    </main>
    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>