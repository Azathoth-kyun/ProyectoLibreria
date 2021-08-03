<?php
//Session para mantener conectado
session_start();

if($_SESSION['uname'] != null || $_SESSION['uname'] != ""){
    header('Location: panel/');
}

$count=0;

if($_SESSION['result'] != null || $_SESSION['result'] !=""){
    $count=1;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Ceintec.RN</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/bulma-0.8.0/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/short-book.png"/>
</head>
<body>
<section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Librería Ceintec.RN</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Ingrese para iniciar</p>
                    <div class="box">
                        <figure class="avatar">
                            <img class="size-avatar" src="assets/img/Hoxbxret.jpg">
                        </figure>
                        <form action="assets/app/auth.php" method="POST" autocomplete="OFF">
                            <?php if($_SESSION['result'] != null || $_SESSION['result'] !=""){
                                if($count==1){
                                    echo $_SESSION['result'];
                                    $_SESSION['result'] = "";
                                }
                            }?>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="text" name="user" placeholder="Tu usuario" autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" name="password" placeholder="Tu clave">
                                </div>
                            </div>
                            <div class="field">
                            </div>
                            <button type="submit" name="but_submit" id="but_submit" class="button is-block is-info is-large is-fullwidth">Entrar <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script async type="text/javascript" src="assets/js/bulma.js"></script>
    <script async type="text/javascript" src="assets/js/close_notification.js"></script>
</body>
</html>