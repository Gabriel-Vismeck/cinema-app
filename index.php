<?php
// Buscar o arquivo de configurações padrão
require("config.php");

$filmesDestaque = BuscarFilmesEmDestaque();
$filmesCartaz = BuscarFilmesEmCartaz();
$filmesBreve = BuscarFilmesEmBreve();

function BuscarFilmesEmDestaque() {
    $sql = "SELECT
                Filme.*,
                COUNT(assentoingresso.posicao) AS 'numeroCompras'
            FROM Filme
            LEFT JOIN Sessao
                ON Sessao.idFilme = Filme.idFilme
            LEFT JOIN Ingresso
                ON Ingresso.idSessao = Sessao.idSessao
            LEFT JOIN AssentoIngresso
                ON AssentoIngresso.idIngresso = Ingresso.idIngresso
            WHERE Filme.dataLancamento < NOW()
            AND DATE_ADD(Filme.dataLancamento, INTERVAL 3 month ) > NOW()
            GROUP BY Filme.idFilme
            ORDER BY numeroCompras DESC, Filme.titulo
            LIMIT 8;";

    $filmes = Buscar($sql);

    return $filmes;
}

function BuscarFilmesEmCartaz() {
    $sql = "SELECT
                Filme.*,
                COUNT(assentoingresso.posicao) AS 'numeroCompras'
            FROM Filme
            LEFT JOIN Sessao
                ON Sessao.idFilme = Filme.idFilme
            LEFT JOIN Ingresso
                ON Ingresso.idSessao = Sessao.idSessao
            LEFT JOIN AssentoIngresso
                ON AssentoIngresso.idIngresso = Ingresso.idIngresso
            WHERE Filme.dataLancamento < NOW()
            AND DATE_ADD(Filme.dataLancamento, INTERVAL 3 month ) > NOW()
            GROUP BY Filme.idFilme
            ORDER BY numeroCompras DESC, Filme.titulo
            LIMIT 8, 90;";

    $filmes = Buscar($sql);

    return $filmes;
}

function BuscarFilmesEmBreve() {
    $sql = "SELECT
                Filme.*,
                COUNT(assentoingresso.posicao) AS 'numeroCompras'
            FROM Filme
            LEFT JOIN Sessao
                ON Sessao.idFilme = Filme.idFilme
            LEFT JOIN Ingresso
                ON Ingresso.idSessao = Sessao.idSessao
            LEFT JOIN AssentoIngresso
                ON AssentoIngresso.idIngresso = Ingresso.idIngresso
            WHERE Filme.dataLancamento > NOW()
            GROUP BY Filme.idFilme
            ORDER BY numeroCompras DESC, Filme.titulo;";

    $filmes = Buscar($sql);

    return $filmes;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/index.css">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/708face580.js" crossorigin="anonymous"></script>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</head>

<body>
    <div class="conteudo">
        <?php
            // Colocar o header
            importar("/html/compartilhado/header.php");
        ?>

        <div id="corpo" class="container-fluid">
            <div class="row">
                <div id="filmes-destaques" class="col-12">
                    <h1 class="titulo-secao">DESTAQUES</h1>
                    <div class="corpo-grupo-destaque">
                        <!-- Slider main container -->
                        <div class="swiper swiper-destaques">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <?php
                                    foreach ($filmesDestaque as $linha) {
                                        echo "
                                            <a href='/Projeto-Cinema/html/sessoes.php?filme={$linha["idFilme"]}' class='swiper-slide cartao-filme'>
                                                <img src='{$linha["urlPoster"]}'>
                                            </a>";
                                    }
                                ?>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev swiper-button-prev-destaques"></div>
                            <div class="swiper-button-next swiper-button-next-destaques"></div>
                            <br>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination swiper-pagination-destaques"></div>
                        </div>
                    </div>
                </div>
                <div id="filmes-cartaz" class="col-6">
                    <h1 class="titulo-secao">EM CARTAZ</h1>
                    <div id="em-cartaz">
                        <!-- Slider main container -->
                        <div class="swiper swiper-cartaz">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <?php
                                    foreach ($filmesCartaz as $linha) {
                                        echo "
                                            <a href='/Projeto-Cinema/html/sessoes.php?filme={$linha["idFilme"]}' class='swiper-slide cartao-filme'>
                                                <img src='{$linha["urlPoster"]}'>
                                            </a>";
                                        
                                    }
                                ?>
                            </div>
                            <br>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination swiper-pagination-cartaz"></div>
                        </div>
                    </div>
                </div>
                <div id="filmes-breve" class="col-6">
                    <h1 class="titulo-secao">EM BREVE</h1>
                    <!-- Slider main container -->
                    <div class="swiper swiper-breve">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                                foreach ($filmesBreve as $linha) {
                                    echo "
                                        <a href='/Projeto-Cinema/html/sessoes.php?filme={$linha["idFilme"]}' class='swiper-slide cartao-filme'>
                                            <img src='{$linha["urlPoster"]}'>
                                        </a>";
                                }
                            ?>
                        </div>
                        <br>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination swiper-pagination-breve"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>

    <!-- JS -->
    <script src="/Projeto-Cinema/js/telas/index.js"></script>
</body>

</html>