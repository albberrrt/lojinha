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

    <title>Cadastro</title>
</head>
<body>
    <header>
        <a href="../frontEnd/consulta.php"><h1>Bigode<span>Shop</span></h1></a>
        <h2>SUA CONTA PARA O ESTILO BIGODE</h2>
    </header>
    <main>
        <section>
            <form action="../backEnd/saveCadastro.php" method="POST">
                <div class="input-div">
                    <input type="text" id="inputName" class="inputLogin" name="formUser" autocomplete="off" placeholder=" ">
                    <label for="inputName" class="placeholder-input">Email ou nome de usuário</label>
                </div>
                <div class="input-div">
                    <input type="email" id="inputEmail" class="inputLogin" name="formEmail" autocomplete="off" placeholder=" ">
                    <label for="inputEmail" class="placeholder-input">Email</label>
                </div>
                <div class="input-div">
                    <input type="password" id="inputPass" class="inputLogin" name="formPass" autocomplete="off" placeholder=" ">
                    <label for="inputPass" class="placeholder-input">Senha</label>
                </div>
                <div class="info-div">
                    <h5 class="info">Ao criar uma conta, você concorda com a <span>Política de privacidade</span> e com os <span>Termos de uso</span> do BigodeShop.com.br.</h5>
                </div>
                <div class="button-div">
                    <button type="submit">Cadastrar-se</button>
                </div>
                <div class="link-div">
                    <span>Já é um usuário? <a href="../frontEnd/login.php">Faça Login</a></span>
                </div>
            </form>
        </section>
    </main>

</body>
</html>