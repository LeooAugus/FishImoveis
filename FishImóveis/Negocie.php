<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>FishImóveis - Cadastrar Imóvel</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">

                <a class="navbar-brand ms-4" href="index.php">FishImóveis</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-4 me-4 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Negocie seu imóvel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Sobre.html">Sobre</a>
                        </li>
                    </ul>

                    <form class="d-flex ms-4 w-50" role="search">
                        <input class="form-control me-2" type="search" placeholder="Procure um imóvel"
                            aria-label="Search" />
                        <button class="btn btn-info w-25" type="submit">Ir</button>
                    </form>
                </div>

            </div>
        </nav>
    </header>



    <main class="contNegoc">

        <section class="formulCad mt-4 mb-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    include "conexao.php";

                    $endereco = $_POST['endereco'];
                    $descricao = $_POST['descricao'];
                    $proprietario = $_POST['proprietario'];
                    $dataCad = $_POST['dataCad'];

                    if (!empty($_FILES['foto']['name'])) {
                        $nomeFoto = basename($_FILES['foto']['name']);
                        $destino = "img/" . $nomeFoto;

                        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                            throw new Exception("Erro ao salvar a imagem.");
                        }
                    } else {
                        $nomeFoto = 'sem_usuário.png';
                    }

                    $sql = "INSERT INTO imovel (endereco, descricao, proprietario, dataCad, foto) 
                VALUES (
                    '" . htmlspecialchars($endereco) . "',
                    '" . htmlspecialchars($descricao) . "',
                    '" . htmlspecialchars($proprietario) . "',
                    '$dataCad',
                    '$nomeFoto'
                )";

                    $conexao->query($sql);

                    echo <<<ALERT
            <div class="alert alert-info container alert-dismissible fade show" role="alert">
                <h2>Imóvel cadastrado com sucesso!</h2>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <a href="index.php" class="btn btn-primary">Voltar</a>
            </div>
        ALERT;

                } catch (Exception $e) {
                    echo <<<ALERT
            <div class="alert alert-danger container alert-dismissible fade show" role="alert">
                <h2>Aconteceu um erro:<br>{$e->getMessage()}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <a href="index.php" class="btn btn-primary">Voltar</a>
            </div>
        ALERT;
                }
            }
            ?>
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">
                        <h3>Cadastrar Imóvel</h3>
                    </h5>
                    <p class="card-text">
                    <form class="mt-4" name="imovel" action="Negocie.php" method="post" enctype="multipart/form-data">

                        <p>Pré-visualização:</p>
                        <div class="d-flex justify-content-center">
                            <img src="img/sem_usuário.png" id="preview" class="img-fluid img-thumbnail shadow mb-3"
                                style="width: 100%; max-width: 500px; object-fit: contain;"><br>
                        </div>

                        <b>Endereço:</b>
                        <input type="text" name="endereco" maxlength="50" class="form-control mb-3" required><br>

                        <b>Descrição:</b>
                        <textarea name="descricao" rows="3" maxlength="200" class="form-control mb-3"
                            style="resize: none;"></textarea><br>

                        <b>Proprietário:</b>
                        <input type="text" name="proprietario" maxlength="50" class="form-control mb-3" required><br>

                        <b>Data de cadastro:</b>
                        <input type="date" name="dataCad" class="form-control mb-3"><br>

                        <b>Foto:</b>
                        <input type="file" name="foto" id="imagemnova" accept="image/*" class="form-control mb-3"><br>

                        <input type="submit" class="btn btn-primary" value="Cadastrar">&nbsp;&nbsp;
                        <input type="reset" class="btn btn-danger" value="Limpar">&nbsp;&nbsp;
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>

                    </form>

                    </p>
                </div>
            </div>

        </section>

    </main>

    <footer class="bg-primary"> <!-- Não precisa de section aqui -->
            <h6 class="ms-4 me-4">
                FishMóveis  - 2026 -
            </h6>
            <h6 class="ms-4">
                Todos os direitos reservados para Leonardo e Kotaka
            </h6>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('imagemnova').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                document.getElementById('preview').src = url;
            }
        });
    </script>

</body>

</html>