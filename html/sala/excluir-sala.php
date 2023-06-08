<?php
require("../../config.php");

// TODO Ver se não tem nada associado, e avisar o usuário

$id = $_GET['sala'];

$sql = "DELETE FROM sala WHERE idSala = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/sala/lista-salas.php");
die();

?>