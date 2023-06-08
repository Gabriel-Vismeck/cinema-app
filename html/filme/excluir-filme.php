<?php
require("../../config.php");

// TODO Ver se não tem nada associado, e avisar o usuário

$id = $_GET['filme'];

$sql = "DELETE FROM filme WHERE idFilme = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/filme/lista-filmes.php");
die();

?>