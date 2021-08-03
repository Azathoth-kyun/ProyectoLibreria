<?php
//Conexión a la BD
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = "12345678"; /* Password */
$dbname = "sislyb_bd"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}