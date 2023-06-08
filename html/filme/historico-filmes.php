<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inicio = $_POST['dataInicial'];
    $fim = $_POST['dataFinal'];
    $filmes = ProcurarFilmes($inicio, $fim);
}

function ProcurarFilmes($inicio, $fim) {
    $sql = "SELECT
                Filme.*,
                Fornecedor.nome AS 'nomeFornecedor'
            FROM Filme
            INNER JOIN Sessao
                ON Filme.idFilme = Sessao.idFilme
            INNER JOIN Fornecedor
                ON Filme.idFornecedor = Fornecedor.idFornecedor
            WHERE
                Sessao.horarioInicio >= '$inicio'
            AND
                Sessao.horarioInicio <= '$fim'
            GROUP BY Filme.idFilme
            ORDER BY Filme.titulo, Sessao.horarioInicio";
    $resultado = Buscar($sql);

    foreach ($resultado as $chave => $filme) {
        $resultado[$chave]['sessoes'] = BuscarSessoesFilme($filme['idFilme'], $inicio, $fim);
    }

    return $resultado;
}

function BuscarSessoesFilme($filme, $inicio, $fim) {
    $sql = "SELECT
                Sessao.*,
                CONCAT(Cinema.nome, ' - ', Sala.nome) AS 'local'
            FROM Sessao
            INNER JOIN Sala
                ON Sessao.idSala = Sala.idSala
            INNER JOIN Cinema
                ON Sala.idCinema = Cinema.idCinema
            WHERE
                Sessao.idFilme = $filme
            AND
                Sessao.horarioInicio >= '$inicio'
            AND
                Sessao.horarioInicio <= '$fim'
            ORDER BY Sessao.horarioInicio";
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
    <title>Cinemáximo - Histórico de Filmes</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/historico-filmes.css">
  
    <!-- JS -->
    <script src="/Projeto-Cinema/js/barra-lateral.js"></script>

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
            // Colocar a barra lateral
            importar("/html/compartilhado/barra-lateral.php");

            // Colocar o header
            importar("/html/compartilhado/header-funcionario.php");
        ?>

        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="titulo-secao">Histórico de Filmes</h1>
                    <form method="post" action="" id="caixa-busca" class="fundo-cinza my-4 p-3">
                        <div class="campo-busca">
                            <label for="dataInicial">Data e Hora Inicial:</label>
                            <input
                                type="datetime-local"
                                name="dataInicial"
                                id="dataInicial"
                                minlength="3"
                                value="<?php echo isset($filmes) ? $_POST['dataInicial'] : '' ?>"
                                required />
                        </div>
                        <div class="campo-busca">
                            <label for="dataFinal">Data e Hora Final:</label>
                            <input
                                type="datetime-local"
                                name="dataFinal"
                                id="dataFinal"
                                minlength="3"
                                value="<?php echo isset($filmes) ? $_POST['dataFinal'] : '' ?>"
                                required />
                        </div>
                        <button class="botao-busca px-5" type="submit">Buscar</button>
                    </form>
                    <?php
                    if (isset($filmes)) {
                    ?>
                    <div class="lista fundo-cinza my-4">
                        <div class="linha linha-cabeca">
                            <div>Título</div>
                            <div>Sinopse</div>
                            <div>Ano de Lançamento</div>
                            <div>Duração</div>
                            <div>Fornecedor</div>
                            <div>URL do Poster</div>
                            <div></div>
                        </div>
                        <?php
                            foreach ($filmes as $filme) {
                                echo "
                                    <div class='linha'>
                                        <div>{$filme["titulo"]}</div>
                                        <div>{$filme["sinopse"]}</div>
                                        <div>{$filme["dataLancamento"]}</div>
                                        <div>{$filme["duracao"]} minutos</div>
                                        <div>{$filme["nomeFornecedor"]}</div>
                                        <div class='item-imagem'>
                                            <img src='{$filme["urlPoster"]}'>
                                        </div>
                                        <div class='sessoes'>";

                                        foreach ($filme['sessoes'] as $sessao) {
                                            echo "
                                                <div>{$sessao["horarioInicio"]}</div>
                                                <div>{$sessao["local"]}</div>";
                                        }
                                echo "
                                        </div>
                                    </div>";
                            }
                        ?>
                    </div>
                    <?php
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