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

    <title>Error</title>
</head>
<body>

     <!-- HEADER  -->

    <div class="header-bar"></div>  
        <header>

            <h1>Bigode<span>Shop</span></h1>
            <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>

            <nav>
                <a href="../frontEnd/home.php?page=home">Home</a>
                <?php if ($_SESSION['isDev'] == 1){ ?>

                <a href="../frontEnd/usuarios.php">Usuários</a>
                <div class="divider-vertical"></div>
                <a href="../frontEnd/produtos.php">Produtos</a>
                <div class="divider-vertical"></div>

                <?php }; ?>
                <a href="../frontEnd/devs.php">Devs</a>
                <div class="divider-vertical"></div>
                <a href="../backEnd/logout.php">Sair</a>

            </nav>

            <?php } else { ?>

            <nav>
                <a href="../frontEnd/home.php?page=home">Home</a>
                <a href="../frontEnd/devs.php">Devs</a>
                <div class="divider-vertical"></div>
                <a href="../frontEnd/cadastro.php">Cadastrar-se</a>
                <div class="divider-vertical"></div>
                <a href="../frontEnd/login.php">Entrar</a>
            </nav>
            <?php } ?>
        </header>
    </div>

    <!-- MAIN -->

    <main>
        <section>
            <?php if(isset($_GET['error'])){ ?>
            <h1>ERROR <?php echo $_GET['error']; ?></h1>
            <?php } ?>
        </section>
    </main>
</body>
</html>