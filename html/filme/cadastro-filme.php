<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

// Carregar opções do formulário
$sql = "SELECT * FROM Fornecedor";
$fornecedores = Buscar($sql);

// Se tiver editando
if (isset($_GET['filme'])) {
  $idFilme = $_GET['filme'];

  $sql = "SELECT * FROM filme WHERE idFilme = $idFilme";

  $filme = Buscar($sql)[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$titulo = $_POST["titulo"];
	$sinopse = $_POST["sinopse"];
	$data_lancamento = $_POST["data-lancamento"];
	$duracao = $_POST["duracao"];
	$url_poster = $_POST["url-poster"];
	$fornecedor = $_POST["fornecedor"];

  if (isset($_GET['filme'])) {
    $idFilme = $_GET['filme'];
    AlterarFilme($idFilme, $titulo, $sinopse, $data_lancamento, $duracao, $url_poster, $fornecedor);
  }
  else {
    InserirFilme($titulo, $sinopse, $data_lancamento, $duracao, $url_poster, $fornecedor);
  }
  
  // Redirecionar para a página da lista
  header("Location: /Projeto-Cinema/html/filme/lista-filmes.php");
  die();
}

function InserirFilme($titulo, $sinopse, $data_lancamento, $duracao, $url_poster, $fornecedor) {
  $sql = "INSERT INTO Filme (
    titulo,
    sinopse,
    dataLancamento,
    duracao,
    urlPoster,
    idFornecedor
  ) 
  VALUES (
    '$titulo',
    '$sinopse',
    '$data_lancamento',
    $duracao,
    '$url_poster',
    $fornecedor
  );";

  Inserir($sql);
}

function AlterarFilme($idFilme, $titulo, $sinopse, $data_lancamento, $duracao, $url_poster, $fornecedor) {
  $sql = "UPDATE Filme SET
            titulo = '$titulo',
            sinopse = '$sinopse',
            dataLancamento = '$data_lancamento',
            duracao = $duracao,
            urlPoster = '$url_poster',
            idFornecedor = $fornecedor
          WHERE idFilme = $idFilme;";
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
  <title>Cinemáximo - Cadastro Filme</title>

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
      <h1 class="titulo-form">Cadastro Filme</h1>
      <div class="campo-form">
        <input
          type="text"
          name="titulo"
          id="titulo"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($filme) ? $filme['titulo'] : '' ?>"
          required />
        <label for="titulo">Titulo:</label>
      </div>
      <div class="campo-form">
        <input
          type=""
          name="sinopse"
          id="sinopse"
          placeholder=" "
          value="<?php echo isset($filme) ? $filme['sinopse'] : '' ?>"
          required />
        <label for="sinopse">Sinopse:</label>
      </div>
      <div class="campo-form">
        <input
          type="date"
          name="data-lancamento"
          id="data-lancamento"
          placeholder=" "
          maxlength="13"
          value="<?php echo isset($filme) ? $filme['dataLancamento'] : '' ?>"
          required />
        <label for="data-lancamento">Data de lançamento:</label>
      </div>
      <div class="campo-form">
        <input
          type="number"
          name="duracao"
          id="duracao"
          placeholder=" "
          value="<?php echo isset($filme) ? $filme['duracao'] : '' ?>"
          required />
        <label for="duracao">Duração (minutos):</label>
      </div>
      <div class="campo-form">
        <input
          type="url"
          name="url-poster"
          id="url-poster"
          placeholder=" "
          value="<?php echo isset($filme) ? $filme['urlPoster'] : '' ?>"
          required />
        <label for="url-poster">URL do Poster:</label>
      </div>
      <div class="campo-dropdown">
        <select name="fornecedor">
          <?php
            foreach ($fornecedores as $linha) {
              echo "<option
                      value='{$linha["idFornecedor"]}'"
                      . ehSelecionado($filme['idFornecedor'], $linha['idFornecedor']) .
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="fornecedor">Fornecedor:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($filme) ? 'Salvar' : 'Cadastrar' ?>
      </button>
    </form>
  </div>

  <?php
    // Colocar o footer
    importar("/html/compartilhado/footer.php");
  ?>
</body>

</html>