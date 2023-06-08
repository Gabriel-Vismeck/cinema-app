<?php
require("../../config.php");

// TODO Ver se não tem uma sala ou funcionário associado, e avisar o usuário

$id = $_GET['excluir'];

$sql = "DELETE FROM cinema WHERE idCinema = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/cinema/lista-cinemas.php");
die();

?>