<?php

if(empty($_POST['formUser']) || empty($_POST['formPass'])){

    echo "tá vazio manin";
    header('Location: ../frontEnd/login.php?error=101');
    
} else {
    $formUser = $_POST['formUser'];
    $formPass = $_POST['formPass'];

    echo "Login feito";
}
?>