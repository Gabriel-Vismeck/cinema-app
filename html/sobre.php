<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Sobre nós</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/formularios.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/sobre.css">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/708face580.js" crossorigin="anonymous"></script>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="conteudo">
        <?php
            // Colocar o header
            importar("/html/compartilhado/header.php");
        ?>
        <h1 class="titulo-sobre">SOBRE NÓS</h1>
        <div class="caixa-sobre">
            <p class="texto-sobre"> <br>O Cinemáximo chegou ao mercado com o intuito de trazer satisfação aos nossos
                clientes. Diante disso, operamos em todo o Brasil com o intuito de levar à vida de milhares de pessoas
                muito mais que uma sessão, mas contentamento. Concomitante à isso, contamos com equipes comprometidas e
                dispostas; Nossas salas de cinemas são premium e preparadas para acolher a comunidade, além de contarmos
                com parceiros com o mesmo propósito, fazer a diferença.</br>

                <br>Além disso, entendemos que o mundo do cinema é uma forma de arte que conecta pessoas e culturas
                diferentes. É por isso que buscamos diversificar ao máximo as opções de filmes em cartaz, desde grandes
                produções de Hollywood até filmes independentes e nacionais. Queremos ser um espaço inclusivo e
                democrático, onde todos possam encontrar algo que lhes interesse. Contudo, a nossa visão é ser lembrados
                pelos sorrisos que espalhamos, por meio de integridade e paixão, traremos acessibilidade e
                diversão.</br>

                <br>Por fim, estamos comprometidos em usar nossa plataforma para fazer a diferença na sociedade.
                Acreditamos que temos uma responsabilidade social e ambiental e estamos sempre buscando maneiras de
                contribuir positivamente para o mundo. Nosso objetivo é ser mais do que apenas uma empresa de
                entretenimento, queremos ser uma marca que inspira e transforma a vida das pessoas, ao mesmo tempo em
                que proporciona momentos de lazer e diversão.</br>

                <br>O nosso sustento é a qualidade, o que nos move é o futuro.</br>
            </p>
        </div>
    </div>

    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>