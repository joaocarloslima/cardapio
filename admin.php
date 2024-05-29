<?php
    require("./auth.php");

    require('./data/conexao.php');
    require('./model/Produto.php');

    $sql = "SELECT * FROM Produtos";
    $resultado = $pdo->query($sql);
    $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

    $produtos = array_map(function ($produto) {
        return new Produto(
            $produto["id"],
            $produto["nome"],
            $produto["descricao"],
            $produto["imagem"],
            $produto["preco"]
        );
    }, $dados);

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
            <li><a href="/index.php">cardápio</a></li>
            <li class="active"><a href="/admin.php">produtos</a></li>
            <li><a href="/new.php">cadastrar</a></li>
        </ul>
        <div>
            <span>
                <?= $_SESSION["usuario"] ?>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="1.5"
                stroke="currentColor" class="icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <a href="/login.php?logout=1" class="btn">
                sair
            </a>
        </div>

    </nav>

    <main>
        <h3>Lista de Produtos</h3>

        <a href="/new.php" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            cadastrar produto
        </a>

        <div class="lista">
            <?php foreach($produtos as $produto): ?>
            <div class="produto">
                <div class="data">
                    <div class="img">
                        <img src="<?= $produto->imagem ?>" alt="food">
                    </div>
                    <div class="info">
                        <h5><?= $produto->nome ?></h5>
                        <p class="price"><?= $produto->getPrecoFormatado() ?></p>
                    </div>
                </div>
                <div class="actions">
                    <form action="/excluir.php" method="post">
                        <button class="icon delete">
                            <input type="hidden" name="id" value="<?= $produto->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                    
                    <a href="/edit.php?id=<?= $produto->id ?>" class="icon edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" class="icon">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
           
        </div>


    </main>


</body>

</html>