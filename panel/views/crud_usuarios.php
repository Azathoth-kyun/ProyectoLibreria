<?php

session_start();

$_SESSION['result']= "";

include "/libreria/assets/constant/config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: /libreria/index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: /libreria/index.php');
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
    <link rel="stylesheet" type="text/css" href="../../assets/css/bulma-0.8.0/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/footer.css">
    <link rel="shortcut icon" type="image/png" href="../../assets/img/short-book.png" />
    </head>
    <body>
    <div class="container is-fluid">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <?php require '../header.php'; ?>
    </nav>
    <div class="container" style="margin-top: 60px;">
        <?php require '../dataset/usuarios/index.php'; ?>
    </div>
	<div class="has-text-centered">
		<a onclick="aniadir();" class="button is-rounded is-success">
			<span class="icon">
			    <i class="fa fa-plus-circle"></i>
    		</span>
    		<span>Añadir</span>
		</a>
	</div>
    <?php require '../footer.php'; ?>
    </div>
    <script async type="text/javascript" src="../../assets/js/bulma.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/navbar_item.js"></script>
    <script type="text/javascript">
    function aniadir() {
        window.location.href= '/libreria/panel/dataset/usuarios/add.php';
     }
	</script>
    </body>
</html>