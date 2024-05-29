<?php 
require("./auth.php");

require('./data/conexao.php');

if (isset($_POST["update"])){
    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $_POST["id"]);
    $stmt->bindValue(":nome", $_POST["name"]);
    $stmt->bindValue(":preco", $_POST["price"]);
    $stmt->bindValue(":descricao", $_POST["description"]);
    $stmt->execute();

    header("Location: /admin.php");

}

$id = $_GET["id"];

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Epic Food</title>
</head>

<body>

    <nav>
        <h1>Epic Food</h1>
        <ul>
            <li><a href="./index.php">cardápio</a></li>
            <li><a href="admin.php">produtos</a></li>
            <li class="active"><a href="./new.php">cadastrar</a></li>
        </ul>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="1.5"
                stroke="currentColor" class="icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>

    </nav>

    <main>
        <h3>Atualizar Produto</h3>

        <form method="post">
            <input type="hidden" name="id" value="<?= $produto["id"] ?>">
            <div class="input-group">
                <label for="name">Nome</label>
                <input value="<?= $produto["nome"] ?>" type="text" name="name" id="name" placeholder="Nome do produto">
            </div>
            <div class="input-group">
                <label for="price">Preço</label>
                <input value="<?= $produto["preco"] ?>" type="text" name="price" id="price" placeholder="Preço do produto">
            </div>
            <div class="input-group">
                <label for="image">Imagem</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="input-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    placeholder="Descrição do produto"><?= $produto["descricao"] ?></textarea>
            </div>
            <div class="input-group">
                <label for="category">Categoria</label>
                <select name="category" id="category">
                    <option value="1">Lanche</option>
                    <option value="2">Massa</option>
                    <option value="3">Sobremesa</option>
                    <option value="3">Bebida</option>
                </select>
            </div>
            <div class="form-actions">
                <a href="/admin.html" class="btn default">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Cancelar
                </a>
                <button type="submit" class="btn" name="update">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Atualizar
                </button>
            </div>
        </form>


    </main>


</body>

</html>