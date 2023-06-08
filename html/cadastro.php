<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    $confirme_senha = $_POST["confirme-senha"];
    $termos = isset($_POST["termos"]);
  
    importar("/conexao.php");
    $conexao = conectadb();
  
    $sql = "INSERT INTO cliente (email, senha, nome, telefone, cpf, dataCadastro) VALUES (?,?,?,?,?,NOW())";
  
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("sssss", $email, $senha, $nome, $telefone, $cpf);

        if ($stmt->execute()) {
            // Se der sucesso

            // Redirecionar para a página da lista
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
    <title>Cinemáximo - Cadastro</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
    <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/formularios.css">

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

        <form method="POST" action="" class="formulario fundo-cinza mx-auto my-4">
            <h1 class="titulo-form">CADASTRE-SE</h1>
            <div class="campo-form">
                <input type="text" name="nome" id="nome" placeholder=" " minlength="3" required>
                <label for="nome">Nome completo:</< /label>
            </div>
            <div class="campo-form">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">E-mail:</label>
            </div>
            <div class="campo-form">
                <input type="tel" name="telefone" id="telefone" class="masc-telefone" placeholder=" " maxlength="13" required>
                <label for="telefone">Telefone:</label>
            </div>
            <div class="campo-form">
                <input type="text" name="cpf" id="cpf" class="cpf" placeholder=" " required>
                <label for="cpf">CPF:</label>
            </div>
            <div class="campo-form">
                <input type="password" name="senha" id="senha" placeholder=" " minlength="8" maxlength="24" required>
                <label for="senha">Senha:</label>
            </div>
            <div class="campo-form">
                <input type="password" name="confirme-senha" id="confirme-senha" placeholder=" " minlength="8" maxlength="24" required>
                <label for="confirme-senha">Confirme sua senha:</label>
            </div>
            <div class="campo-checkbox">
                <input type="checkbox" value="sim" name="termos" id="termos">
                <label for="termos">Eu li e concordo com os <a href="http://pudim.com.br/" style="color: rgb(255, 75, 75);">termos de uso.</a></label>
            </div>
            <button class="botao-form" type="submit">Criar conta!</button>
        </form>
    </div>

    <script script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/projeto-cinema/js/mascara.js"></script>

    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>

</body>

</html>