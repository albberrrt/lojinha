<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <title>Cadastro</title>
</head>
<body>
    
    <main>
        <section>
            <form action="../backEnd/saveCadastro.php" method="POST">
                <div>
                    <label class="label-input">Nome</label>
                    <input type="text" class="name-input" name="formUser" autocomplete="off">
                </div>
                <div>
                    <label class="label-input">Email</label>
                    <input type="email" class="email-input" name="formEmail" autocomplete="off">
                </div>
                <div>
                    <label class="label-input">Senha</label>
                    <input type="password" class="pass-input" name="formPass" autocomplete="off">
                </div>
                <div>
                    <button>Cadastrar-se</button>
                </div>
            </form>
        </section>
    </main>

</body>
</html>