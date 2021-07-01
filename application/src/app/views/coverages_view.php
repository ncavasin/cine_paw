<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>
    <link rel="stylesheet" type='text/css' href="assets/css/coberturas.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/form.css" />
    <link rel="stylesheet" type='text/css' href="assets/css/notification.css" />
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>

    <main>
        <?php require 'parts/notification_view.php' ?>
        <section>
            <form action="#" method="POST" target="_self" class="busqueda">
                <label for="busqueda">Buscar:</label>
                <input type="search" id="busqueda" name="busqueda" placeholder="Galeno" autofocus tabindex="1" autocomplete="on" />
            </form>
            <?php if ($busqueda && $isValid && (count($resultado) > 0)) : ?>
                <?php foreach ($resultado as $item) : ?>
                    <p> <?= $item ?> </p>
                <?php endforeach; ?>
            <?php endif; ?>
            <h2>OBRAS SOCIALES</h2>
            <ul class='lista_cobertura'>
                <li>
                    ACA Salud Coop. Prest. Serv. Med.
                </li>
                <li>
                    AME Banco Provincia Buenos Aires
                </li>
                <li>
                    Asociación Mutual Sancor (Medicina Privada)
                </li>
                <li>
                    ASE – Acción Social de Empresarios
                </li>
                <li>
                    ASE – Asociación civil – Medifé Asociación civil
                </li>
                <li>
                    Asociación Odontológica Argentina Fund. Serv. Soc. Techint
                </li>
                <li>
                    Galeno Argentina S.A.
                </li>
                <li>
                    Hospital Británico Plan Salud
                </li>
                <li>
                    Medifé S.A. – Serv. Asist. Médicos
                </li>
                <li>
                    Obra Social del Poder Judicial
                </li>
                <li>
                    Osde Binario
                </li>
                <li>
                    Osdipp (Obra Social de Dirección de Personal de Industria Privada del Petróleo)
                </li>
                <li>
                    Osmecon Salud – Lomas de Zamora (Obra Social de Médicos del Conurbano)
                </li>
                <li>
                    Prevención Salud
                </li>
                <li>
                    Swiss Medical GROUP
                </li>
                <li>
                    Unión Personal
                </li>
                <li>
                    Universidad Tecnológica Nacional (DASUTEN)
                </li>
            </ul>
            <h2>EMBAJADAS</h2>
            <ul class='lista_cobertura'>
                <li>
                    Embajada Alemana
                </li>
                <li>
                    Embajada Británica
                </li>
                <li>
                    Embajada Emiratos Árabes Unidos
                </li>
                <li>
                    Embajada de Arabia Saudita
                </li>
                <li>
                    Embajada de Canadá
                </li>
                <li>
                    Embajada de Chile
                </li>
                <li>
                    Embajada de China
                </li>
                <li>
                    Embajada de Colombia
                </li>
                <li>
                    Embajada de Francia
                </li>
                <li>
                    Embajada de Italia
                </li>
                <li>
                    Embajada de Japón
                </li>
                <li>
                    Embajada de la Unión Europea
                </li>
                <li>
                    Embajada de los Estados Unidos
                </li>
                <li>
                    Embajada de México
                </li>
                <li>
                    Embajada de Nigeria
                </li>
                <li>
                    Embajada de Suecia
                </li>
                <li>
                    Embajada de Suiza
                </li>
                <li>
                    Embajada de Uruguay
                </li>
            </ul>


            <h2>Compañías Particulares</h2>
            <ul class='lista_cobertura'>
                <li>
                    Aerovías de México
                </li>
                <li>
                    Asociación Escolar Goethe
                </li>
                <li>
                    Asociación Cultural Pestalozzi
                </li>
                <li>
                    Chevron Argentina SRL
                </li>
                <li>
                    Cielos del Sur
                </li>
                <li>
                    Copa Airlines
                </li>
                <li>
                    General Motors de Argentina S.A.
                </li>
                <li>
                    Holters Schule
                </li>
                <li>
                    LAN Airlines
                </li>
                <li>
                    Lufthansa
                </li>
                <li>
                    Medsea (Valverde Gastón)
                </li>
                <li>
                    PSF y DEPA – UEC
                </li>
                <li>
                    Roemmers SAICF
                </li>
                <li>
                    Siemens
                </li>
                <li>
                    Soc. Esc. Alemana Villa Ballester
                </li>
                <li>
                    Toyota Argentina S.A.
                </li>
                <li>
                    Unilever de Argentina S.A.
                </li>
                <li>
                    Honda
                </li>
            </ul>

            <h2>A.R.T.</h2>
            <ul class='lista_cobertura'>
                <li>
                    ASOCIART ART
                </li>
                <li>
                    Berkley International A.R.T.
                </li>
                <li>
                    Boston Compañía Argentina de Seguros (ART)
                </li>
                <li>
                    Experta ART S.A.
                </li>
                <li>
                    Galeno ART
                </li>
                <li>
                    La Meridional Cía. Arg. de Seguros
                </li>
                <li>
                    Swiss ART S.A. (Liberty A.R.T. S.A.)
                </li>
                <li>
                    Osdipp A.R.T. Accidentes de Trabajo
                </li>
                <li>
                    Prevención A.R.T.
                </li>
                <li>
                    PROFRU ART
                </li>
                <li>
                    QBE Seguros la Buenos Aires S.A.
                </li>
            </ul>
        </section>
    </main>

    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>