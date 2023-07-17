<?php 
    session_start();
    unset($_SESSION['USER-ID']);
    header('Location: ../index.php');

?>