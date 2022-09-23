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
    <link rel="stylesheet" href="../../css/lightslider.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/footerStyle.css" media="screen" type="text/css">

    <title>Home</title>
</head>
<body>
    <div class="header-max">
        <div class="header-bar"></div>  
        <header>
            <h1>Bigode<span>Shop</span></h1>
            <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>
            <nav>
            <?php if ($_SESSION['isDev'] == 1){ ?>
                <a href="../frontEnd/home.php?page=home">Home</a>
                <div class="divider-vertical"></div> 
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
                <a href="../frontEnd/home.php?page=home">Home</a>
                <div class="divider-vertical"></div> 
                <a href="../frontEnd/devs.php">Devs</a>
                <div class="divider-vertical"></div>
                <a href="../frontEnd/cadastro.php">Cadastrar-se</a>
                <div class="divider-vertical"></div>
                <a href="../frontEnd/login.php">Entrar</a>
            </nav>
            <?php } ?>
        </header>
        <div class="sub-header">

            <!-- SEARCH 🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚🈚 -->

            <div class="input-search-div">
                <form action="../backEnd/searchProd.php" id="searchForm" method="POST">
                    <input type="text" class="searchInput" name="searchInput" id="searchInput" autocomplete="off" placeholder="Buscar" value="<?php echo @$_GET['search'] ?>">
                    <label for="searchInput" id="searchIcon"><img src="../../img/buttons/searchIcon.png" width="24" height="24" class="search-icon"></label>
                </form>
            </div>



            <div class="sub-nav">
                <a href="../frontEnd/profile.php"><img src="../../img/defaultProfile" width="45"></a>
            </div>
        </div>
    </div>
    <main>

        <div class="sections-class">
            <?php if(isset($_GET['page'])){ 
                    $curPage = $_GET['page'];
                ?>
                <?php if($curPage == "home"){ ?>
                    <?php while($row = $stmtC->fetch(PDO::FETCH_ASSOC)){ ?>
                    <section class="produtoSection">
                        <h1><?php echo $row['categoria']?></h1>
                        <div class="produtosSec">

                            <ul class="cs-hidden content-slider">
                                <?php 
                                $catId = $row['categoriaId'];
                                $sql = "SELECT produtoName, produtoPrc, produtoPrcFinal, produtoImg, discProduto FROM produtos WHERE categoriaId = $catId AND produtoState = 1";
                                $stmtP = $conn->query($sql);
                                unset($sql);
                                ?>
                                <?php while($rowP = $stmtP->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <li>
                                        <a>
                                            <div class="produto-div">
                                            <?php if($rowP['discProduto'] > 0) { ?>
                                                <div class="desconto-div">
                                                    <h3>- <?php echo $rowP['discProduto'] ?>%</h3>
                                                </div>
                                            <?php } ?>
                                            <img src="<?php echo $rowP['produtoImg'] ?>">
                                            <div>
                                                <h4><?php echo $rowP['produtoName'] ?></h4>
                                            </div>
                                            <div class="prices-class">
                                                <br>
                                                <?php if($rowP['discProduto'] == 0){ ?>
                                                    <h3 class="prcFinal">R$ <?php echo $rowP['produtoPrcFinal'] ?></h3>
                                                <?php } else if($rowP['discProduto'] > 0) { ?>
                                                    <h3 class="prcUnderline">R$ <?php echo $rowP['produtoPrc'] ?></h3>
                                                    <h3 class="prcFinal">R$ <?php echo $rowP['produtoPrcFinal'] ?></h3>
                                                <?php } ?>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                    <li>
                                        <a>
                                            <div class="produto-div last-produto-div">
                                                <h3>VER COLEÇÃO COMPLETA</h3>
                                                <img src="../../img/examples/SM-Camisa_Masc_Heritage_Retro_Frente.jpg">
                                            </div>
                                        </a>
                                    </li>
                            </ul>
                            <div class="arrow goToPrevSlide" id="goToPrevSlide<?php echo $row['categoriaId'] - 1; ?>">Prev</div>
                            <div class="arrow goToNextSlide" id="goToNextSlide<?php echo $row['categoriaId'] - 1; ?>">Next</div>
                        </div>
                    </section>
                    <?php } ?>
                    <?php } else if($curPage == "search"){
                            if(isset($_GET['search'])){
                                $search = "%" . $_GET['search'] . "%";
                                $sql = "SELECT produtoName, produtoPrc, produtoPrcFinal, produtoImg, discProduto, categoriaId FROM produtos WHERE LOWER(produtoName) LIKE :search OR LOWER(produtoTags) LIKE :search AND produtoState = 1;";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':search', $search, PDO::PARAM_STR);
                                $stmt->execute();
                            } else {
                                header("Location: ../frontEnd/home.php?page=home");
                            }?>
                        
                            <?php if($stmt->rowCount() === 0){ ?>
                                <div class="search-header">
                                    <h1>NENHUM RESULTADO ENCONTRADO PARA <?php echo $_GET['search'] ?></h1>
                                </div>
                            <?php } else { ?>
                            
                                <div class="search-header">
                                    <h1>RESULTADOS ENCONTRADOS PARA <?php echo $_GET['search'] ?>:</h1>
                                </div>
                                <section class="search-result-sec">
                                    
                                    <?php while($rowP = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
    
                                        <a>
                                            <div class="produto-div">
                                            <?php if($rowP['discProduto'] > 0) { ?>
                                                <div class="desconto-div">
                                                    <h3>- <?php echo $rowP['discProduto'] ?>%</h3>
                                                </div>
                                            <?php } ?>
                                            <img src="<?php echo $rowP['produtoImg'] ?>">
                                            <div>
                                                <h4><?php echo $rowP['produtoName'] ?></h4>
                                            </div>
                                            <div class="prices-class">
                                                <br>
                                                <?php if($rowP['discProduto'] == 0){ ?>
                                                    <h3 class="prcFinal">R$ <?php echo $rowP['produtoPrcFinal'] ?></h3>
                                                <?php } else if($rowP['discProduto'] > 0) { ?>
                                                    <h3 class="prcUnderline">R$ <?php echo $rowP['produtoPrc'] ?></h3>
                                                    <h3 class="prcFinal">R$ <?php echo $rowP['produtoPrcFinal'] ?></h3>
                                                <?php } ?>
                                            </div>
                                            </div>
                                        </a>

                                    <?php } ?>
                            
                                </section>

                            <?php } ?>
                    <?php } else if($curPage == "categoria"){ ?>



                    <?php } ?>
            

            <?php } else { header("Location: ../frontEnd/home.php?page=home"); } ?>
        </div>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../js/lightslider.js"></script>
    <script src="../../js/scriptSlider.js"></script>
</body>
</html>