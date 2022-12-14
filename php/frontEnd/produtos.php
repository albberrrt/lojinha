<?php 
session_start();
require_once '../backEnd/DBconnect.php';
require_once '../backEnd/categoriaQuery.php';

$sql = "SELECT p.produtoId, p.produtoPrc, p.produtoPrcFinal, p.produtoName, p.produtoVendas, p.produtoAmount, p.discProduto, p.produtoGen, p.produtoState, p.produtoTags, p.categoriaId, c.categoria 
FROM produtos p INNER JOIN categorias c 
ON p.categoriaId = c.categoriaId";
$stmtTable = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/produtosStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/headerStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/tableStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/inputStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/selectStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/buttonStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/inputFileStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/errorAlertStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/boxStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/footerStyle.css" media="screen" type="text/css">

    <title>produtos</title>
</head>

<?php if(isset($_GET['edit']) || isset($_GET['cadProd']) || isset($_GET['confirmExclusion'])){ ?>
<body style="overflow-y: hidden;">
<?php } else { ?>
<body>
<?php } ?>
    <!-- HEADER  -->

    <div class="header-max">
        <div class="header-bar"></div>  
            <header>

                <h1>Bigode<span>Shop</span></h1>
                <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>

                <nav>
                    <a href="../frontEnd/home.php?page=home">Home</a>
                    <div class="divider-vertical"></div> 
                    <?php if ($_SESSION['isDev'] == 1){ ?>

                    <a href="../frontEnd/usuarios.php">Usu??rios</a>
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
    </div>

        <!-- MAIN -->

    <main>

        <!-- JANELINHAS  -->

    <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>
        <?php if ($_SESSION['isDev'] == 1){ ?>

        <!-- Alterar PRODUTO EXISTENTE ????????????????????????????????????????????? -->

        <?php if (isset($_GET['edit']) && isset($_GET['productId'])){ ?>
        <?php if ($_GET['edit'] == true){ ?>

            <section class="boxSection">
                <a href="../frontEnd/produtos.php" class="backButtonLink">
                <div class="backButton">
                <svg class="arrowSvg" id="Camada_1" data-name="Camada 1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 1084 1920" preserveAspectRatio="xMidYMid meet"><path d="M1003.6389,908.1541,143.3872,47.9025a67.7444,67.7444,0,0,0-95.805,0l0,0a67.7443,67.7443,0,0,0,0,95.8049L863.9373,960.0627,47.5821,1776.4178a67.7444,67.7444,0,0,0,0,95.805l0,0a67.7442,67.7442,0,0,0,95.805,0l816.3552-816.3551.2576.2577,43.6389-43.6389A73.7742,73.7742,0,0,0,1003.6389,908.1541Z"/></svg>
                <div>Voltar</div>
                </div>
                </a>
                <form action="../backEnd/saveEdit.php?productId=<?php echo $_GET['productId']; ?>" method="POST" enctype="multipart/form-data">
                    <h1 style="color: #272727">Alterar produto <span>ID#<?php echo $_GET['productId']; ?></span></h1>
                    <div class="input-div">
                        <input type="text" id="inputProdName" class="inputClass" name="inputProdName" autocomplete="off" placeholder=" " value="<?php echo @$_GET['productName'] ?>">
                        <label for="inputProdName" class="placeholder-input">Novo Nome do Produto</label>
                    </div>
                    <div class="input-div">
                        <input type="number" id="inputProdPrice" class="inputClass" name="inputProdPrice" autocomplete="off" placeholder=" " step=".01" value="<?php echo @$_GET['productPrc'] ?>">
                        <label for="inputProdPrice" class="placeholder-input"> Novo Pre??o</label>
                    </div>
                    <div class="input-div">
                        <input type="number" id="inputProdDesc" class="inputClass" name="inputProdDesc" autocomplete="off" placeholder=" " value="<?php echo @$_GET['productDisc'] ?>">
                        <label for="inputProdDesc" class="placeholder-input"> Novo Desconto</label>
                    </div>
                    <div class="input-div">
                        <input type="number" id="inputProdAmount" class="inputClass" name="inputProdAmount" autocomplete="off" placeholder=" " value="<?php echo @$_GET['productAmount'] ?>">
                        <label for="inputProdAmount" class="placeholder-input"> Novo Estoque</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdTags" class="inputClass" name="inputProdTags" autocomplete="off" placeholder=" " value="<?php echo @$_GET['productTags'] ?>">
                        <label for="inputProdTags" class="placeholder-input"> Novas Tags</label>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione a nova Categoria:</h4>
                        <div class="custom-select custom-selectedF">
                            <select class=" selectClass select01" name="selectCategoria" id="selectCategoriaId" title="selectCategoria">
                                <option value="" selected disabled hidden><?php echo $_GET['productCat'] ?></option>
                                <?php foreach($categoria as $key => $value){ ?>
                                    <option for="selectCategoria" value="<?php echo $value['categoriaId']; ?>"><?php echo @$value['categoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-file-class" id="input-file-div">
                    <h4 class="h4Select">Selecione a Nova Imagem do produto: (Deixe em branco para n??o alterar)</h4>
                    <div class="input-file-div">
                        <input type="file" id="inputProdImg" class="inputClass-file" name="inputProdImg" autocomplete="off">
                    </div>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione o novo G??nero:</h4>
                        <div class="custom-select custom-selectedF">
                            <select class=" selectClass select01" name="selectGenre" id="selectGenreId" title="selectGenre">
                                <option value="" selected disabled hidden><?php if($_GET['productGenre'] == 2){ echo "Masculino";} else if($_GET['productGenre'] == 1){ echo "Feminino";} ?></option>
                                <option value="1">Feminino</option>
                                <option value="2">Masculino</option>
                            </select>
                        </div>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione o novo Estado do produto:</h4>
                        <div class="custom-select custom-selectedF">
                            <select class=" selectClass select01" name="selectState" id="selectStateId" title="selectGenre">
                                <option value="" selected disabled hidden><?php if($_GET['productState'] == 1){ echo "Ativado";} else if($_GET['productState'] == 0){ echo "Desativado";} ?></option>
                                <option value="1">Ativado</option>
                                <option value="0">Desativado</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-div">
                    <button type="submit">Atualizar</button>
                    </div>
                </form>
                
            </section>
            <a class="backLink" href="../frontEnd/produtos.php"></a>
        <?php }} ?>

        <!-- CADASTRAR NOVO PRODUTO ???????????????????????????????????????????????????????????? -->

        <?php if(isset($_GET['cadProd'])){ ?>
        <?php if($_GET['cadProd'] == true){ ?>
            <section class="boxSection">
                <a href="../frontEnd/produtos.php" class="backButtonLink">
                <div class="backButton">
                <svg class="arrowSvg" id="Camada_1" data-name="Camada 1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 1084 1920" preserveAspectRatio="xMidYMid meet"><path d="M1003.6389,908.1541,143.3872,47.9025a67.7444,67.7444,0,0,0-95.805,0l0,0a67.7443,67.7443,0,0,0,0,95.8049L863.9373,960.0627,47.5821,1776.4178a67.7444,67.7444,0,0,0,0,95.805l0,0a67.7442,67.7442,0,0,0,95.805,0l816.3552-816.3551.2576.2577,43.6389-43.6389A73.7742,73.7742,0,0,0,1003.6389,908.1541Z"/></svg>
                <div>Voltar</div>
                </div>
                </a>
                <form action="../backEnd/cadastroProd.php" method="POST" enctype="multipart/form-data">
                <h1 style="color: #272727">Adicionar novo produto</span></h1>
                    <div class="input-div">
                        <input type="text" id="inputProdName" class="inputClass" name="inputProdName" autocomplete="off" placeholder=" ">
                        <label for="inputProdName" class="placeholder-input">Nome do produto</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdPrice" class="inputClass" name="inputProdPrice" autocomplete="off" placeholder=" ">
                        <label for="inputProdPrice" class="placeholder-input"> Pre??o</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdDesc" class="inputClass" name="inputProdDesc" autocomplete="off" placeholder=" ">
                        <label for="inputProdDesc" class="placeholder-input"> Desconto</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdAmount" class="inputClass" name="inputProdAmount" autocomplete="off" placeholder=" ">
                        <label for="inputProdAmount" class="placeholder-input"> Estoque</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdTags" class="inputClass" name="inputProdTags" autocomplete="off" placeholder=" ">
                        <label for="inputProdTags" class="placeholder-input"> Novas Tags</label>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione a Categoria do produto:</h4>
                        <div class="custom-select">
                            <select class=" selectClass select01" name="selectCategoria" id="selectCategoriaId" title="selectCategoria">
                                <option value="" selected disabled hidden>Selecione aqui</option>
                                <?php foreach($categoria as $key => $value){ ?>
                                    <option for="selectCategoria" value="<?php echo $value['categoriaId']; ?>"><?php echo $value['categoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-file-class" id="input-file-div">
                    <h4 class="h4Select">Selecione a Imagem do produto: </h4>
                    <div class="input-file-div">
                        <input type="file" id="inputProdImg" class="inputClass-file" name="inputProdImg" autocomplete="off">
                    </div>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione o G??nero do produto:</h4>
                        <div class="custom-select">
                            <select class=" selectClass select01" name="selectGenre" id="selectGenreId" title="selectGenre" >
                                <option value="" selected disabled hidden>Selecione aqui</option>
                                <option value="1">Feminino</option>
                                <option value="2">Masculino</option>
                            </select>
                        </div>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione o novo Estado do produto:</h4>
                        <div class="custom-select">
                            <select class=" selectClass select01" name="selectState" id="selectStateId" title="selectGenre">
                                <option value="" selected disabled hidden>Selecione aqui</option>
                                <option value="1">Ativado</option>
                                <option value="0">Desativado</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-div">
                    <button type="submit">Adicionar</button>
                    </div>
                </form>
                
            </section>
            <a class="backLink" href="../frontEnd/produtos.php"></a>
        <?php }} ?>
        
        <!-- ERROR ???????????????????????????????????????????????????????????? -->

        <?php if(isset($_GET['error'])){ ?>

            <section class="errorSection" id="errorSecId">
                <form>
                <?php if($_GET['error'] == 101){ ?>
                    <div class="errorAlert" id="errorDiv">
                        <h1><span>Arquivo inv??lido:</span> Selecione uma Imagem v??lida</h1>
                        <img src="../../img/buttons/blackXButton.png" width="18" id="closeAlertButton">
                    </div>
                <?php } ?>

                <?php if($_GET['error'] == 103){ ?>
                    <div class="errorAlert" id="errorDiv">
                        <h1><span>Arquivo inv??lido:</span> Selecione uma Imagem v??lida</h1>
                        <img src="../../img/buttons/blackXButton.png" width="18" id="closeAlertButton">
                    </div>
                <?php } ?>
            
                <?php if($_GET['error'] == 202){ ?>
                    <div class="errorAlert" id="errorDiv">
                        <h1><span>Formul??rio Inv??lido: </span>Preencha o formul??rio corretamente</h1>
                        <img src="../../img/buttons/blackXButton.png" width="18" id="closeAlertButton">
                    </div>
                <?php } ?>
                </form>
            </section>

        <?php } ?>

        <!-- CONFIRMAR EXCLUS??O ????????????????????????????????????????????? -->

        <?php if(isset($_GET['confirmExclusion']) && isset($_GET['productId'])){ ?>
        <?php if($_GET['confirmExclusion'] == true){ ?>

            <section class="boxSection exclusionBox">
                <form>
                    <h1 style="color: #272727">Excluir produto <span>ID#<?php echo $_GET['productId']; ?></span>?</h1>
                    <div class="confirmButtons">
                        <div class="button-div button-div-link">
                        <a href="../frontEnd/produtos.php">N??o</a>
                        </div>
                        
                        <div class="button-div button-div-link">
                        <a href="../backEnd/exclusionProd.php?exclusion=true&productId=<?php echo $_GET['productId']; ?>" id="yesButtonLink">Sim</a>
                        </div>
                    </div>
                </form>
            </section>
            <a class="backLink" href="../frontEnd/produtos.php"></a>
        <?php }} ?>

        <!-- TABELA DE PRODUTOS CADSTRADOS ???????????????????????????????????????????????????????????? -->

        <section>
            <h1>Produtos Cadastrados</h1>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr id="first-tr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Pre??o</th>
                        <th>Pre??o Final</th>
                        <th>Desconto</th>
                        <th>Categoria</th>
                        <th>G??nero</th>
                        <th>Estoque</th>
                        <th>Vendas</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $stmtTable->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="tdProdId"><?php echo htmlspecialchars($row['produtoId']); ?></td>
                            <td><?php echo htmlspecialchars($row['produtoName']); ?></td>
                            <td>R$ <?php echo htmlspecialchars($row['produtoPrc']); ?></td>
                            <td>R$ <?php echo htmlspecialchars($row['produtoPrcFinal']); ?></td>
                            <td><?php echo htmlspecialchars($row['discProduto']); ?>%</td>
                            <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                            <td><?php if($row['produtoGen'] == 2){ echo "Masculino";} else if($row['produtoGen'] == 1){ echo "Feminino";} ?></td>
                            <td><?php echo htmlspecialchars($row['produtoAmount']); ?></td>
                            <td><?php echo htmlspecialchars($row['produtoVendas']); ?></td>
                            <td><?php if($row['produtoState'] == 1){ echo "Ativado";} else if($row['produtoState'] == 0){ echo "Desativado";} ?></td>
                            <td><a href="../frontEnd/produtos.php?edit=true&productId=<?php echo $row['produtoId']; ?>&productName=<?php echo $row['produtoName'] ?>&productPrc=<?php echo $row['produtoPrc'] ?>&productDisc=<?php echo $row['discProduto'] ?>&productGenre=<?php echo $row['produtoGen'] ?>&productCat=<?php echo $row['categoria'] ?>&productCatId=<?php echo $row['categoriaId'] ?>&productAmount=<?php echo $row['produtoAmount'] ?>&productTags=<?php echo $row['produtoTags'] ?>&productState=<?php echo $row['produtoState'] ?>"><div>Editar</div></a></td>
                            <td><a href="../frontEnd/produtos.php?confirmExclusion=true&productId=<?php echo $row['produtoId']; ?>"><div>Excluir</div></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="new-data">
                <a href="../frontEnd/produtos?cadProd=true">
                    <h3>Novo produto...</h3>
                </a>
            </div>
        </section>
        <?php } else { ?>
            <section style="text-align: center;">
            <h1>Voc?? n??o pode acessar esta ??rea.</h1>
            </section>
            <?php } ?>
    <?php }else{ ?>
        <section style="text-align: center;">
            <h1>Registre-se para ver os produtos cadastrados.</h1>
        </section>
    <?php } ?>
    </main>
    <footer><h1>Bigode<span>Shop</span></h1></footer>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/select.js"></script>
<script type="text/javascript" src="../../js/file-input.js"></script>
<script type="text/javascript" src="../../js/errorAlert.js"></script>
</body>
</html>