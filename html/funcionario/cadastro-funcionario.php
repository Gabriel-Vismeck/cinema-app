<?php
// Buscar o arquivo de configurações padrão
require("../../config.php");

// Se tiver editando
if (isset($_GET['funcionario'])) {
  $idFuncionario = $_GET['funcionario'];

  $sql = "SELECT * FROM funcionario WHERE idFuncionario = $idFuncionario";

  $funcionario = Buscar($sql)[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $nome = $_POST["nome"];
	$data_nascimento = $_POST["data-nascimento"];
	$cpf = $_POST["cpf"];
	$cargo = $_POST["cargo-funcionario"];
	$salario = $_POST["salario"];
	$dataAdmissao = $_POST["data-admissao"];
	$chefe = $_POST["chefe"];
	$setor = $_POST["setor"];
	$cinema = $_POST["cinema"];

  if (isset($_GET['funcionario'])) {
    $idFuncionario = $_GET['funcionario'];
    AlterarFuncionario($idFuncionario, $email, $senha, $nome, $data_nascimento, $cpf, $cargo, $salario, $dataAdmissao, $chefe, $setor, $cinema);
  }
  else {
    InserirFuncionario($email, $senha, $nome, $data_nascimento, $cpf, $cargo, $salario, $dataAdmissao, $chefe, $setor, $cinema);
  }

  // Redirecionar para a página da lista
  header("Location: /Projeto-Cinema/html/funcionario/lista-funcionarios.php");
  die();
}

function InserirFuncionario($email, $senha, $nome, $data_nascimento, $cpf, $cargo, $salario, $dataAdmissao, $chefe, $setor, $cinema) {
  $sql = "INSERT INTO funcionario (
            email,
            senha,
            nome,
            dataNascimento,
            cpf,
            cargo,
            salario,
            dataAdmissao,
            idChefe,
            idSetor,
            idCinema)
          VALUES (
            '$email',
            '$senha',
            '$nome',
            '$data_nascimento',
            '$cpf',
            '$cargo',
            $salario,
            '$dataAdmissao',
            $chefe,
            $setor,
            $cinema);";
  Inserir($sql);
}

function AlterarFuncionario($idFuncionario, $email, $senha, $nome, $data_nascimento, $cpf, $cargo, $salario, $dataAdmissao, $chefe, $setor, $cinema) {
  $sql = "UPDATE funcionario SET
            email = '$email',
            senha = '$senha',
            nome = '$nome',
            dataNascimento = '$data_nascimento',
            cpf = '$cpf',
            cargo = '$cargo',
            salario = $salario,
            dataAdmissao = '$dataAdmissao',
            idChefe = $chefe,
            idSetor = $setor,
            idCinema = $cinema
          WHERE idFuncionario = $idFuncionario;";
  Inserir($sql);
}

$funcionarios = BuscarFuncionarios();
$setores = BuscarSetores();
$cinemas = BuscarCinemas();

function BuscarFuncionarios() {
  $sql = "SELECT
              *
          FROM Funcionario;";

  $funcionarios = Buscar($sql);

  return $funcionarios;
}

function BuscarSetores() {
  $sql = "SELECT
              *
          FROM Setor;";

  $setores = Buscar($sql);

  return $setores;
}

function BuscarCinemas() {
  $sql = "SELECT
              *
          FROM Cinema;";

  $cinemas = Buscar($sql);

  return $cinemas;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg">
  <title>Cinemáximo - Cadastro Funcionário</title>

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
      <h1 class="titulo-form">Cadastro Funcionário</h1>
      <div class="campo-form">
        <input
          type="email"
          name="email"
          id="email"
          placeholder=" "
          value="<?php echo isset($funcionario) ? $funcionario['email'] : '' ?>"
          required />
        <label for="email">Email:</label>
      </div>
      <div class="campo-form">
        <input
          type="password"
          name="senha"
          id="senha"
          placeholder=" "
          minlength="8"
          value="<?php echo isset($funcionario) ? $funcionario['senha'] : '' ?>"
          required />
        <label for="senha">Senha:</label>
      </div>
      <div class="campo-form">
        <input
          type="text"
          name="nome"
          id="nome"
          placeholder=" "
          minlength="3"
          value="<?php echo isset($funcionario) ? $funcionario['nome'] : '' ?>"
          required />
        <label for="nome">Nome completo:</label>
      </div>
      <div class="campo-form">
        <input
          type="date"
          name="data-nascimento"
          id="data-nascimento"
          placeholder=" "
          maxlength="13"
          value="<?php echo isset($funcionario) ? $funcionario['dataNascimento'] : '' ?>"
          required />
        <label for="data-nascimento">Data de nascimento:</label>
      </div>
      <div class="campo-form">
        <input
          type="text"
          name="cpf"
          id="cpf"
          class="cpf"
          placeholder=" "
          value="<?php echo isset($funcionario) ? $funcionario['cpf'] : '' ?>"
          required />
        <label for="cpf">CPF:</label>
      </div>
      <div class="campo-form">
        <input
          type="text"
          name="cargo-funcionario"
          id="cargo-funcionario"
          placeholder=" "
          value="<?php echo isset($funcionario) ? $funcionario['cargo'] : '' ?>"
          required />
        <label for="cargo-funcionario">Cargo funcionário:</label>
      </div>
      <div class="campo-form">
        <input
          type="number"
          name="salario"
          id="salario"
          placeholder=" "
          maxlength="13"
          value="<?php echo isset($funcionario) ? $funcionario['salario'] : '' ?>"
          required />
        <label for="salario">Salário Funcionário:</label>
      </div>
      <div class="campo-form">
        <input
          type="date"
          name="data-admissao"
          id="data-admissao"
          placeholder=" "
          maxlength="13"
          value="<?php echo isset($funcionario) ? $funcionario['dataAdmissao'] : '' ?>"
          required />
        <label for="data-admissao">Data de admissão:</label>
      </div>
      <div class="campo-dropdown" name="chefe">
        <select name="chefe">
          <?php
            foreach ($funcionarios as $linha) {
              echo "<option value='{$linha["idFuncionario"]}' "
                      . ehSelecionado($funcionario['idFuncionario'], $linha['idFuncionario']) . 
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="chefe">Chefe:</label>
      </div>
      <div class="campo-dropdown">
        <select name="setor">
          <?php
            foreach ($setores as $linha) {
              echo "<option value='{$linha["idSetor"]}' "
                      . ehSelecionado($funcionario['idSetor'], $linha['idSetor']) . 
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="setor">Setor:</label>
      </div>
      <div class="campo-dropdown">
        <select name="cinema">
          <?php
            foreach ($cinemas as $linha) {
              echo "<option value='{$linha["idCinema"]}' "
                      . ehSelecionado($funcionario['idCinema'], $linha['idCinema']) . 
                      ">
                      {$linha["nome"]}
                    </option>";
            }
          ?>
        </select>
        <label for="cinema">Cinema:</label>
      </div>
      <button class="botao-form" type="submit">
        <?php echo isset($funcionario) ? 'Salvar' : 'Cadastrar' ?>
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