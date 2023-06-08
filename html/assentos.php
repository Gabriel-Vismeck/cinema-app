<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

if (!EstaLogadoCliente()) {
    header("Location: /Projeto-Cinema/html/login.php");
    exit;
}

importar("/conexao.php");

$sessao = $_GET['sessao'];
$assentosOcupados = BuscarAssentos($sessao);

function BuscarAssentos($sessao) {
    $conexao = conectadb();

    $sql = "SELECT
                AssentoIngresso.posicao
            FROM Ingresso
            INNER JOIN AssentoIngresso
                ON Ingresso.idIngresso = AssentoIngresso.idIngresso
            WHERE Ingresso.idSessao = $sessao;";

    $assentosBD = $conexao->query($sql);

    // Transformar de bd para array
    $assentos = array();

    foreach ($assentosBD as $assento) {
        array_push($assentos, $assento['posicao']);
    }

    $conexao->close();

    return $assentos;
}

function RetornaOcupado($posicao) {
    // Precisa disso para acessar a variável fora da função
    global $assentosOcupados;

    if (in_array($posicao, $assentosOcupados)) {
        return "indisponivel";
    }
    else {
        return "disponivel";
    }
}

// Criar ingresso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Apenas criar se o usuário selecionou assentos
    if (isset($_POST['assentos']) && count($_POST['assentos']) > 0) {
        $assentos = $_POST['assentos'];
        $preco = $_POST['preco'];

        InsereIngresso($_POST['preco'], $sessao, $_SESSION['idCliente'], $assentos);
    }
}

function InsereIngresso($preco, $sessao, $cliente, $assentos) {
    $conexao = conectadb();

    $sql = "INSERT INTO Ingresso (
            dataVenda,
            custoVenda,
            idSessao,
            idCliente
        ) 
        VALUES (NOW(), ?, ?, ?);";

    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("iii", $preco, $sessao, $cliente);

        if ($stmt->execute()) {
            // Pegar o id do ingresso inserido
            $ingresso = $stmt->insert_id;

            // Para cada assento selecionado, adicionar ele
            foreach ($assentos as $assento) {
                InsereAssentoIngresso($ingresso, $assento);
            }

            // Ir para a tela de meus ingressos
            header("Location: /Projeto-Cinema/index.php");
            die();
        }
        else {
            // Se der erro
            echo "Erro: $stmt->error";
        }
        $stmt->close();
    }

    $conexao->close();
}

function InsereAssentoIngresso($ingresso, $assento) {
    $conexao = conectadb();

    $sql = "INSERT INTO AssentoIngresso (
            idIngresso,
            posicao
        ) 
        VALUES (?, ?);";

    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("is", $ingresso, $assento);

        if ($stmt->execute()) {
            // Se der sucesso
        }
        else {
            // Se der erro
            echo "Erro: $stmt->error";
        }
        $stmt->close();
    }

    $conexao->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Escolher assentos</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/assentos.css">

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

        <div id="container-fluid">
            <div class="row m-0">
                <div class="col-12">
                    <h1 class="titulo-secao">ESCOLHA DE ASSENTOS</h1>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-9">
                    <div class="container-fluid secao-sala fundo-cinza">
                        <div class="linha">
                            <div class="item-sala"></div>
                            <div class="item-sala">1</div>
                            <div class="item-sala">2</div>
                            <div class="item-sala">3</div>
                            <div class="item-sala">4</div>
                            <div class="item-sala">5</div>
                            <div class="item-sala">6</div>
                            <div class="item-sala">7</div>
                            <div class="item-sala">8</div>
                            <div class="item-sala">9</div>
                            <div class="item-sala">10</div>
                            <div class="item-sala">11</div>
                            <div class="item-sala">12</div>
                            <div class="item-sala">13</div>
                            <div class="item-sala">14</div>
                            <div class="item-sala">15</div>
                            <div class="item-sala">16</div>
                            <div class="item-sala">17</div>
                            <div class="item-sala">18</div>
                            <div class="item-sala">19</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1J") ?>">1J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2J") ?>">2J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3J") ?>">3J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4J") ?>">4J</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7J") ?>">7J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8J") ?>">8J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9J") ?>">9J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10J") ?>">10J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11J") ?>">11J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12J") ?>">12J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13J") ?>">13J</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16J") ?>">16J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17J") ?>">17J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18J") ?>">18J</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19J") ?>">19J</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1H") ?>">1H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2H") ?>">2H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3H") ?>">3H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4H") ?>">4H</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7H") ?>">7H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8H") ?>">8H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9H") ?>">9H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10H") ?>">10H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11H") ?>">11H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12H") ?>">12H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13H") ?>">13H</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16H") ?>">16H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17H") ?>">17H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18H") ?>">18H</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19H") ?>">19H</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1G") ?>">1G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2G") ?>">2G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3G") ?>">3G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4G") ?>">4G</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7G") ?>">7G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8G") ?>">8G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9G") ?>">9G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10G") ?>">10G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11G") ?>">11G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12G") ?>">12G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13G") ?>">13G</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16G") ?>">16G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17G") ?>">17G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18G") ?>">18G</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19G") ?>">19G</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1F") ?>">1F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2F") ?>">2F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3F") ?>">3F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4F") ?>">4F</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7F") ?>">7F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8F") ?>">8F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9F") ?>">9F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10F") ?>">10F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11F") ?>">11F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12F") ?>">12F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13F") ?>">13F</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16F") ?>">16F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17F") ?>">17F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18F") ?>">18F</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19F") ?>">19F</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1E") ?>">1E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2E") ?>">2E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3E") ?>">3E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4E") ?>">4E</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7E") ?>">7E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8E") ?>">8E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9E") ?>">9E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10E") ?>">10E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11E") ?>">11E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12E") ?>">12E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13E") ?>">13E</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16E") ?>">16E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17E") ?>">17E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18E") ?>">18E</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19E") ?>">19E</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1D") ?>">1D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2D") ?>">2D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3D") ?>">3D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4D") ?>">4D</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7D") ?>">7D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8D") ?>">8D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9D") ?>">9D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10D") ?>">10D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11D") ?>">11D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12D") ?>">12D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13D") ?>">13D</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16D") ?>">16D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17D") ?>">17D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18D") ?>">18D</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19D") ?>">19D</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1C") ?>">1C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2C") ?>">2C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3C") ?>">3C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4C") ?>">4C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("5C") ?>">5C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("6C") ?>">6C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7C") ?>">7C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8C") ?>">8C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9C") ?>">9C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10C") ?>">10C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11C") ?>">11C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12C") ?>">12C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13C") ?>">13C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("14C") ?>">14C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("15C") ?>">15C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16C") ?>">16C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17C") ?>">17C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18C") ?>">18C</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19C") ?>">19C</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("1B") ?>">1B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("2B") ?>">2B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("3B") ?>">3B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("4B") ?>">4B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("5B") ?>">5B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("6B") ?>">6B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7B") ?>">7B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8B") ?>">8B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9B") ?>">9B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10B") ?>">10B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11B") ?>">11B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12B") ?>">12B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13B") ?>">13B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("14B") ?>">14B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("15B") ?>">15B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("16B") ?>">16B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("17B") ?>">17B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("18B") ?>">18B</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("19B") ?>">19B</div>
                        </div>

                        <div class="linha">
                            <div class="item-sala">A</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala assento <?php echo RetornaOcupado("6A") ?>">6A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("7A") ?>">7A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("8A") ?>">8A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("9A") ?>">9A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("10A") ?>">10A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("11A") ?>">11A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("12A") ?>">12A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("13A") ?>">13A</div>
                            <div class="item-sala assento <?php echo RetornaOcupado("14A") ?>">14A</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                        </div>

                        <div class="linha">
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                        </div>

                        <div class="linha">
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                            <div class="item-sala tela">TELA</div>
                            <div class="item-sala"></div>
                            <div class="item-sala"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="fundo-cinza p-3">
                        <h5 class="titulo-escolhidos">
                            <i class="fa-solid fa-couch"></i>
                            Assentos Escolhidos
                        </h5>
                        <form id="assentos-escolhidos" method="POST" action="" href="#">
                            <button class="botao-comprar" type="submit">
                                COMPRAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>
</body>

<!-- JS -->
<script src="/Projeto-Cinema/js/telas/assentos.js"></script>
<!--FIM DO JS-->

</html>