<?php
require_once '../backEnd/DBconnect.php';

if(isset($_GET['exclusion']) && isset($_GET['userId'])){
    if($_GET['exclusion'] == true){
        $userId = $_GET['userId'];
        echo $userId . "<br></br>";

        $sql = "SELECT userCart FROM users WHERE userId = :userId";
        $slsql = $conn->prepare($sql);
        $slsql->execute([':userId' => $userId]);
        unset($sql);

        $cartName_ = $slsql->fetch();
        $cartName = $cartName_['userCart'];
        echo $cartName;
        unset($slsql);
        $sql = "DROP TABLE $cartName";
        $conn->exec($sql);

        $stmt = "DELETE FROM `users` WHERE userId = :userId";
        $bpsql = $conn->prepare($stmt);
        $bpsql->execute([':userId' => $userId]);

        

        

        // header("Location: ../frontEnd/usuarios.php");
    } else {
        header("Location: ../frontEnd/error.php?error=707");
    }
} else {
    header("Location: ../frontEnd/error.php?error=808");
}

?>