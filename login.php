<?php

if(isset($_GET["logout"])){
    session_start();
    session_destroy();
}

if(isset($_POST["entrar"])){
    require("./data/conexao.php");

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha");

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(":email", $email);
    $stm->execute();

    $usuario = $stm->fetchObject();

    if ($usuario && password_verify($senha, $usuario->senha)){
        session_start();
        $_SESSION['usuario'] = $email;
        header("Location: /admin.php");
    }else{
        header("Location: /login.php?error=1");
    }

}

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

    <main>
        <h3>Entrar</h3>

        <form action="" method="post">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="email@servidor.com">
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha">
            </div>

            <div class="form-actions">
                <button name="entrar" type="submit" class="btn">
                    entrar
                </button>

            <span class="error">
                <?php 
                    if (isset($_GET["error"])){
                        echo "E-mail e/ou senha inválidos";
                    }
                ?>
            </span>

        </form>


</body>

</html>