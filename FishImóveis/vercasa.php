<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Casa</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    include "conexao.php";

    if (isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))) {
        $id = base64_decode($_GET['id']);
    } else {
        header("Location: index.php");
        exit;
    }

    try {
        $sql = "SELECT * FROM imovel WHERE id = $id";
        $query = $conexao->query($sql);

        if ($query->num_rows > 0) {
            $imovel = $query->fetch_assoc();
            $foto = !empty($imovel['foto']) ? $imovel['foto'] : 'sem_usuário.png';
        } else {
            throw new Exception("Imóvel não encontrado!");
        }

    } catch (Exception $e) {
        echo "
    <div class='alert alert-danger container mt-3' role='alert'>
        <h5>Erro:</h5>
        <p>{$e->getMessage()}</p>
        <a href='index.php' class='btn btn-primary'>Voltar</a>
    </div>";
        exit;
    }
    ?>

    <main class="container mt-4">
        <div class="card">
            <img src="img/<?= $foto ?>" class="card-img-top" style="height: 400px; object-fit: contain;">
            <div class="card-body">
                <h5 class="card-title"><?= $imovel['endereco'] ?></h5>
                <p><?= $imovel['descricao'] ?></p>
                <p><strong>Proprietário:</strong> <?= $imovel['proprietario'] ?></p>
                <p><strong>Cadastrado em:</strong> <?= $imovel['dataCad'] ?></p>
                <a href="index.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>