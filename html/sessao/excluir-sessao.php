<?php
require("../../config.php");

// TODO Ver se não tem nada associado, e avisar o usuário

$id = $_GET['sessao'];

$sql = "DELETE FROM sessao WHERE idSessao = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/sessao/lista-sessoes.php");
die();

?>