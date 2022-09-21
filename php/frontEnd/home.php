<?php
session_start(); 
require_once '../backEnd/DBconnect.php';

    $sql = "SELECT categoriaId, categoria FROM categorias";
    $stmtC = $conn->query($sql);
    unset($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/headerStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/inputStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/homeStyle.css" media="screen" type="text/css">

    <title>Home</title>
</head>
<body>
    
    <div class="header-bar"></div>  
    <header>
        <h1>Bigode<span>Shop</span></h1>
        <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>
        <nav>
        <?php if ($_SESSION['isDev'] == 1){ ?>

        <a href="../frontEnd/produtos.php">Produtos</a>
        <div class="divider-vertical"></div>
        <a href="../frontEnd/usuarios.php">Usuários</a>
        <div class="divider-vertical"></div>

        <?php }; ?>
            <a href="../frontEnd/devs.php">Devs</a>
            <div class="divider-vertical"></div>
            <a href="../backEnd/logout.php">Sair</a>
        </nav>
        <?php } else { ?>
        <nav>
            <a href="../frontEnd/devs.php">Devs</a>
            <div class="divider-vertical"></div>
            <a href="../frontEnd/cadastro.php">Cadastrar-se</a>
            <div class="divider-vertical"></div>
            <a href="../frontEnd/login.php">Entrar</a>
        </nav>
        <?php } ?>
    </header>
    <div class="sub-header">
        <div class="input-search-div">
            <form action="../backEnd/searchProd.php" id="searchForm" method="POST">
                <input type="text" class="searchInput" name="searchInput" id="searchInput" autocomplete="off" placeholder="Buscar">
                <label for="searchInput" id="searchIcon"><img src="../../img/buttons/searchIcon.png" width="24" height="24" class="search-icon"></label>
            </form>
        </div>
        <div class="sub-nav">
            <a href="../frontEnd/profile.php"><img src="../../img/defaultProfile" width="45"></a>
        </div>
    </div>
    <main>
        <?php while($row = $stmtC->fetch(PDO::FETCH_ASSOC)){ ?>
        <section class="produtoSection">
            <h1><?php echo $row['categoria']?></h1>
            <div class="produtosSec">
                <?php 
                    $catId = $row['categoriaId'];
                    $sql = "SELECT produtoName, produtoPrc, produtoPrcFinal, produtoImg, discProduto FROM produtos WHERE categoriaId = $catId AND produtoState = 1";
                    $stmtP = $conn->query($sql);
                ?>
                <?php while($rowP = $stmtP->fetch(PDO::FETCH_ASSOC)){ ?>

                    <div class="produto-div">
                        <img src=" <?php echo $rowP['produtoImg'] ?>">
                        <div></div>
                    </div>

                <?php } ?>
            </div>
        </section>
        <?php } ?>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>