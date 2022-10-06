<?php 
require_once '../backEnd/DBconnect.php';

if($user->registerUser("albertt", "albertsmac@gmail.com", 12334)){
    echo "DEU BOM";
} else {
    echo "DEU NÃO";
}



?>