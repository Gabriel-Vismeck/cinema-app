<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

$idCliente = $_SESSION['idCliente'];

$ingressos = BuscarIngressos($idCliente);

function BuscarIngressos($idCliente) {
    $sql = "SELECT
                Ingresso.idIngresso,
                Filme.urlPoster,
                Filme.titulo,
                Cinema.nome AS 'nomeCinema',
                Sala.nome AS 'nomeSala',
                Sessao.horarioInicio,
                Ingresso.dataVenda,
                Ingresso.custoVenda
            FROM Ingresso
            INNER JOIN Sessao
                ON Ingresso.idSessao = Sessao.idSessao
            INNER JOIN Sala
                ON Sessao.idSala = Sala.idSala
            INNER JOIN Cinema
                ON Sala.idCinema = Cinema.idCinema
            INNER JOIN Filme
                ON Sessao.idFilme = Filme.idFilme
            WHERE Ingresso.idCliente = $idCliente;";

    $ingressos = Buscar($sql);

    foreach ($ingressos as $chave => $ingresso) {
        $ingressos[$chave]['assentos'] = BuscarAssentosIngresso($ingresso['idIngresso']);
    }

    return $ingressos;
}

function BuscarAssentosIngresso($idIngresso) {
    $sql = "SELECT
                *
            FROM AssentoIngresso
            WHERE AssentoIngresso.idIngresso = $idIngresso";

    $resultado = Buscar($sql);

    return $resultado;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Meus Ingressos</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/meus-ingressos.css">

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

        <div id="corpo" class="container-fluid p-5">
            <?php
                foreach ($ingressos as $ingresso) {
                    echo "
                        <div class='row fundo-cinza mx-1 my-3 p-2'>
                            <div class='col-2'>
                                <div class='card-filme-imagem my-2'>
                                    <img src='{$ingresso['urlPoster']}'>
                                </div>
                            </div>
                            <div class='col-10 p-2 card-filme-texto'>
                                <h1>{$ingresso['titulo']}</h1>
                                <h4>Cinema: {$ingresso['nomeCinema']}</h4>
                                <h4>Sala: {$ingresso['nomeSala']}</h4>
                                <h4>Seção: {$ingresso['horarioInicio']}</h4>
                                <h5>Data da Venda: {$ingresso['dataVenda']}</h4>
                                <h5>Custo Total: {$ingresso['custoVenda']}</h4>
                                <h5>Assentos:</h4>
                                <ul>";
                                foreach ($ingresso['assentos'] as $assento) {
                                    echo "<li>{$assento['posicao']}</li>";
                                }
                    echo "
                                </ul>
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