<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>


    <link rel="stylesheet" type='text/css' href="assets/css/index.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/botones.css" />
    <script src="/js/components/Carrousel.js"></script>
    <script src="/js/components/MovieList.js"></script>
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>
    <main>
        <section id="carrousel" class="car_container transparent">
            <progress max="100" min="0"></progress> 
            <figure id="slides_container" class="slides_container">
                <img src="/assets/img/carousel0.jpg" class="slide efecto4"/>
                <img src="/assets/img/carousel1.jpg" class="slide efecto4"/>
                <img src="/assets/img/carousel2.jpg" class="slide efecto4"/>
            </figure>
        </section>
        <h2>Cartelera</h2>
        <section class='transparent'>
            <ul class='peliculas'>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 1</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 2</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 3</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 4</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 5</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 6</p>
                    <p>Duracion 120 min</p>
                </li>
                <li>
                    <img src='/assets/img/portada.jpg' class='portada'/>
                    <p>Pelicula 7</p>
                    <p>Duracion 120 min</p>
                </li>
            </ul>
        </section>
    </main>

    <?php
        require 'parts/footer_view.php';
    ?>

</body>

</html>