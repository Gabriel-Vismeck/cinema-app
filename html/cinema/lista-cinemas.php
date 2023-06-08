<?php

require("../../config.php");

$sql = "SELECT * FROM cinema";

$cinemas = Buscar($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Lista de Cinemas</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/lista-cinemas.css">

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
    
        <h1 class="text-center my-4" style="color: var(--branco);">Lista de Cinemas</h1>
    
        <a class="botao-componente" href="cadastro-cinema.php">Cadastrar cinema</a>
    
        <div class="lista fundo-cinza my-4">
    
            <div class="linha linha-cabeca">
                <div>Nome</div>
                <div>Endereço</div>
                <div>Telefone</div>
                <div></div>
            </div>
            <?php
            foreach ($cinemas as $linha) {
                echo "
                        <div class='linha'>
                            <div>{$linha["nome"]}</div>
                            <div>{$linha["endereco"]}</div>
                            <div>{$linha["telefone"]}</div>
                            <div class='item-acoes'>
                                <a href='cadastro-cinema.php?cinema={$linha["idCinema"]}'>
                                    <i class='item-animacao fa-solid fa-pen'></i> 
                                </a>
                                <a href='excluir-cinema.php?excluir={$linha["idCinema"]}' onclick='return confirm(\"Tem certeza que deseja excluir este cinema?\")'>
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