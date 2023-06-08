<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

$sql = "SELECT * FROM Filme INNER JOIN Fornecedor ON Filme.idFornecedor = Fornecedor.idFornecedor;";
$filmes = Buscar($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Lista de Filmes</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/lista-filmes.css">

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

        <h1 class="text-center my-4" style="color: var(--branco);">Lista de Filmes</h1>

        <br>
        
        <a class="botao-componente" href="cadastro-filme.php">Cadastrar filme</a>
        <a class="botao-componente botao-alternativo" href="historico-filmes.php">Histórico de filmes</a>

        <div class="lista fundo-cinza my-4">
            <div class="linha linha-cabeca">
                <div>Título</div>
                <div>Sinopse</div>
                <div>Ano de Lançamento</div>
                <div>Duração</div>
                <div>Fornecedor</div>
                <div>Poster</div>
                <div></div>
            </div>
            <?php
            foreach ($filmes as $linha) {
                echo "
                        <div class='linha'>
                            <div>{$linha["titulo"]}</div>
                            <div>{$linha["sinopse"]}</div>
                            <div>{$linha["dataLancamento"]}</div>
                            <div>{$linha["duracao"]} minutos</div>
                            <div>{$linha["nome"]}</div>
                            <div class='item-imagem'>
                                <img src='{$linha["urlPoster"]}'>
                            </div>
                            <div class='item-acoes'>
                                <a href='cadastro-filme.php?filme={$linha["idFilme"]}'>
                                    <i class='item-animacao fa-solid fa-pen'></i>
                                </a>
                                <a href='excluir-filme.php?filme={$linha["idFilme"]}'>
                                    <i class='item-animacao fa-solid fa-trash'></i>
                                </a>
                            </div>
                        </div>";
            }
            ?>
        </div>
    </div>

    <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>