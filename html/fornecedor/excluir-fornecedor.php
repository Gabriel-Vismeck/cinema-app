<?php
require("../../config.php");

// TODO Ver se não tem nada associado, e avisar o usuário

$id = $_GET['fornecedor'];

$sql = "DELETE FROM fornecedor WHERE idFornecedor = $id";

Executar($sql);

header("Location: /Projeto-Cinema/html/fornecedor/lista-fornecedores.php");
die();

?>