<?php
// Buscar o arquivo de configurações padrão
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    importar("/conexao.php");

    $clientes = BuscarCliente($email, $senha);
    // Se achar um cliente com o email e senha
    if ($clientes->num_rows == 1) {
        $cliente = $clientes->fetch_assoc();
        $_SESSION = $cliente;
        $_SESSION['tipoUsuario'] = "Cliente";
        header("Location: /Projeto-Cinema/index.php");
        die();
    }
    // Se NÃO achar um cliente com o email e senha
    else {
        $funcionarios = BuscarFuncionario($email, $senha);
        // Se achar um funcionário com o email e senha
        if ($funcionarios->num_rows == 1) {
            $funcionario = $funcionarios->fetch_assoc();
            $_SESSION = $funcionario;
            $_SESSION['tipoUsuario'] = "Funcionario";
            header("Location: /Projeto-Cinema/html/sessao/lista-sessoes.php");
            die();
        }
        // Se NÃO achar um cliente ou funcionário com o email e senha
        else {
            echo "Usuário Não Encontrado";
        }
    }
}

function BuscarCliente($email, $senha) {
    $conexao = conectadb();

    $sql = "SELECT * FROM Cliente WHERE email = '$email' AND senha = '$senha'";

    $cliente = $conexao->query($sql);

    $conexao->close();

    return $cliente;
}

function BuscarFuncionario($email, $senha) {
    $conexao = conectadb();

    $sql = "SELECT * FROM Funcionario WHERE email = '$email' AND senha = '$senha'";

    $funcionario = $conexao->query($sql);

    $conexao->close();

    return $funcionario;
}
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
            <h1 class="titulo-form">LOGIN</h1>
            <div class="campo-form">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">E-mail:</label>
            </div>
            <div class="campo-form">
                <input type="password" name="senha" id="senha" placeholder=" " minlength="8" maxlength="24" required>
                <label for="senha">Senha:</label>
            </div>
            <button class="botao-form" type="submit">Entrar</button>
            <div class="texto">
                Ainda não possui cadastro? <a href="/Projeto-Cinema/html/cadastro.php">Clique aqui.</a>
            </div>
        </form>
    </div>

    <?php
        // Colocar o footer
        importar("/html/compartilhado/footer.php");
    ?>
</body>

</html>