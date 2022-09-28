<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/inputStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/buttonStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/formStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/errorAlertStyle.css" media="screen" type="text/css">

    <title>Entrar</title>
</head>
<body>
    <header>
        <a href="../frontEnd/consulta.php"><h1>Bigode<span>Shop</span></h1></a>
        <h2>SUA CONTA PARA O ESTILO BIGODE</h2>
    </header>
    <main>

        <section>
            <form action="../backEnd/saveLogin.php" method="POST">
                <div class="input-div">
                    <input type="text" id="inputName" class="inputClass" name="formUser" autocomplete="off" placeholder=" " value="<?php if(isset($_GET['error']) === "Incorrect_data"){ echo $_GET['email']; }?>">
                    <label for="inputName" class="placeholder-input">Email ou nome de usuário</label>
                </div>
                <div class="input-div">
                    <input type="password" id="inputPass" class="inputClass" name="formPass" autocomplete="off" placeholder=" ">
                    <label for="inputPass" class="placeholder-input">Senha</label>
                </div>
                <div class="info-div">
                    <h5 class="info">Ao fazer login, você concorda com a <span>Política de privacidade</span> e com os <span>Termos de uso</span> do BigodeShop.com.br.</h5>
                </div>
                <div class="button-div">
                    <button type="submit">Entrar</button>
                </div>
                <div class="link-div">
                    <span>Não está registrado? <a href="../frontEnd/cadastro.php">Junte-se a nós</a></span>
                </div>
            </form>
        </section>

        <?php if(isset($_GET['error'])){ ?>

            <section class="errorSection" id="errorSecId">
                <form>
                <?php if($_GET['error'] == "Incorrect_data"){ ?>
                    <div class="errorAlert" id="errorDiv">
                        <h1><span>Usuário ou senha inválido:</span> Digite uma conta válida</h1>
                        <img src="../../img/buttons/blackXButton.png" width="18" id="closeAlertButton">
                    </div>
                <?php } ?>
                <?php if($_GET['error'] == "101"){ ?>
                    <div class="errorAlert" id="errorDiv">
                        <h1><span>Usuário ou senha inválido:</span> Informe todos os campos</h1>
                        <img src="../../img/buttons/blackXButton.png" width="18" id="closeAlertButton">
                    </div>
                <?php } ?>
                </form>
            </section>

        <?php } ?>

    </main>
    <footer>

    </footer>



    <script type="text/javascript" src="../../js/errorAlert.js"></script>
</body>
</html>