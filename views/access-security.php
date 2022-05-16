<?php
session_start();

// Sesión aperturada, esta en false
if (!isset($_SESSION['login']) || isset($_SESSION['login']) && $_SESSION['rol'] != 'A'){
    header('Location:index.php');
} 
?>
