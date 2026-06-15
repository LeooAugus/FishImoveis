<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo PHP PW1</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .centraliza {
            text-align: center;
        }

        .foto {
            width: 150px;
        }
    </style>
</head>

<body>
    <?php
    try {
        include "conexao.php";

        // recuperando a informação da URL
        // verifica se parâmetro está correto e dento da normalidade 
        if (isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))) {
            $id = base64_decode($_POST['id'] ?? $_GET['id']);
        } else {
            //ob_start(); // Inicia o Output Buffer
            throw new Exception("Essa casa não existe!");
            //header("Location: index.php");
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $sql = "select * from imovel where id = $id";
            $resultado = $conexao->query($sql);
            $dados = $resultado->fetch_assoc();

            $id = $dados['id'];
            $endereco = $dados['endereco'];
            $descricao = $dados['descricao'];
            $dt = new DateTime($dados['dataCad'], new DateTimeZone("America/Sao_Paulo"));
            $data = $dt->format("Y-m-d");
            $proprietario = $dados['proprietario'];
            $foto = $dados['foto'];

            if (empty($foto)) {
                $foto = "sem_usuário.png"; // só pro visual
            }

        } else {

            $id = base64_decode($_POST['id'] ?? $_GET['id']);
            $endereco = $_POST['endereco'];
            $descricao = $_POST['descricao'];
            $data = $_POST['dataCad'];
            $proprietario = $_POST['proprietario'];

            if (isset($_POST['remover_foto'])) {
                $foto = 'sem_usuário.png';

            } elseif (!empty($_FILES['foto']['name'])) {
                $nomeFoto = basename($_FILES['foto']['name']);
                $destino = "img/" . $nomeFoto;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                    $foto = $nomeFoto;
                } else {
                    throw new Exception("Erro ao salvar a imagem.");
                }

            } else {
                $foto = $_POST['foto_atual']; // mantém a foto antiga
            }

            $sql = "UPDATE imovel SET 
        proprietario='" . htmlspecialchars($proprietario) . "', 
        descricao='" . htmlspecialchars($descricao) . "', 
        dataCad='$data', 
        foto='$foto' 
        WHERE id=$id";

            $resultado = $conexao->query($sql);

            echo <<<ALERT
        <div class="alert alert-info container alert-dismissible fade show" role="alert">
            <h2>Atualizado com sucesso!</h2>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    ALERT;
        }
    } catch (Exception $e) {
        echo <<<ALERT
                <div class="alert alert-danger container alert-dismissible fade show" role="alert">
                    <h2>Aconteceu um erro:<br>
                        {$e->getMessage()}
                    </h2>\n
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <a href="index.php" class="btn btn-primary">Voltar</a>
                </div>\n
            ALERT;
    }

    ?>
    <main class="container">
        <h3>Semana 01 - Exemplo 13 - Listagem Geral de Produtos - Imagem</h3>
        <?php $id = base64_encode($id); ?>
        <form name="produto" action="editar.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">
            <b>proprietario:</b> <input type="text" name="proprietario" required="required"
                value="<?php echo $proprietario; ?>"><br><br>
            <b>endereco:</b> <input type="text" name="endereco" maxlength='80' style="width:550px"
                value="<?php echo $endereco; ?>"><br><br>
            <b>Descrição: </b><br><textarea name="descricao" rows='3' cols='100'
                style="resize: none;"><?php echo $descricao; ?></textarea><br><br>
            <b>Data: </b> <input type="date" name="dataCad" value="<?php echo $data; ?>"><br><br>
            <div class="row">
                <div class="input-group mb-3 col-6">
                    <input type="hidden" name="foto_atual" value="<?= $foto ?>">
                    <input type="file" class="form-control" id="imagem" name="foto" value="<?php echo $foto ?>"
                        accept="image/*">
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" id="removerFoto" name="remover_foto" value="1">
                    <label class="form-check-label" for="removerFoto">Remover imagem</label>
                </div>
                <b><?php echo $foto ?></b>
                <div class="row" id="box1" style>
                    <img src="img/<?php echo $foto ?>" id="preview" class="img-fluid"
                        style="width: 280px; object-fit: contain;">
                </div>
                <input type="submit" class="btn btn-secondary" value="Ok">&nbsp;&nbsp;
                <input type="reset" class="btn btn-dark" value="Limpar">&nbsp;&nbsp;
                <a href="index.php" class="btn btn-primary">Cancelar</a>
        </form>
    </main>
    <script>
        document.getElementById('imagem').addEventListener('change', function () {
            const arquivo = this.files[0]; // pega o arquivo escolhido

            if (arquivo) {
                const url = URL.createObjectURL(arquivo); // cria URL temporária
                document.getElementById('preview').src = url; // troca a imagem
            }
        });
    </script>
</body>

</html>