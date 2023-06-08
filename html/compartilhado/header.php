<!--HEADER-->
<nav id="header" class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/Projeto-Cinema/index.php">
            <img src="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg" class="imagem-titulo">
            CINEMÁXIMO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <form action="/Projeto-Cinema/html/pesquisa-filmes.php" method="GET" class="d-flex" role="search">
                <button type="submit" class="btn" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input class="caixa-busca" name="busca" type="search" placeholder="Buscar..." aria-label="Search">
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php
                    if (EstaLogadoCliente()) {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link active' aria-current='page' href='/Projeto-Cinema/html/meus-ingressos.php'>MEUS INGRESSOS</a>
                            </li>";
                    }
                ?>
                <li class="nav-item">
                    <a href="/Projeto-Cinema/html/sobre.php" class="nav-link" style="color:var(--branco)">SOBRE</a>
                </li>
            </ul>
        </div>

        <?php
            if (EstaLogado()) {
                echo "  
                    <div class='navbar-brand'>
                        <a class='nav-link active' aria-current='page' href='/Projeto-Cinema/logout.php'>
                            <i class='fa-solid fa-right-from-bracket'></i>
                            LOGOUT
                        </a>
                    </div>";
            }
            else {
                echo "  
                    <div class='navbar-brand'>
                        <a class='nav-link active' aria-current='page' href='/Projeto-Cinema/html/login.php'>
                            <i class='fa-solid fa-user'></i>
                            LOGIN
                        </a>
                    </div>";
            }
        ?>
    </div>
</nav>
<!--FIM DO HEADER-->