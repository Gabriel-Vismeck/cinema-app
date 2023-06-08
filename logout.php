<?php
    session_start();

    $_SESSION = array();

    session_destroy();

    header("Location: /Projeto-Cinema/index.php");
    exit;
?>