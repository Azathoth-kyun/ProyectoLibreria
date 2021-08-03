<?php
//Autenticación para el inicio de sesión
session_start();

include "../constant/config.php";


if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['user']);
    $password = mysqli_real_escape_string($con,$_POST['password']);


    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from usuario where username='".$uname."' and password='".$password."' and estado=00";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location:../../panel/');
        }else{
            $result="<div class='notification is-warning'>
            Usuario y/o contraseña invalida.
            </div>";
            $_SESSION['result'] = $result;
            header('Location: ../../index.php');
        }

    }

}
?>