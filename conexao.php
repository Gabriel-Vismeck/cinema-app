<?php
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    function conectadb () {
        $endereco = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "ProjetoCinema";

        try {
            $con = new mysqli ($endereco, $usuario, $senha, $banco);
            $con->set_charset("utf8");
            return $con;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>