<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
    <title>Cinemáximo - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/formularios.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/telas/ingressos.css">
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
                    <h1 class="titulo-secao">COMPRA DE INGRESSOS</h1>
                </div>
            </div>
        </div>

        <div class="fundo-cinza my-3 p-2">
            <div class="imagem-filme p-2">
                <img src="https://www.themoviedb.org/t/p/original/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg">
            </div>
            <div class="texto-filme my-1">
                <h5>John Wick 4: Baba Yaga</h5>
            </div>
            <div class="texto-filme my-1">
                <h6>Shopping - Sala 6 | Curitiba 14:30 - 25/03/2023</h6>
            </div>

            <div id="tabela-pagamento" class="my-3">
                <table>
                    <tr>
                        <th>Plano de Compra</th>
                        <th>Quantidade de assentos</th>
                    </tr>
                    <tr>
                        <td>Inteira</td>
                        <td>
                            <select>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Meia</td>
                        <td>
                            <select>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>VIP</td>
                        <td>
                            <select>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="botao-pagamento">
                <button>Comprar</button>
            </div>


        </div>
    </div>

    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>