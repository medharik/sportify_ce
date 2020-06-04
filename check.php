<?php
session_start(); 
include("models/user.class.php");
User::connect_db();
extract($_POST);
User::verifier($login,$passe,"login.php");
header("location:views/abonnes/index.php");
?>