<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

importar("/conexao.php");

// Se tiver editando
if (isset($_GET['setor'])) {
  $idSetor = $_GET['setor'];

  $sql = "SELECT * FROM setor WHERE idSetor = $idSetor";

  $setor = Buscar($sql)[0];
}

if ($_POST) {
  $nome = $_POST['nome'];
  
  if (isset($_GET['setor'])) {
    $idSetor = $_GET['setor'];  
    AlterarSetor($idSetor, $nome);
  }
  else {
    InserirSetor($nome);
  }

  header("Location: /Projeto-Cinema/html/setor/lista-setores.php");
  die();
}

function InserirSetor($nome) {
  $sql = "INSERT INTO setor (nome) VALUES ('$nome')";

  Inserir($sql);
}

function AlterarSetor($idSetor, $nome) {
  $sql = "UPDATE setor SET
            nome = '$nome'
          WHERE idSetor = $idSetor;";

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
  <title>Cinemáximo - Cadastro Setor</title>

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

    <form method="post" action="" class="formulario fundo-cinza mx-auto my-4">
      <h1 class="titulo-form">Cadastro Setor</h1>
      <div class="campo-form">
        <input
          type="text"
          name = "nome"
          id="nome"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($setor) ? $setor['nome'] : '' ?>"
          required />
        <label for="nome">Nome:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($setor) ? 'Salvar' : 'Cadastrar' ?>
      </button>
    </form>
  </div>

  <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
  ?>
</body>

</html>