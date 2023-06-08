<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

$resultado = BuscarResultados();

function BuscarResultados()
{
    $entradas = BuscarEntradas();
    $resultado = array();
    foreach ($entradas as $entrada) {
        if (!isset($resultado[$entrada['idCinema']]['filmes'])) {
            $resultado[$entrada['idCinema']]['filmes'] = array();
            $resultado[$entrada['idCinema']]['soma'] = 0;
        }
        array_push($resultado[$entrada['idCinema']]['filmes'], $entrada);
        $resultado[$entrada['idCinema']]['nomeCinema'] = $entrada['nomeCinema'];
        $resultado[$entrada['idCinema']]['soma'] += $entrada['custoVenda'];
    }

    return $resultado;
}

function BuscarEntradas()
{
    $sql = "SELECT
            Cinema.idCinema,
            Cinema.nome AS 'nomeCinema',
            Filme.idFilme,
            Filme.titulo,
            Sessao.idSessao,
            Sessao.horarioInicio,
            Sala.idSala,
            Sala.nome,
            Ingresso.idIngresso,
            Ingresso.dataVenda,
            Ingresso.custoVenda
        FROM Cinema
        INNER JOIN Sala
        ON Sala.idSala = Cinema.idCinema
        INNER JOIN Sessao
        ON Sessao.idSala = Sala.idSala
        INNER JOIN Filme
        ON Filme.idFilme = Sessao.idFilme
        INNER JOIN Ingresso
        ON Ingresso.idSessao = Sessao.idSessao;";
    $entradas = Buscar($sql);
    return $entradas;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Relatório de Entrada</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/relatorio-entrada.css">

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

        <h1 class="text-center my-4" style="color: var(--branco);">Relatório de Entrada</h1>

        <a class="botao-componente" href="relatorio-saida.php">Relatório de Saída</a>

        <div class="lista fundo-cinza my-4">
            <div class="lista">

                <div class="cabecalho">
                    <div class="cabecalho-item">Filme</div>
                    <div class="cabecalho-item">Horário de Início</div>
                    <div class="cabecalho-item">Sala</div>
                    <div class="cabecalho-item">Data de Venda</div>
                    <div class="cabecalho-item">Valor da Venda</div>
                </div>

                <?php
                $totalGeral = 0;
                foreach ($resultado as $linha) {
                    echo "<div class='cinema-nome'>{$linha['nomeCinema']}</div>";

                    foreach ($linha['filmes'] as $entrada) {
                        echo "<div class='venda'>
                <div class='filme'>{$entrada['titulo']}</div>
                <div class='horario'>{$entrada['horarioInicio']}</div>
                <div class='sala'>{$entrada['nome']}</div>
                <div class='data'>{$entrada['dataVenda']}</div>
                <div class='custo'>R$ {$entrada['custoVenda']}</div>
            </div>";
                        $totalGeral += $entrada['custoVenda'];
                    }

                    echo "<div class='total-cinema'>
            <div></div>
            <div></div>
            <div></div>
            <div class='total-texto'>Total:</div>
            <div class='total-valor'>R$ {$linha['soma']}</div>
        </div>";
                }
                echo "<div class='total-geral'>
        <div></div>
        <div></div>
        <div></div>
        <div class='total-texto'>Total Geral:</div>
        <div class='total-valor'>R$ {$totalGeral}</div>
    </div>";
                ?>
            </div>
        </div>

        <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
        ?>
</body>

</html>