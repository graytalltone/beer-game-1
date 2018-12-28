<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'beer_game'; 
$db = mysqli_connect($host, $user, $pass, $dbName) or die('Error with MySQL connection');
mysqli_query($db, "SET NAMES utf8");

function checkLogin() {
	if ( ! isset($_SESSION["loginID"])) {
            header("Location: login.php");
            exit();
	}
}
?>