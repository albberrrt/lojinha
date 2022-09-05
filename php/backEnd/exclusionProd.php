<?php
require_once '../backEnd/DBconnect.php';

if(isset($_GET['exclusion']) && isset($_GET['productId'])){
    if($_GET['exclusion'] == true){
        $productId = $_GET['productId'];
        $sql = "DELETE FROM `produtos` WHERE produtoId = :productId";
        $bpsql = $conn->prepare($sql);
        $bpsql->execute([':productId' => $productId]);

        header("Location: ../frontEnd/produtos.php");
    } else {
        header("Location: ../frontEnd/error.php?error=808");
    }
} else {
    header("Location: ../frontEnd/error.php?error=808");
}

?>