<?php 
session_start();
require_once '../backEnd/DBconnect.php';

$sql = "SELECT p.produtoId, p.produtoPrc, p.produtoName, p.produtoVendas, p.discProduto, p.produtoGen, c.categoria 
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

    <title>produtos</title>
</head>
<body>
    
<div class="header-bar"></div>  
    <header>

        <h1>Bigode<span>Shop</span></h1>
        <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>

        <nav>
            <?php if ($_SESSION['isDev'] == 1){ ?>

            <a href="../frontEnd/consulta.php">Consulta</a>
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

    <main>
    <?php if (isset($_SESSION['user_Name']) && isset($_SESSION['user_Email'])){ ?>
        <?php if ($_SESSION['isDev'] == 1){ ?>
        <?php if (isset($_GET['edit']) && isset($_GET['productId'])){ ?>
        <?php if ($_GET['edit'] == true){ ?>

            <section class="editSection">
                <a href="../frontEnd/produtos.php" class="backButtonLink">
                <div class="backButton">
                <svg class="arrowSvg" id="Camada_1" data-name="Camada 1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 1084 1920" preserveAspectRatio="xMidYMid meet"><path d="M1003.6389,908.1541,143.3872,47.9025a67.7444,67.7444,0,0,0-95.805,0l0,0a67.7443,67.7443,0,0,0,0,95.8049L863.9373,960.0627,47.5821,1776.4178a67.7444,67.7444,0,0,0,0,95.805l0,0a67.7442,67.7442,0,0,0,95.805,0l816.3552-816.3551.2576.2577,43.6389-43.6389A73.7742,73.7742,0,0,0,1003.6389,908.1541Z"/></svg>
                <div>Voltar</div>
                </div>
                </a>
                <form action="../backEnd/saveEdit.php" method="POST">
                    <h1 style="color: #272727">Atualizar produto <span>ID#<?php echo $_GET['productId']; ?></span></h1>
                    <div class="input-div">
                        <input type="text" id="inputProdName" class="inputClass" name="formProd" autocomplete="off" placeholder=" ">
                        <label for="inputProdName" class="placeholder-input">Novo Nome de usuário</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdPrice" class="inputClass" name="formProd" autocomplete="off" placeholder=" ">
                        <label for="inputProdPrice" class="placeholder-input"> Novo Preço</label>
                    </div>
                    <div class="input-div">
                        <input type="text" id="inputProdDesc" class="inputClass" name="formProd" autocomplete="off" placeholder=" ">
                        <label for="inputProdDesc" class="placeholder-input"> Novo Desconto</label>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione a nova Categoria:</h4>
                        <div class="custom-select">
                            <select class=" selectClass select01" name="selectFav01" id="selectFav01Id" title="selectFav01">
                                <option value="" selected disabled hidden>Selecione aqui</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="select-class">
                    <h4 class="h4Select">Selecione o novo Gênero:</h4>
                        <div class="custom-select">
                            <select class=" selectClass select01" name="selectFav01" id="selectFav01Id" title="selectFav01">
                                <option value="" selected disabled hidden>Selecione aqui</option>
                                <option value="2">Feminino</option>
                                <option value="1">Masculino</option>
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
        <section>
            <h1>Produtos Cadastrados</h1>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr id="first-tr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Gênero</th>
                        <th>Total de Vendas</th>
                        <th>Desconto</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $stmtTable->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['produtoId']); ?></td>
                            <td><?php echo htmlspecialchars($row['produtoName']); ?></td>
                            <td><?php echo htmlspecialchars($row['produtoPrc']); ?></td>
                            <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                            <td><?php if($row['produtoGen'] == 2){ echo "Masculino";} else if($row['produtoGen'] == 1){ echo "Feminino";} ?></td>
                            <td><?php echo htmlspecialchars($row['produtoVendas']); ?></td>
                            <td><?php echo htmlspecialchars($row['discProduto']); ?></td>
                            <td><a href="../frontEnd/produtos.php?edit=true&productId=<?php echo $row['produtoId']; ?>"><div style="height:100%; display: flex; align-items: center;">Editar</div></a></td>
                            <td><a href="../frontEnd/produtos.php?confirmExclusion=true&productId=<?php echo $row['produtoId']; ?>"><div style="height:100%; display: flex; align-items: center;">Excluir</div></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
        <?php } else { ?>
            <section style="text-align: center;">
            <h1>Você não pode acessar esta área.</h1>
            </section>
            <?php } ?>
    <?php }else{ ?>
        <section style="text-align: center;">
            <h1>Registre-se para ver os usuários cadastrados.</h1>
        </section>
    <?php } ?>
    </main>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/select.js"></script>
</body>
</html>