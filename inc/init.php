<?php

session_start();
if(isset($_POST['varName'])) {
    $varName = $_POST['varName']; // leggi il nome della variabile di sessione
    $varValue = $_SESSION[$inizio]; // leggi il valore della variabile di sessione
    echo $varValue; // restituisci il valore come una risposta AJAX
}

require_once './inc/config.php';
require_once ROOT_PATH .'inc/globals.php';
require_once ROOT_PATH .'classes/DB.php';
require_once ROOT_PATH .'../Clothe-u_Finale/classes/ProductsDB.php';
require_once ROOT_PATH .'classes/Cart.php';
require_once ROOT_PATH .'classes/User.php';
require_once ROOT_PATH .'classes/Order.php';

