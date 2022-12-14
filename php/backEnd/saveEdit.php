<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once '../backEnd/DBconnect.php';

if(isset($_GET['productId'])){
    $productId = $_GET['productId'];

    $sql = "SELECT produtoName, produtoPrc, discProduto, produtoAmount, categoriaId, produtoGen, produtoImg, produtoImgFile, produtoState, produtoTags FROM produtos WHERE produtoId = $productId";
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
        $changeImgName = 1;
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

    // Estoque

    if(!empty($_POST['inputProdAmount'])){
        $newProdAmount = $_POST['inputProdAmount'];
        echo $newProdAmount . " alterado <br></br>";
    } else {
        $newProdAmount = $prodInfo['produtoAmount'];
        echo $newProdAmount . " não alterado <br></br>";
    }

    // Tags

    if(!empty($_POST['inputProdTags'])){
        $newProdTags = $_POST['inputProdTags'];
        echo $newProdTags . " alterado <br></br>";
    } else {
        $newProdTags = $prodInfo['produtoTags'];
        echo $newProdTags . " não alterado <br></br>";
    }

    // Categoria

    if(isset($_POST['selectCategoria'])){
        $newProdCategoria = $_POST['selectCategoria'];
        echo $newProdCategoria . " alterado <br></br>";
        $changeImgCat = 1;
        
    } else {
        $newProdCategoria = $prodInfo['categoriaId'];
        echo $newProdCategoria . " não alterado <br></br>";
    }

    // Estado do produto

    if($_POST['selectState'] == ""){
        $newProdState = $prodInfo['produtoState'];
        echo $newProdState . " não alterado <br></br>";
    } else {
        $newProdState = $_POST['selectState'];
        echo $newProdState . " alterado <br></br>";
    }

    // SELECT categoria

    $stmt = $conn->prepare('SELECT categoria FROM categorias WHERE categoriaId = :inptCat');
    $stmt->bindParam(':inptCat', $newProdCategoria, PDO::PARAM_INT);
    $stmt->execute();

    $categoria = $stmt->fetch();
    unset($stmt);

    // Gênero

    if(isset($_POST['selectGenre'])){
        $newProdGenre = $_POST['selectGenre'];
        echo $newProdGenre . " alterado <br></br>";
        $changeImgGenre = 1;
    } else {
        $newProdGenre = $prodInfo['produtoGen'];
        echo $newProdGenre . " não alterado <br></br>";
    }

    //SELECT GÊNERO

    if($newProdGenre == 1){
        $genre = "feminino";
    } else if ($newProdGenre == 2){
        $genre = "masculino";
    }

    // IMAGEMMMMMM
    
    echo "///////DEBUG DA IMAGEM <br></br>";

    if($_FILES['inputProdImg']['size'] == 0){
        echo "Imagem tá vazia" . "<br></br>";
        $imgFileType = ".jpg";
        $fileName = str_replace( array( '|', ' ', ',', ';', '<', '>', '?', '.', ':', '/', '!', '@', '#', '(', ')', '$', '[', ']', '{', '}', '+', '-', '=' ), '', $newProdName);
        $inptImg = $fileName . "produtoImg." . $imgFileType;
        echo "inptImg: " . $inptImg . "<br></br>";
        $imgAltered = 0;
    } else {
        $inptImg = basename($_FILES['inputProdImg']['name']);
        echo "inptImg: " . $inptImg . "<br></br>";
        $imgAltered = 1;
        echo $_FILES['inputProdImg']['size'];
    }

    //Image Upload

    if($imgAltered == 1){

        // IMAGEM ALTERADA

        echo "Alteração será feito no DB; Upload da Imagem será feito. <br></br>";

        //Deleta a imagem antiga para uploadar a nova
        if(unlink($prodInfo['produtoImg'])){
            echo "Imagem anterior excluída com sucesso! <br></br>";
        } else {
            echo "Imagem anterior não foi excluída <br></br>";
        }

        //Início do upload
        $target_dir = "../../img/produtoImg/" . $categoria['categoria'] . "/" . $genre . "/";
        $target_file = $target_dir . $inptImg;
        $uploadOk = 1;
        $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $fileName = str_replace( array( '|', ' ', ',', ';', '<', '>', '?', '.', ':', '/', '!', '@', '#', '(', ')', '$', '[', ']', '{', '}', '+', '-', '=' ), '', $newProdName);
        $inptImg = $fileName . "produtoImg." . $imgFileType;
        $target_file = $target_dir . $inptImg;
        echo "target file: " . $target_file . "<br></br>";

        if(isset($_POST['submit'])){
            $check = getimagesize($_FILES['inputProdImg']['tmp_name']);
            if($check !== false){
                echo "File is a Image - " . $check['mime'];
                $uploadOk = 1;
            } else {
                echo "File is not a Image";
                $uploadOk = 0;
                header("Location: ../frontEnd/produtos.php?edit=true&productId=$productId&error=101");
            }
        }

        if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "webp"){
            echo "Sorry but only jpg, png, jpeg and webp are allowed" . "<br></br>";
            $uploadOk = 0;
            header("Location: ../frontEnd/produtos.php?edit=true&productId=$productId&error=103");
        }
    } else {

        // IMAGEM NÃO ALTERADA

        $uploadOk = 2;
        echo "Alteração será feito no DB; Upload da Imagem não será feito // uploadOk = ". $uploadOk . "<br></br>";
        $target_dir = "../../img/produtoImg/" . $categoria['categoria'] . "/" . $genre . "/";
        $target_file = $target_dir . $inptImg;
        $old_target_file = $prodInfo['produtoImg'];
        echo $old_target_file;
        echo "target file: " . $target_file . "<br></br>";
        if($changeImgGenre == 1 || $changeImgCat == 1 || $changeImgName == 1){
            rename($old_target_file, $target_file);
        }

    }

    // Alterar no Banco de Dados

    if($uploadOk == 0){
        echo "Sorry your file was not uploaded" . "<br></br>";
    } else if($uploadOk == 1 || $uploadOk == 2){
        if($uploadOk == 1){
            if(move_uploaded_file($_FILES['inputProdImg']['tmp_name'], $target_file)){
                echo "The File" . htmlspecialchars(basename($_FILES['inputProdImg']['name'])) . " has been uploaded";
            }
        }
            $stmt = "UPDATE `produtos` SET `produtoName` = :produtoName, `produtoPrc` = :produtoPrc, `discProduto` = :discProduto, `produtoAmount` = :produtoAmount, `categoriaId` = :categoriaId, `produtoGen` = :produtoGen, `produtoImg` = :produtoImg, `produtoImgFile` = :produtoImgFile, `produtoState` = :produtoState, `produtoTags` = :produtoTags WHERE `produtos`.`produtoId` = :produtoId;
            UPDATE `produtos` SET `produtoPrcFinal` = (produtoPrc - (produtoPrc * (discProduto / 100))) WHERE produtoId = :produtoId;";
            $insrt = $conn->prepare($stmt);
            $insrt->bindParam(':produtoName', $newProdName, PDO::PARAM_STR);
            $insrt->bindParam(':produtoTags', $newProdTags, PDO::PARAM_STR);
            $insrt->bindParam(':produtoPrc', $newProdPrice, PDO::PARAM_STR);
            $insrt->bindParam(':produtoImg', $target_file, PDO::PARAM_STR);
            $insrt->bindParam(':produtoImgFile', $inptImg, PDO::PARAM_STR);
            $insrt->bindParam(':discProduto', $newProdDesc, PDO::PARAM_INT);
            $insrt->bindParam(':produtoAmount', $newProdAmount, PDO::PARAM_INT);
            $insrt->bindParam(':categoriaId', $newProdCategoria, PDO::PARAM_INT);
            $insrt->bindParam(':produtoGen', $newProdGenre, PDO::PARAM_INT);
            $insrt->bindParam(':produtoState', $newProdState, PDO::PARAM_INT);
            $insrt->bindParam(':produtoId', $productId, PDO::PARAM_INT);
            $insrt->execute();

            header("Location: ../frontEnd/produtos.php");
            
        
    } else {
        echo "Deu pra uploadar não";
    }

} else {
    header("Location: ../frontEnd/error.php?error=707");
}


?>