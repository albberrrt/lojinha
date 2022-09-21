<?php

session_start();
require_once '../backEnd/DBconnect.php';

$errorOk = 0;

    // NOME
    if(empty($_POST['inputProdName'])){
        echo "Nome tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptName = $_POST['inputProdName'];
        echo $inptName . "<br></br>";
    }

    // PREÇO
    if(empty($_POST['inputProdPrice'])){
        echo "Preço tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptPrice = $_POST['inputProdPrice'];
        echo $inptPrice . "<br></br>";

    }

    // DESCONTO
    if($_POST['inputProdDesc'] == ""){
        echo "Desconto tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptDesc = $_POST['inputProdDesc'];
        echo $inptDesc . "<br></br>";
    }

    // ESTOQUE

    if(empty($_POST['inputProdAmount'])){
        echo "Preço tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptAmount = $_POST['inputProdAmount'];
        echo $inptAmount . "<br></br>";
    }

    // CATEGORIA
    if(!isset($_POST['selectCategoria'])){
        echo "Categoria tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptCat = $_POST['selectCategoria'];
        echo $inptCat . "<br></br>";

        // SELECT categoria

        $stmt = $conn->prepare('SELECT categoria FROM categorias WHERE categoriaId = :inptCat');
        $stmt->bindParam(':inptCat', $inptCat, PDO::PARAM_INT);
        $stmt->execute();

        $categoria = $stmt->fetch();
        unset($stmt);
    }

    // PRODUTO STATE

    if($_POST['selectState'] !== ""){
        $inptState = $_POST['selectState'];
        echo $inptState . " alterado <br></br>";
    } else {
        $inptState = $prodInfo['produtoState'];
        echo $inptState . " não alterado <br></br>";
    }

    // IMAGEM
    if($_FILES['inputProdImg']['size'] == 0 && $_FILES['inputProdImg']['error'] == 0){
        echo "Imagem tá vazia" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptImg = basename($_FILES['inputProdImg']['name']);
        echo $inptImg . "<br></br>";
    }

    // GÊNERO
    if(!isset($_POST['selectGenre'])){
        echo "Gênero tá vazio" . "<br></br>";
        $errorOk = 1;
    } else {
        $inptGenre = $_POST['selectGenre'];
        echo $inptGenre . "<br></br>";

        //SELECT GÊNERO

        if($inptGenre == 1){
            $genre = "feminino";
        } else if ($inptGenre == 2){
            $genre = "masculino";
        }

    }

    //VERIFICA SE HOUVE ALGUM ERRO NO FORMULÁRIO
    if($errorOk != 1){

    // CÁLCULO PREÇO FINAL

    $prcFinal = ($inptPrice - ($inptPrice * ($inptDesc / 100)));
    echo $prcFinal . "<br></br>";

    // ESTABELECE VENDAS PARA 0

    $prodVendas = 0;

    //Image Upload

    $target_dir = "../../img/produtoImg/" . $categoria['categoria'] . "/" . $genre . "/";
    $target_file = $target_dir . $inptImg;
    $uploadOk = 1;
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileName = str_replace( array( '|', ' ', ',', ';', '<', '>', '?', '.', ':', '/', '!', '@', '#', '(', ')', '$', '[', ']', '{', '}', '+', '-', '=' ), '', $inptName);
    $inptImg = $fileName . "produtoImg." . $imgFileType;
    $target_file = $target_dir . $inptImg;
    echo $target_file . "<br></br>";

    if(isset($_POST['submit'])){
        $check = getimagesize($_FILES['inputProdImg']['tmp_name']);
        if($check !== false){
            echo "File is a Image - " . $check['mime'];
            $uploadOk = 1;
        } else {
            echo "File is not a Image";
            $uploadOk = 0;
            $errorOk = 1;
        }
    }

    if(file_exists($target_file)){
        echo "File já existe" . "<br></br>";
        $uploadOk = 0;
        $errorOk = 1;
    }

    if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "webp"){
        echo "Sorry but only jpg, png, jpeg and webp are allowed" . "<br></br>";
        $uploadOk = 0;
        $errorOk = 1;
    }

    // VERIFICA SE POSSUI ERROR

    if($errorOk == 1){
        header("Location: ../frontEnd/produtos.php?cadProd=true&error=101");
    
    } else {
        if($uploadOk == 0){
            echo "Sorry your file was not uploaded" . "<br></br>";
        } else {
            if(move_uploaded_file($_FILES['inputProdImg']['tmp_name'], $target_file)){
                echo "The File" . htmlspecialchars(basename($_FILES['inputProdImg']['name'])) . " has been uploaded";
    
            // INSERT DATA
    
            $stmt = "INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `discProduto`, `produtoAmount`, `produtoState`) VALUES (null, :produtoPrc, :produtoPrcFinal, :produtoName, :produtoImg, :produtoImgFile, :categoriaId, :produtoGen, :produtoVendas, :discProduto, :produtoAmount, :produtoState)";
            $insrt = $conn->prepare($stmt);
            $insrt->bindParam(':produtoName', $inptName, PDO::PARAM_STR);
            $insrt->bindParam(':produtoPrc', $inptPrice, PDO::PARAM_STR);
            $insrt->bindParam(':produtoPrcFinal', $prcFinal, PDO::PARAM_STR);
            $insrt->bindParam(':produtoImg', $target_file, PDO::PARAM_STR);
            $insrt->bindParam(':produtoImgFile', $inptImg, PDO::PARAM_STR);
            $insrt->bindParam(':discProduto', $inptDesc, PDO::PARAM_INT);
            $insrt->bindParam(':produtoAmount', $inptAmount, PDO::PARAM_INT);
            $insrt->bindParam(':categoriaId', $inptCat, PDO::PARAM_INT);
            $insrt->bindParam(':produtoGen', $inptGenre, PDO::PARAM_INT);
            $insrt->bindParam(':produtoState', $inptState, PDO::PARAM_INT);
            $insrt->bindParam(':produtoVendas', $prodVendas, PDO::PARAM_INT);
            $insrt->execute();
            unset($insrt);
            
            header("Location: ../frontEnd/produtos.php");

            } else {
                echo "Deu pra uploadar não";
            }
        }
    }
} else {
    header("Location: ../frontEnd/produtos.php?cadProd=true&error=202");
}
?>