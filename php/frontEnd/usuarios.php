<?php
session_start();
require_once '../backEnd/selectUsers.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/consultaStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/headerStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/tableStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/boxStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/buttonStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/inputStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/footerStyle.css" media="screen" type="text/css">

    <title>Consulta</title>

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
            <div class="divider-vertical"></div> 
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

        <?php if(isset($_GET['confirmExclusion']) && isset($_GET['userId'])){ ?>
        <?php if($_GET['confirmExclusion'] == true){ ?>

            <section class="boxSection exclusionBox">
                <form>
                    <h1 style="color: #272727">Excluir Usuário <span>ID#<?php echo $_GET['userId']; ?></span>?</h1>
                    <div class="confirmButtons">
                        <div class="button-div button-div-link">
                        <a href="../frontEnd/usuarios.php">Não</a>
                        </div>
                        
                        <div class="button-div button-div-link">
                        <a href="../backEnd/exclusionUser.php?exclusion=true&userId=<?php echo $_GET['userId']; ?>" id="yesButtonLink">Sim</a>
                        </div>
                    </div>
                </form>
            </section>
            <a class="backLink" href="../frontEnd/usuarios.php"></a>
        <?php }} ?>

        <!-- TABELA DE USUARIOS CADSTRADOS 🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒🆒 -->

        <section>
            <h1>Usuários cadastrados</h1>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr id="first-tr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nível</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['userId']); ?></td>
                            <td><?php echo htmlspecialchars($row['userName']); ?></td>
                            <td><?php echo htmlspecialchars($row['userEmail']); ?></td>
                            <td><?php echo htmlspecialchars($row['dev']); ?></td>
                            <td><a href="../frontEnd/usuarios.php?edit=true&userId=<?php echo $row['userId']; ?>"><div style="height:100%; display: flex; align-items: center;">Editar</div></a></td>
                            <td><a href="../frontEnd/usuarios.php?confirmExclusion=true&userId=<?php echo $row['userId']; ?>"><div style="height:100%; display: flex; align-items: center;">Excluir</div></a></td>
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
    <footer><h1>Bigode<span>Shop</span></h1></footer>

</body>
</html>