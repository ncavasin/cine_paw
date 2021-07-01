<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>


    <link rel="stylesheet" type='text/css' href="assets/css/index.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/botones.css" />
    <script src="/js/components/Carrousel.js"></script>
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>
    <main>
        <section id="carrousel" class="car_container">
            <progress max="100" min="0"></progress> 
            <figure id="slides_container" class="slides_container">
                <img src="/assets/img/carrousel0.jpg" class="slide efecto2"/>
                <img src="/assets/img/carrousel1.jpg" class="slide efecto1"/>
                <img src="/assets/img/carrousel2.jpg" class="slide efecto3"/>
            </figure>
        </section>
        <section>
            <h2>NUESTROS SERVICIOS</h2>
            <ul>
                <li>
                    <h3><a href="services/audiologia" target="_self" class='button servicio'>Audiología</a></h3>
                </li>
                <li>
                    <h3><a href="services/cardiologia" target="_self" class='button servicio'>Cardiología</a></h3>
                </li>
                <li>
                    <h3><a href="services/densitometria" target="_self" class='button servicio'>Densitometría</a></h3>
                </li>
                <li>
                    <h3><a href="services/ecografia_doppler" target="_self" class='button servicio'>Ecografía Doppler</a></h3>
                </li>
                <li>
                    <h3><a href="services" target="_self" class='button servicio'>Ver más</a></h3>
                </li>
            </ul>
        </section>
    </main>

    <?php
        require 'parts/footer_view.php';
    ?>

</body>

</html>