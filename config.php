<?php

session_start();

function importar($caminho) {
    // DOCUMENT_ROOT é onde o php está ex: c:\xampp\htdocs\
    // Juntando o caminho do parametro
    // Fica c:\xampp\htdocs\Projeto-Cinema/html/assentos.php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Projeto-Cinema' . $caminho);
}

function EstaLogado() {
    return EstaLogadoCliente() || EstaLogadoFuncionario();
}

function EstaLogadoCliente() {
    return isset($_SESSION) && isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == "Cliente";
}

function EstaLogadoFuncionario() {
    return isset($_SESSION) && isset($_SESSION['tipoUsuario']) && ($_SESSION['tipoUsuario'] == "Funcionario");
}

function GerarConexao() {
    $endereco = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "ProjetoCinema";

    $con = new mysqli ($endereco, $usuario, $senha, $banco);
    $con->set_charset("utf8");
    return $con;
}

function Inserir($sql) {
    $conexao = GerarConexao();

    mysqli_query($conexao, $sql);

    $idInsercao = mysqli_insert_id($conexao);

    mysqli_close($conexao);

    return $idInsercao;
}

function Buscar($sql) {
    $conexao = GerarConexao();

    $resultado = mysqli_query($conexao, $sql);
    
    mysqli_close($conexao);

    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function Executar($sql) {
    $conexao = GerarConexao();

    mysqli_query($conexao, $sql);
    
    mysqli_close($conexao);
}

function ehSelecionado($itemBanco, $itemLinha) {
    return ($itemBanco ?? '') == $itemLinha ? 'selected' : '';
}

?>