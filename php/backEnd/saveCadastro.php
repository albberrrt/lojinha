<?php

require_once '../backEnd/DBconnect.php';

if(empty($_POST['formUser']) || empty($_POST['formPass']) || empty($_POST['formEmail'])) {
    echo "eita";

    header('Location: ../frontEnd/cadastro.php?error=101');

} else {
    
    $formUser = $_POST['formUser'];
    $formPass = $_POST['formPass'];
    $formEmail = $_POST['formEmail'];
    

}





?>