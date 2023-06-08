<?php
require("../config.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Menu </title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/menu-funcionario.css">

    <!-- JS -->
    <script src="/Projeto-Cinema/js/barra-lateral.js"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/708face580.js" crossorigin="anonymous"></script>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
    <div class="conteudo">
        <?php
        // Colocar a barra lateral
        importar("/html/compartilhado/barra-lateral.php");

        // Colocar o header
        importar("/html/compartilhado/header-funcionario.php");
        ?>

        <div class="menu-funcionario fundo-cinza my-5 ">
            <div class="text-center">
                <h1>Olá, seja bem vindo(a)!</h1>
                <hr>
                <h4>O que gostaria de fazer hoje?</h4>
                <br>
            </div>
            <div class="grid-caixas">
                <a href="fornecedor/lista-fornecedores.php" class="caixa">
                    <i class="tamanho fa-solid fa-truck"></i>
                    <p>Fornecedores</p>
                </a>
                <a href="filme/lista-filmes.php" class="caixa">
                    <i class="tamanho fa-solid fa-film"></i>
                    <p>Filmes</p>
                </a>
                <a href="cinema/lista-cinemas.php" class="caixa">
                    <i class="tamanho fa-solid fa-location-dot"></i>
                    <p>Cinemas</p>
                </a>
                <a href="sala/lista-salas.php" class="caixa">
                    <i class="tamanho fa-solid fa-door-closed"></i>
                    <p>Salas</p>
                </a>
                <a href="sessao/lista-sessoes.php" class="caixa">
                    <i class="tamanho fa-solid fa-clock"></i>
                    <p>Sessões</p>
                </a>
                <a href="cliente/lista-clientes.php" class="caixa">
                    <i class="tamanho fa-solid fa-user"></i>
                    <p>Clientes</p>
                </a>
                <a href="funcionario/lista-funcionarios.php" class="caixa">
                    <i class="tamanho fa-solid fa-user-tie"></i>
                    <p>Funcionários</p>
                </a>
                <a href="setor/lista-setores.php" class="caixa">
                    <i class="tamanho fa-solid fa-users"></i>
                    <p>Setores</p>
                </a>
                <a href="relatorio/relatorio-entrada.php" class="caixa">
                    <i class="tamanho fa-solid fa-chart-line"></i>
                    <p>Relatórios</p>
                </a>
            </div>
        </div>
    </div>

    <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>