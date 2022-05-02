<?php
session_start();

// Sesión aperturada, esta en false
if (!$_SESSION['login']){
    header('Location:../index.php?view=main-view');
}
?>
