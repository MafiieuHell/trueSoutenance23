<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
}
//supprimer une variable
unset($_SESSION["user"]);

header("Location: login.php");