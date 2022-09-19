<?php
require_once '../backEnd/DBconnect.php';

if(isset($_GET['exclusion']) && isset($_GET['productId'])){
    if($_GET['exclusion'] == true){
        $productId = $_GET['productId'];
        $sql = "SELECT produtoImg FROM produtos WHERE produtoId = :productId";
        $slsql = $conn->prepare($sql);
        $slsql->execute([':productId' => $productId]);

        $imgFile = $slsql->fetch();
        if(unlink($imgFile['produtoImg'])){
            $stmt = "DELETE FROM `produtos` WHERE produtoId = :productId";
            $bpsql = $conn->prepare($stmt);
            $bpsql->execute([':productId' => $productId]);
        } else {
            echo "xiiii";
        }

        

        header("Location: ../frontEnd/produtos.php");
    } else {
        header("Location: ../frontEnd/error.php?error=808");
    }
} else {
    header("Location: ../frontEnd/error.php?error=808");
}

?>