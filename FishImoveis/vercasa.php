<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .centraliza {
            text-align: center;
        }

        .foto {
            width: 200px;
        }
    </style>
</head>

<body>
    <main class="container">
        <h3>Exibição de casas</h3>
        <?php
include "conexao.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: index.php");
    exit;
}

try {
    $sql = "SELECT * FROM imovel WHERE id = $id";
    $query = $conexao->query($sql);

    if ($query->num_rows > 0) {
        $imovel = $query->fetch_assoc();
    } else {
        throw new Exception("Imóvel não encontrado!");
    }

} catch (Exception $e) {
    echo "<p class='text-danger'>{$e->getMessage()}</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $imovel['endereco'] ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<main class="container mt-4">
    <div class="card">
        <img src="img/<?= $imovel['foto'] ?>" class="card-img-top" style="height: 400px; object-fit: contain;">
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
        <?php if (!empty($codigo)): ?>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="card shadow">
                        <img src="img/<?php echo $imagem; ?>" class="img-thumbnail img-fluid" alt="<?php echo $produto; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto; ?></h5>
                            <p class="card-text"><?php echo "Código: $codigo"; ?></p>
                            <p class="card-text"><?php echo $descricao; ?></p>
                            <p class="card-text"><?php echo $data; ?></p>
                            <p class="card-text"><?php echo $valor; ?></p>
                            <a href="index.php" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>