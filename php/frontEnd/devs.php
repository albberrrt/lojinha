<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/headerStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/devsStyle.css" media="screen" type="text/css">

    <title>Devs</title>

</head>
<body>
<div class="header-bar"></div>  
    <header>
        <h1>Bigode<span>Shop</span></h1>
        <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>

        <nav>
            <a href="../frontEnd/home.php?page=home">Home</a>
            <div class="divider-vertical"></div> 
            <?php if ($_SESSION['isDev'] == 1){ ?>
            <a href="../frontEnd/usuarios.php">Usuários</a>
            <div class="divider-vertical"></div>
            <a href="../frontEnd/produtos.php">Produtos</a>
            <div class="divider-vertical"></div>

            <?php }; ?>
            <a href="../backEnd/logout.php">Sair</a>

        </nav>

        <?php } else { ?>

        <nav>
            <a href="../frontEnd/home.php">Home</a>
            <div class="divider-vertical"></div> 
            <a href="../frontEnd/cadastro.php">Cadastrar-se</a>
            <div class="divider-vertical"></div>
            <a href="../frontEnd/login.php">Entrar</a>
        </nav>
        <?php } ?>
    </header>

    <main>

    <section>
        <div class="bigode-div img-div">
            <div class="img-div-2">
            <img src="../../img/bigode.png">
            </div>
            <h1>Guilherme Dias</h1>
        </div>
        <div class="alberto-div img-div">
            <div class="img-div-2">
            <img src="../../img/alberto.png">
            </div>
            <h1>Albert Smaczylo</h1>
        </div>
    </section>

    </main>

</body>
</html>