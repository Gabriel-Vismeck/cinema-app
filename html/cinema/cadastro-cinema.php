<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

// Se tiver editando
if (isset($_GET['cinema'])) {
  // Buscar o cinema que está editando
  $idCinema = $_GET["cinema"];

  $sql = "SELECT * FROM cinema WHERE idCinema = $idCinema";

  $cinema = Buscar($sql)[0];
}

if ($_POST) {
	$nome = $_POST["nome"];
	$endereco = $_POST["endereco"];
	$telefone = $_POST["telefone"];

  if (isset($_GET['cinema'])) {
    $idCinema = $_GET["cinema"];
    AlterarCinema($idCinema, $nome, $endereco, $telefone);
  }
  else {
    InserirCinema($nome, $endereco, $telefone);
  }

  // Redirecionar para a página da lista
  header("Location: /Projeto-Cinema/html/cinema/lista-cinemas.php");
  die();
}

function InserirCinema($nome, $endereco, $telefone) {
  // Montar a string SQL
	$sql = "INSERT INTO cinema (nome, endereco, telefone) VALUES ('$nome', '$endereco', '$telefone')";

  Inserir($sql);
}

function AlterarCinema($idCinema, $nome, $endereco, $telefone) {
  // Montar a string SQL
	$sql = "UPDATE cinema SET 
            nome = '$nome',
            endereco = '$endereco',
            telefone = '$telefone'
          WHERE idCinema = $idCinema";
          
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
  <title>Cinemáximo - Cadastro Cinema</title>

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
      <h1 class="titulo-form">Cadastro Cinema</h1>
      <div class="campo-form">
        <input
          type="text"
          name="nome"
          id="nome"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($cinema) ? $cinema['nome'] : '' ?>"
          required />
        <label for="nome">Nome:</label>
      </div>
      <div class="campo-form">
        <input
          type=""
          name="endereco"
          id="endereco"
          placeholder=" "
          value="<?php echo isset($cinema) ? $cinema['endereco'] : '' ?>"
          required />
        <label for="endereco">Endereço:</label>
      </div>
      <div class="campo-form">
        <input
          type="tel"
          name="telefone"
          id="telefone"
          class="masc-telefone"
          placeholder=" "
          maxlength="13"
          value="<?php echo isset($cinema) ? $cinema['telefone'] : '' ?>"
          required />
        <label for="telefone">Telefone:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($cinema) ? 'Salvar' : 'Cadastrar' ?>
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