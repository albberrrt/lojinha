<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/mainStyle.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../css/loginStyle.css" media="screen" type="text/css">

    <title>Entrar</title>
</head>
<body>
    <header>
        <h1>BigodeShop</h1>
    </header>
    <main>
        <section>
            <form action="../backEnd/saveLogin.php" method="POST">
                <div class="input-div">
                    <input type="text" id="inputName" class="inputLogin" name="formUser" autocomplete="off" placeholder=" ">
                    <label for="inputName" class="placeholder-input">Email ou nome de usuário</label>
                </div>
                <div class="input-div">
                    <input type="password" id="inputPass" class="inputLogin" name="formPass" autocomplete="off" placeholder=" ">
                    <label for="inputPass" class="placeholder-input">Senha</label>
                </div>
                <div>
                    <button>Entrar</button>
                </div>
            </form>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>