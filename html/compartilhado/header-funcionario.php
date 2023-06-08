<!--HEADER-->
<nav id="header" class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button onclick="alterarbarralateral()" class="btn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a class="navbar-brand d-flex align-items-center" href="/Projeto-Cinema/html/menu-funcionario.php">
            <img src="/Projeto-Cinema/img/cinema-film-svgrepo-com.svg" class="imagem-titulo">
            CINEMÁXIMO
        </a>
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