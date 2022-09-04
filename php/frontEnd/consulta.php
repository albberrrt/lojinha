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

    <title>Consulta</title>

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
        <section>
            <h1>Usuários cadastrados</h1>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr id="first-tr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['userId']); ?></td>
                            <td><?php echo htmlspecialchars($row['userName']); ?></td>
                            <td><?php echo htmlspecialchars($row['userEmail']); ?></td>
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

</body>
</html>