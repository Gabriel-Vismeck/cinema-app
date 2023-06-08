<?php
require("../../config.php");

// TODO Ver se não tem nada associado, e avisar o usuário

$id = $_GET['setor'];

$sql = "DELETE FROM setor WHERE idSetor = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/setor/lista-setores.php");
die();

?>