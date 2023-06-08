<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

$resultado = BuscarResultados();

function BuscarResultados()
{
    $saidas = BuscarSaidas();
    $resultado = array();
    foreach ($saidas as $saida) {
        if (!isset($resultado[$saida['idCinema']]['saidas'])) {
            $resultado[$saida['idCinema']]['saidas'] = array();
            $resultado[$saida['idCinema']]['soma'] = 0;
        }
        array_push($resultado[$saida['idCinema']]['saidas'], $saida);
        $resultado[$saida['idCinema']]['nomeCinema'] = $saida['nomeCinema'];
        $resultado[$saida['idCinema']]['soma'] += $saida['salario'];
    }

    return $resultado;
}

function BuscarSaidas()
{
    $sql = "SELECT
                Cinema.idCinema,
                Cinema.nome AS 'nomeCinema',
                Setor.nome AS 'nomeSetor',
                Funcionario.nome,
                Funcionario.cargo,
                Funcionario.salario
            FROM Cinema
            INNER JOIN Funcionario ON Funcionario.idCinema = Cinema.idCinema
            INNER JOIN Setor ON Setor.idSetor = Funcionario.idSetor;";
    $saidas = Buscar($sql);
    return $saidas;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Relatório de Saídas</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/listas.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/relatorio-saida.css">

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

        <h1 class="text-center my-4" style="color: var(--branco);">Relatório de Saídas</h1>

        <a class="botao-componente" href="relatorio-entrada.php">Relatório de Entrada</a>

        <div class="lista fundo-cinza my-4">
            <div class="linha linha-cabeca">
                <div>Setor</div>
                <div>Funcionário</div>
                <div>Cargo</div>
                <div>Salário</div>
            </div>
            <?php
            $totalGeral = 0;
            foreach ($resultado as $linha) {
                echo "
                    <div class='linha linha-cinema'>
                        <div>{$linha['nomeCinema']}</div>
                    </div>";

                foreach ($linha['saidas'] as $entrada) {
                    echo "
                        <div class='linha'>
                            <div>{$entrada['nomeSetor']}</div>
                            <div>{$entrada['nome']}</div>
                            <div>{$entrada['cargo']}</div>
                            <div>R$ {$entrada['salario']}</div>
                        </div>";
                    $totalGeral += $entrada['salario'];
                }

                echo "
                    <div class='linha'>
                        <div></div>
                        <div></div>
                        <div>Total:</div>
                        <div>R$ {$linha['soma']}</div>
                    </div>";
            }
            echo "
                <div class='linha'>
                    <div></div>
                    <div></div>
                    <div>Total Geral:</div>
                    <div>R$ {$totalGeral}</div>
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