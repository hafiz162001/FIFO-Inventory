<?php  

session_start();

if (!isset($_SESSION['login'])) {
	header("location:../index");
}

if ($_SESSION['level'] != "upengadaan"){
	header("location:../index");	
}


?>