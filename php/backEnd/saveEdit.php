<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once '../backEnd/DBconnect.php';

if(isset($_GET['productId'])){
    $productId = $_GET['productId'];

    $sql = "SELECT produtoName, produtoPrc, discProduto, categoriaId, produtoGen FROM produtos WHERE produtoId = $productId";
    $stmtProd = $conn->query($sql);
    $prodInfo = $stmtProd->fetch();

    echo $prodInfo['produtoName'] . "<br></br>";
    echo $prodInfo['produtoPrc'] . "<br></br>";
    echo $prodInfo['discProduto'] . "<br></br>";
    echo $prodInfo['categoriaId'] . "<br></br>";
    echo $prodInfo['produtoGen'] . "<br></br><br></br>";

    //Nome
    if(!empty($_POST['inputProdName'])){
        $newProdName = $_POST['inputProdName'];
        echo $newProdName . " alterado <br></br>";
    } else {
        $newProdName = $prodInfo['produtoName'];
        echo $newProdName . " não alterado <br></br>";
    }
    // Preço
    if(!empty($_POST['inputProdPrice'])){
        $newProdPrice = $_POST['inputProdPrice'];
        echo $newProdPrice . " alterado <br></br>";
    } else {
        $newProdPrice = $prodInfo['produtoPrc'];
        echo $newProdPrice . " não alterado <br></br>";
    }
    // Desconto
    if($_POST['inputProdDesc'] !== ""){
        $newProdDesc = $_POST['inputProdDesc'];
        echo $newProdDesc . " alterado <br></br>";
    } else {
        $newProdDesc = $prodInfo['discProduto'];
        echo $newProdDesc . " não alterado <br></br>";
    }
    // Categoria
    if(isset($_POST['selectCategoria'])){
        $newProdCategoria = $_POST['selectCategoria'];
        echo $newProdCategoria . " alterado <br></br>";
    } else {
        $newProdCategoria = $prodInfo['categoriaId'];
        echo $newProdCategoria . " não alterado <br></br>";
    }
    // Gênero
    if(isset($_POST['selectGenre'])){
        $newProdGenre = $_POST['selectGenre'];
        echo $newProdGenre . " alterado <br></br>";
    } else {
        $newProdGenre = $prodInfo['produtoGen'];
        echo $newProdGenre . " não alterado";
    }

    // Alterar no Banco de Dados

    $stmt = "UPDATE `produtos` SET `produtoName` = :produtoName, `produtoPrc` = :produtoPrc, `discProduto` = :discProduto, `categoriaId` = :categoriaId, `produtoGen` = :produtoGen WHERE `produtos`.`produtoId` = :produtoId;
    UPDATE `produtos` SET `produtoPrcFinal` = (produtoPrc - (produtoPrc * (discProduto / 100))) WHERE produtoId = :produtoId;";
    $insrt = $conn->prepare($stmt);
    $insrt->bindParam(':produtoName', $newProdName, PDO::PARAM_STR);
    $insrt->bindParam(':produtoPrc', $newProdPrice, PDO::PARAM_STR);
    $insrt->bindParam(':discProduto', $newProdDesc, PDO::PARAM_INT);
    $insrt->bindParam(':categoriaId', $newProdCategoria, PDO::PARAM_INT);
    $insrt->bindParam(':produtoGen', $newProdGenre, PDO::PARAM_INT);
    $insrt->bindParam(':produtoId', $productId, PDO::PARAM_INT);
    $insrt->execute();

    header("Location: ../frontEnd/produtos.php");

} else {
    header("Location: ../frontEnd/error.php?error=707");
}


?>