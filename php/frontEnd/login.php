<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
</head>
<body>
    
    <main>
        <section>
            <form action="../backEnd/saveLogin.php" method="POST">
                <div>
                    <label class="label-input">Nome</label>
                    <input type="text" class="name-input" name="formUser" autocomplete="off">
                </div>
                <div>
                    <label class="label-input">Senha</label>
                    <input type="password" class="pass-input" name="formPass" autocomplete="off">
                </div>
                <div>
                    <button>Entrar</button>
                </div>
            </form>
        </section>
    </main>

</body>
</html>