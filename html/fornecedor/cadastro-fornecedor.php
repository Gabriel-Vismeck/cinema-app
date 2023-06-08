<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

if (isset($_GET['fornecedor'])) {
  $idFornecedor = $_GET["fornecedor"];
  
  $sql = "SELECT * FROM fornecedor WHERE idFornecedor = $idFornecedor";

  $fornecedor = Buscar($sql)[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Pegar os valores e colocar em variáveis amigaveis
	$nome = $_POST["nome"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];

  if (isset($_GET['fornecedor'])) {
    $idFornecedor = $_GET["fornecedor"];
    AlterarFornecedor($idFornecedor, $nome, $telefone, $email);
  }
  else {
    InserirFornecedor($nome, $telefone, $email);
  }
  
  // Redirecionar para a página da lista
  header("Location: /Projeto-Cinema/html/fornecedor/lista-fornecedores.php");
  die();
}

function InserirFornecedor($nome, $telefone, $email) {
  // Montar a string SQL
	$sql = "INSERT INTO Fornecedor (nome, telefone, email) VALUES ('$nome', '$telefone', '$email')";

  Inserir($sql);
}

function AlterarFornecedor($idFornecedor, $nome, $telefone, $email) {
  // Montar a string SQL
	$sql = "UPDATE Fornecedor SET
            nome = '$nome',
            telefone = '$telefone',
            email = '$email'
          WHERE idFornecedor = $idFornecedor;";

  Executar($sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
  <title>Cinemáximo - Cadastro Fornecedor</title>

  <!-- CSS -->
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/base.css">
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/header.css">
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/footer.css">
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/componentes.css">
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/formularios.css">
  <link rel="stylesheet" href="/Projeto-Cinema/css/compartilhado/barra-lateral.css">

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

    <form method="POST" action="" class="formulario fundo-cinza mx-auto my-4">
      <h1 class="titulo-form">Cadastro Fornecedor</h1>
      <div class="campo-form">
        <input
          type="text"
          name="nome"
          id="nome"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($fornecedor) ? $fornecedor['nome'] : '' ?>"
          required />
        <label for="nome">Nome:</label>
      </div>
      <div class="campo-form">
        <input
          type="text"
          name="telefone"
          id="telefone"
          class="masc-telefone"
          placeholder=" "
          value="<?php echo isset($fornecedor) ? $fornecedor['telefone'] : '' ?>"
          required />
        <label for="telefone">Telefone:</label>
      </div>
      <div class="campo-form">
        <input
          type="email"
          name="email"
          id="email"
          placeholder=" "
          value="<?php echo isset($fornecedor) ? $fornecedor['email'] : '' ?>"
          required />
        <label for="email">E-mail:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($fornecedor) ? 'Salvar' : 'Cadastrar' ?>
      </button>
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