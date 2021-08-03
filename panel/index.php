<?php

session_start();

$_SESSION['result']= "";

include "../assets/constant/config.php";

// Checa el user si esta logeado o no
if(!isset($_SESSION['uname'])){
    header('Location: ../index.php');
}

// Cerrar sesión
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: ../index.php');
}
?>
<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Librería</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/bulma-0.8.0/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="shortcut icon" type="image/png" href="../assets/img/short-book.png" />
    </head>
    <body>
    <div class="container is-fluid">
    <!--Navbar superior-->
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <?php require 'header.php'; ?>
    </nav>
    <!--Sección que muestra datos para rellenar-->
    <?php require 'section.php'; ?>
    <!--Footer-->
    <?php require 'footer.php'; ?>
    </div>
    <script async type="text/javascript" src="../assets/js/bulma.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/navbar_item.js"></script>
    </body>
</html>