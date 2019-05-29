<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>JAPAN CAR KM0</title>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css"/><!-- El base_url está en parameters.php -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="<?= base_url ?>assets/js/jquery.js"></script>
        <script src="<?= base_url ?>assets/js/valoraciones.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


<!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div id="container">

            <!-- CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="<?= base_url ?>assets/img/japan_car.jpg" alt="Logo"/>
                    <a href="<?= base_url ?>">
                        JAPAN CAR KM0
                    </a>
                </div>
            </header>

            <!-- MENU -->
            <?php $categorias = Utils::showCategorias(); ?><!--Me devuelve un array de objetos-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>

                    <?php while ($cat = $categorias->fetch_object()): ?><!--Recorre y saca objetos de todas las categorías-->
                        <li>
                            <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>
            <div id="content">