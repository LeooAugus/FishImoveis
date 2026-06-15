<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>FishImóveis</title>
</head>

<body> <!-- Utilize Div apenas quando não existir uma tag para o que vc for fazer mn -->

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

            <div class="container-fluid">

                <a class="navbar-brand ms-4" href="index.php">
                    FishImóveis
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon">

                    </span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-4 me-4 mb-2 mb-lg-0">

                        <li class="nav-item">

                            <a class="nav-link" href="index.php">
                                Início
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Contato.html">
                                Contato
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link active" aria-current="page" href="#">
                                Financie
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Negocie.php">
                                Negocie seu imóvel
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Sobre.html">
                                Sobre
                            </a>

                        </li>

                    </ul>

                    <form class="d-flex ms-4 w-50" role="search">

                        <input class="form-control me-2" type="search" placeholder="Procure um imóvel"
                            aria-label="Search" />

                        <button class="btn btn-info w-25" type="submit">
                            Ir
                        </button>

                    </form>

                </div> <!-- Fim links navbar-->

            </div> <!-- Fim conteiner-fluid-->

        </nav>

    </header>

    <main class="contPrin"> <!-- Conteúdo principal dessa secção do site -->

        <section>
            
        </section>

        <section>
            <?php
            try {
                include 'conexao.php';

                $resultado = $conexao->query('SELECT * FROM imovel');

                while ($imovel = $resultado->fetch_assoc()):
                    $idEncoded = base64_encode($imovel['id']);
                    $imagem = !empty($imovel['foto']) ? $imovel['foto'] : 'sem_usuário.png';

                    echo <<<HTML
                    <div class="row mb-3 align-items-center">
                        <div class="col-1">
                            <p>{$imovel['id']}</p>
                        </div>
                        <div class="col-4">
                            <img src="img/{$imagem}" class="img-fluid" style="height: 280px; object-fit: contain;">
                        </div>
                        <div class="col">
                            <p>{$imovel['endereco']}</p>
                            <p>{$imovel['descricao']}</p>
                            <p>{$imovel['proprietario']}</p>
                            <p>{$imovel['dataCad']}</p>
                        </div>
                    <div class="col-2">
                    <a href="vercasa.php?id={$idEncoded}" class="btn btn-primary mb-2 w-100">Ver casa</a>
                    <a href="editar.php?id={$idEncoded}" class="btn btn-secondary mb-2 w-100">Editar</a>
                    <button 
                        class="btn btn-danger w-100" 
                        data-bs-toggle="modal" 
                        data-bs-target="#excluirModal"
                        data-id="{$idEncoded}">
                        Excluir
                    </button>
                    </div>
                    </div>
                    HTML;
                endwhile;
            } catch (mysqli_sql_exception $e) {
                echo "
                <div class='alert alert-danger container mt-3' role='alert'>
                    <h5>Erro ao carregar os imóveis:</h5>
                    <p>{$e->getMessage()}</p>
                    <a href='index.php' class='btn btn-primary'>Tentar novamente</a>
                </div>";
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