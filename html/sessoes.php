<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

$idFilme = $_GET['filme'];

$filme = BuscarFilme($idFilme);

$sessoes = BuscarSessoes($idFilme);

function BuscarFilme($idFilme) {
    $sql = "SELECT
                *
            FROM Filme
            WHERE Filme.idFilme = $idFilme;";

    $filme = Buscar($sql);

    if (count($filme) == 1) {
        $filme = $filme[0];
    }
    else {
        echo "Erro ao buscar informações do filme";
    }

    return $filme;
}

function BuscarSessoes($idFilme) {
    $sql = "SELECT
                Sessao.*,
                Sala.nome AS 'nomeSala',
                Cinema.nome AS 'nomeCinema',
                137 - COUNT(AssentoIngresso.idIngresso) AS 'assentosLivres'	
            FROM Sessao
            INNER JOIN Sala
                ON Sessao.idSala = Sala.idSala
            INNER JOIN Cinema
                ON Sala.idCinema = Cinema.idCinema
            LEFT JOIN Ingresso
                ON Sessao.idSessao = Ingresso.idSessao
            LEFT JOIN AssentoIngresso
                ON Ingresso.idIngresso = AssentoIngresso.idIngresso
            WHERE Sessao.idFilme = $idFilme
            GROUP BY Sessao.idSessao
            ORDER BY Sessao.horarioInicio;";

    $sessoes = Buscar($sql);

    return $sessoes;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Escolher Sessões</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/sessoes.css">

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

        <div id="corpo" class="container-fluid">
            <div class="row fundo-cinza mx-1 my-3 p-2">
                <div class="col-3">
                    <div class="card-filme-imagem my-2">
                        <img src="<?php echo $filme['urlPoster'] ?>">
                    </div>
                </div>
                <div class="col-9 p-2 card-filme-texto">
                    <h1><?php echo $filme['titulo'] ?></h1>
                    <h5><?php echo $filme['dataLancamento'] ?></h5>
                    <h5><?php echo $filme['duracao'] ?> minutos</h5>
                    <p><?php echo $filme['sinopse'] ?></p>
                </div>
            </div>
            <div id="caixitos" class="row">
                <div class="col-12 px-3">
                    <?php
                        foreach ($sessoes as $linha) {
                            echo "
                                <a href='/Projeto-Cinema/html/assentos.php?sessao={$linha["idSessao"]}' class='fundo-cinza sessao-texto d-flex flex-row justify-content-between align-items-center py-3 px-3 my-2'>
                                    {$linha["horarioInicio"]} - {$linha["nomeCinema"]} - {$linha["nomeSala"]} - {$linha["assentosLivres"]} Assentos Livres
                                    <i class='fa-solid fa-chevron-right me-1'></i>
                                </a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>