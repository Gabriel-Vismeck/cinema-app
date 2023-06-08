<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

// Carregar opções do formulário
$sql = "SELECT * FROM Filme";
$filmes = Buscar($sql);

$sql = "SELECT
            sala.idSala,
            CONCAT(cinema.nome, ' - ', sala.nome) AS 'nome'
        FROM cinema
        INNER JOIN sala
            ON sala.idCinema = cinema.idCinema;";
$salas = Buscar($sql);

// Se tiver editando
if (isset($_GET['sessao'])) {
  $idSessao = $_GET['sessao'];

  $sql = "SELECT * FROM sessao WHERE idSessao = $idSessao";

  $sessao = Buscar($sql)[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$datahora = $_POST["datahora"];
	$idFilme = $_POST["filme"];
	$idSala = $_POST["sala"];

  if (isset($_GET['sessao'])) {
    $idSessao = $_GET['sessao'];
    AlterarSessao($idSessao, $datahora, $idFilme, $idSala);
    
  }
  else {
    InserirSessao($datahora, $idFilme, $idSala);
  }

  // Redirecionar para a página da lista
  header("Location: /Projeto-Cinema/html/sessao/lista-sessoes.php");
  die();
}

function InserirSessao($datahora, $idFilme, $idSala) {
  $sql = "INSERT INTO Sessao (
            horarioInicio,
            idFilme,
            idSala
          ) 
          VALUES ('$datahora', $idFilme, $idSala);";
  Inserir($sql);
}

function AlterarSessao($idSessao, $datahora, $idFilme, $idSala) {
  $sql = "UPDATE Sessao SET
            horarioInicio = '$datahora',
            idFilme = $idFilme,
            idSala = $idSala
          WHERE idSessao = $idSessao;";
  Inserir($sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
  <title>Cinemáximo - Cadastro Sessão</title>

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
      <h1 class="titulo-form">Cadastro Sessão</h1>
      <div class="campo-form">
        <input
          type="datetime-local"
          name="datahora"
          id="datahora"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($sessao) ? $sessao['horarioInicio'] : '' ?>"
          required />
        <label for="datahora">Data e Hora:</label>
      </div>
      <div class="campo-dropdown">
        <select name="filme">
          <?php
            foreach ($filmes as $linha) {
              echo "<option value='{$linha["idFilme"]}' "
                      . ehSelecionado($sessao['idFilme'], $linha['idFilme']) . 
                      ">
                      {$linha["titulo"]}
                    </option>";
            }
          ?>
        </select>
        <label for="filme">Filme:</label>
      </div>
      <div class="campo-dropdown">
        <select name="sala">
          <?php
            foreach ($salas as $linha) {
              echo "<option value='{$linha["idSala"]}' "
                      . ehSelecionado($sessao['idSala'], $linha['idSala']) . 
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="sala">Sala:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($sessao) ? 'Salvar' : 'Cadastrar' ?>
      </button>
    </form>
  </div>

  <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
  ?>
</body>

</html>