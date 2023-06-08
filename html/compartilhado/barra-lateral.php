<!--BARRA LATERAL-->
<div id="barra-lateral" class="fechado bg-dar">
    <button onclick="alterarbarralateral()" class="botao-fechar">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#fornecedor-colapso" aria-expanded="false">
            <i class="fa-solid fa-truck"></i>
            <span>Fornecedores</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="fornecedor-colapso">
            <li><a href="/Projeto-Cinema/html/fornecedor/cadastro-fornecedor.php">Cadastro de Fornecedor</a></li>
            <li><a href="/Projeto-Cinema/html/fornecedor/lista-fornecedores.php">Lista de Fornecedores</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#filme-colapso" aria-expanded="false">
            <i class="fa-solid fa-film"></i>
            <span>Filmes</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="filme-colapso">
            <li><a href="/Projeto-Cinema/html/filme/cadastro-filme.php">Cadastro de Filme</a></li>
            <li><a href="/Projeto-Cinema/html/filme/lista-filmes.php">Lista de Filmes</a></li>
            <li><a href="/Projeto-Cinema/html/filme/historico-filmes.php">Histórico de Filmes</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#cinema-colapso" aria-expanded="false">
            <i class="fa-solid fa-location-dot"></i>
            <span>Cinemas</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="cinema-colapso">
            <li><a href="/Projeto-Cinema/html/cinema/cadastro-cinema.php">Cadastro de Cinema</a></li>
            <li><a href="/Projeto-Cinema/html/cinema/lista-cinemas.php">Lista de Cinemas</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#sala-colapso" aria-expanded="false">
            <i class="fa-solid fa-door-closed"></i>
            <span>Salas</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="sala-colapso">
            <li><a href="/Projeto-Cinema/html/sala/cadastro-sala.php">Cadastro de Sala</a></li>
            <li><a href="/Projeto-Cinema/html/sala/lista-salas.php">Lista de Salas</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#sessao-colapso" aria-expanded="false">
            <i class="fa-solid fa-clock"></i>
            <span>Sessões</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="sessao-colapso">
            <li><a href="/Projeto-Cinema/html/sessao/cadastro-sessao.php">Cadastro de Sessão</a></li>
            <li><a href="/Projeto-Cinema/html/sessao/lista-sessoes.php">Lista de Sessões</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#usuario-colapso" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
            <span>Clientes</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="usuario-colapso">
            <li><a href="/Projeto-Cinema/html/cliente/lista-clientes.php">Lista de Clientes</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#funcionario-colapso" aria-expanded="false">
            <i class="fa-solid fa-user-tie"></i>
            <span>Funcionários</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="funcionario-colapso">
            <li><a href="/Projeto-Cinema/html/funcionario/cadastro-funcionario.php">Cadastro de Funcionário</a></li>
            <li><a href="/Projeto-Cinema/html/funcionario/lista-funcionarios.php">Lista de Funcionários</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#setor-colapso" aria-expanded="false">
            <i class="fa-solid fa-users"></i>
            <span>Setores</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="setor-colapso">
            <li><a href="/Projeto-Cinema/html/setor/cadastro-setor.php">Cadastro de Setor</a></li>
            <li><a href="/Projeto-Cinema/html/setor/lista-setores.php">Lista de Setores</a></li>
        </ul>
    </div>
    <div>
        <button data-bs-toggle="collapse" data-bs-target="#relatorio-colapso" aria-expanded="false">
            <i class="fa-solid fa-chart-line"></i>
            <span>Relatórios</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <ul class="collapse" id="relatorio-colapso">
            <li><a href="/Projeto-Cinema/html/relatorio/relatorio-saida.php">Relatório de Saídas</a></li>
            <li><a href="/Projeto-Cinema/html/relatorio/relatorio-entrada.php">Relatório de Entradas</a></li>
        </ul>
    </div>
</div>
<!--FIM DA BARRA LATERAL-->