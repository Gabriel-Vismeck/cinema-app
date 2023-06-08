<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

if (isset($_GET['busca']) && $_GET['busca'] != "") {
    $busca = $_GET['busca'];

    $filmes = BuscarFilmes($busca);

}
else {
    header("Location: /Projeto-Cinema/index.php");
}

function BuscarFilmes($busca) {
    $sql = "SELECT
                *
            FROM Filme
            WHERE Filme.titulo LIKE '%$busca%'
            AND Filme.dataLancamento < NOW()
            AND DATE_ADD(Filme.dataLancamento, INTERVAL 3 month ) > NOW()";

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
    <title>Cinemáximo - Pesquisa de Filmes</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/pesquisa-filmes.css">

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

        <h1 class="titulo-secao">Busca por "<?php echo $busca?>"</h1>
        <div class="grid-filmes m-2">
            <?php
                foreach ($filmes as $filme) {
                    echo "
                        <a href='/Projeto-Cinema/html/sessoes.php?filme={$filme["idFilme"]}' class='card-filme m-2'>
                            <img src='{$filme["urlPoster"]}'>
                        </a>";
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