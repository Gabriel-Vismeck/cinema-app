<?php
require("../../config.php");

$id = $_GET['funcionario'];

$sql = "DELETE FROM funcionario WHERE idFuncionario = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/funcionario/lista-funcionarios.php");
die();

?>