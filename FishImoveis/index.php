<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>FishImóveis</title>
</head>
<?php
include 'conexao.php';
?>
<body> <!-- Utilize Div apenas quando não existir uma tag para o que vc for fazer mn -->
    
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

            <div class="container-fluid">

                <a class="navbar-brand ms-4" href="Home.html">
                    FishImóveis
                </a>

                <button 
                    class="navbar-toggler" 
                    type="button" 
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" 
                    aria-label="Toggle navigation">
                    
                    <span class="navbar-toggler-icon">

                    </span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav ms-4 me-4 mb-2 mb-lg-0">
                        
                        <li class="nav-item">

                            <a class="nav-link active" 
                            aria-current="page" 
                            href="Home.html"
                            >
                                Início
                            </a>

                        </li>

                        <li class="nav-item">

                            <a 
                            class="nav-link" 
                            href="Contato.html"
                            >
                                Contato
                            </a>

                        </li>
                        
                        <li class="nav-item">

                            <a class="nav-link" 
                            href="Financie.html"
                            >
                                Financie
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" 
                            href="Negocie.html"
                            >
                                Negocie seu imóvel
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" 
                            href="Sobre.html"
                            >
                                Sobre
                            </a>

                        </li>
                    
                    </ul>
                    
                    <form class="d-flex ms-4 w-50" role="search">

                        <input 
                        class="form-control me-2" 
                        type="search" 
                        placeholder="Procure um imóvel" 
                        aria-label="Search" 
                        />

                        <button 
                        class="btn btn-info w-25" 
                        type="submit"
                        >
                            Ir
                        </button>

                    </form>

                </div> <!-- Fim links navbar-->

            </div> <!-- Fim conteiner-fluid-->

        </nav>

        <section class="banner">

            <div class="container conteudo-banner">

                <!-- Filtro -->

            </div>

        </section>

    </header>

    <main class="contPrin"> <!-- Conteúdo principal dessa secção do site -->

        <section class="container-fluid mt-2 mb-2 w-100"> <!-- Separar assuntos da tag Main com Section pfv -->
            <div class="row">
                <h2>Aquarios a venda</h2>
            </div>
            <?php
            try{

                $resultado = $conexao->query('SELECT * FROM imovel');
                while ($imovel = $resultado->fetch_assoc()): 
                echo <<<html
                    <div class="row mb-3">
                        <div class="col">
                        <p>$imovel[id]<p>
                        </div>
                        <div class="col-5">
                        <img src="img/$imovel[foto]" class="img-fluid" style="width: 280px; object-fit: contain;">
                        </div>
                        <div class="col">
                        <p>$imovel[endereco]<p>
                        </div>
                        <div class="col">
                        <p>$imovel[descricao]<p>
                        </div>
                        <div class="col">
                        <p>$imovel[proprietario]<p>
                        </div>
                        <div class="col">
                        <p>$imovel[dataCad]<p>
                        </div>
                        <div class="col">
                            <a href="vercasa.php?id={$imovel['id']}">ver casa</a>
                        </div>
                    </div>
                html;
                endwhile;
            } catch(mysqli_sql_exception $e) {
                echo "<p class='text-danger'>Erro ao carregar os imóveis.</p>";
            }
            ?>
        </section>

    </main>

    <footer> <!-- Não precisa de section aqui -->
        <!-- Não é importante ainda -->
    </footer>

    <script rel="stylesheet" src="js/bootstrap.bundle.min.js"></script>
</body>

</html>