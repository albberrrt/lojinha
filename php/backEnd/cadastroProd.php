<?php

session_start();
require_once '../backEnd/DBconnect.php';

    // NOME
    if(empty($_POST['inputProdName'])){
        echo "Nome tá vazio" . "<br></br>";
    } else {
        $inptName = $_POST['inputProdName'];
        echo $inptName . "<br></br>";
    }

    // PREÇO
    if(empty($_POST['inputProdPrice'])){
        echo "Preço tá vazio" . "<br></br>";
    } else {
        $inptPrice = $_POST['inputProdPrice'];
        echo $inptPrice . "<br></br>";

    }

    // DESCONTO
    if($_POST['inputProdDesc'] == ""){
        echo "Desconto tá vazio" . "<br></br>";
    } else {
        $inptDesc = $_POST['inputProdDesc'];
        echo $inptDesc . "<br></br>";
    }

    // CATEGORIA
    if(!isset($_POST['selectCategoria'])){
        echo "Categoria tá vazio" . "<br></br>";
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

    // IMAGEM
    if($_FILES['inputProdImg']['size'] == 0 && $_FILES['inputProdImg']['error'] == 0){
        echo "Imagem tá vazia" . "<br></br>";
    } else {
        $inptImg = basename($_FILES['inputProdImg']['name']);
        echo $inptImg . "<br></br>";
    }

    // GÊNERO
    if(!isset($_POST['selectGenre'])){
        echo "Gênero tá vazio" . "<br></br>";
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
    echo $target_file . "<br></br>";

    if(isset($_POST['submit'])){
        $check = getimagesize($_FILES['inputProdImg']['tmp_name']);
        if($check !== false){
            echo "File is a Image - " . $check['mime'];
            $uploadOk = 1;
        } else {
            echo "File is not a Image";
            $uploadOk = 0;
        }
    }

    if(file_exists($target_file)){
        echo "File já existe" . "<br></br>";
        $uploadOk = 0;
    }

    if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "webp"){
        echo "Sorry but only jpg, png, jpeg and webp are allowed" . "<br></br>";
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo "Sorry your file was not uploaded" . "<br></br>";
    } else {
        if(move_uploaded_file($_FILES['inputProdImg']['tmp_name'], $target_file)){
            echo "The File" . htmlspecialchars(basename($_FILES['inputProdImg']['name'])) . " has been uploaded";

        // INSERT DATA

        $stmt = "INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `categoriaId`, `produtoGen`, `produtoVendas`, `discProduto`) VALUES (null, :produtoPrc, :produtoPrcFinal, :produtoName, :produtoImg, :categoriaId, :produtoGen, :produtoVendas, :discProduto)";
        $insrt = $conn->prepare($stmt);
        $insrt->bindParam(':produtoName', $inptName, PDO::PARAM_STR);
        $insrt->bindParam(':produtoPrc', $inptPrice, PDO::PARAM_STR);
        $insrt->bindParam(':produtoPrcFinal', $prcFinal, PDO::PARAM_STR);
        $insrt->bindParam(':produtoImg', $target_file, PDO::PARAM_STR);
        $insrt->bindParam(':discProduto', $inptDesc, PDO::PARAM_INT);
        $insrt->bindParam(':categoriaId', $inptCat, PDO::PARAM_INT);
        $insrt->bindParam(':produtoGen', $inptGenre, PDO::PARAM_INT);
        $insrt->bindParam(':produtoVendas', $prodVendas, PDO::PARAM_INT);
        $insrt->execute();
        unset($insrt);

        } else {
            echo "Deu pra uploadar não";
        }
    }

    header("Location: ../frontEnd/produtos.php");

?>