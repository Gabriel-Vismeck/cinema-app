<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

// Carregar opções do formulário
$sql = "SELECT * FROM Cinema";
$cinemas = Buscar($sql);

// Se tiver editando
if (isset($_GET['sala'])) {
  $idSala = $_GET['sala'];

  $sql = "SELECT * FROM sala WHERE idSala = $idSala";

  $sala = Buscar($sql)[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nome = $_POST["nome"];
	$idCinema = $_POST["idCinema"];

  if (isset($_GET['sala'])) {
    $idSala = $_GET['sala'];
    AlterarSala($idSala, $nome, $idCinema);
	}
  else {
    InserirSala($nome, $idCinema);
  }

  header("Location: /Projeto-Cinema/html/sala/lista-salas.php");
  die();
}

function InserirSala($nome, $idCinema) {
  $sql = "INSERT INTO Sala (
            nome,
            idCinema
          ) 
          VALUES ('$nome', $idCinema);";

  Inserir($sql);
}

function AlterarSala($idSala, $nome, $idCinema) {
  $sql = "UPDATE Sala 
          SET
            nome = '$nome',
            idCinema = $idCinema
          WHERE idSala = $idSala;";

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
  <title>Cinemáximo - Cadastro Sala</title>

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
      <h1 class="titulo-form">Cadastro Sala</h1>
      <div class="campo-form">
        <input
          type="text"
          name="nome"
          id="nome"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($sala) ? $sala['nome'] : '' ?>"
          required />
        <label for="nome">Nome:</label>
      </div>
      <div class="campo-dropdown">
        <select name="idCinema">
          <?php
            foreach ($cinemas as $linha) {
              echo "<option
                      value='{$linha["idCinema"]}' "
                      . ehSelecionado($sala['idCinema'], $linha['idCinema']) . 
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="cinemas">Cinema:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($sala) ? 'Salvar' : 'Cadastrar' ?>
      </button>
    </form>
  </div>

  <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
  ?>
</body>

</html>