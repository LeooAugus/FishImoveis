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

                        <li class="nav-item active">

                            <a class="nav-link active" aria-current="page" href="#">
                                Início
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Contato.html">
                                Contato
                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Financie.php">
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

        <section class="banner">
            <div class="bannerCont">
                <h2>Onde você financia o seu prórpio imóvel! <br>
                    Procure a <strong>FishImóveis</strong>
                </h2>
            </div>
        </section>

    </header>

    <main class="contPrin"> <!-- Conteúdo principal dessa secção do site -->

        <section class="container-fluid w-100"> <!-- Separar assuntos da tag Main com Section pfv -->
            <div class="d-flex justify-content-center align-items-center mt-2 mb-2">
                <h2>Aquarios a venda</h2>
            </div>
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

    <div class="modal fade" id="excluirModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="excluirLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="excluirLabel">Confirmar exclusão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este imóvel?
                </div>
                <div class="modal-footer">
                    <a id="confirmar" href="#" class="btn btn-danger">Sim, excluir</a>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>


    <script rel="stylesheet" src="js/bootstrap.bundle.min.js"></script>


    <script>
        const excluirModal = document.getElementById('excluirModal');

        excluirModal.addEventListener('show.bs.modal', function (event) {
            const botao = event.relatedTarget;
            const id = botao.getAttribute('data-id');

            document.getElementById('confirmar').href = 'excluir.php?id=' + id;
            document.getElementById('excluirLabel').textContent = 'Confirmar exclusão';
        });
    </script>
</body>

</html>