<?php 
session_start();
require_once '../backEnd/DBconnect.php';
require_once '../backEnd/categoriaQuery.php';

$sql = "SELECT p.produtoId, p.produtoPrc, p.produtoPrcFinal, p.produtoName, p.produtoVendas, p.discProduto, p.produtoGen, c.categoria 
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

        <?php if(isset($_GET['confirmExclusion']) && isset($_GET['productId'])){ ?>
        <?php if($_GET['confirmExclusion'] == true){ ?>

            <section class="boxSection exclusionBox">
                <form>
                    <h1 style="color: #272727">Excluir produto <span>ID#<?php echo $_GET['productId']; ?></span>?</h1>
                    <div class="confirmButtons">
                        <div class="button-div button-div-link">
                        <a href="../frontEnd/produtos.php">Não</a>
                        </div>
                        
                        <div class="button-div button-div-link">
                        <a href="../backEnd/exclusionProd.php?exclusion=true&productId=<?php echo $_GET['productId']; ?>" id="yesButtonLink">Sim</a>
                        </div>
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
                        <th>Preço Final</th>
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
                            <td>R$ <?php echo htmlspecialchars($row['produtoPrc']); ?></td>
                            <td>R$ <?php echo htmlspecialchars($row['produtoPrcFinal']); ?></td>
                            <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                            <td><?php if($row['produtoGen'] == 2){ echo "Masculino";} else if($row['produtoGen'] == 1){ echo "Feminino";} ?></td>
                            <td><?php echo htmlspecialchars($row['produtoVendas']); ?></td>
                            <td><?php echo htmlspecialchars($row['discProduto']); ?>%</td>
                            <td><a><div style="height:100%; display: flex; align-items: center;">Editar</div></a></td>
                            <td><a><div style="height:100%; display: flex; align-items: center;">Excluir</div></a></td>
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