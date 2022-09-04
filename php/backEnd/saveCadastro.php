<?php

session_start();
require_once '../backEnd/DBconnect.php';

if(empty($_POST['formUser']) || empty($_POST['formPass']) || empty($_POST['formEmail'])) {
    echo "eita";

    header('Location: ../frontEnd/cadastro.php?error=101');

} else {

    $formUser = $_POST['formUser'];
    $formPass = $_POST['formPass'];
    $formEmail = $_POST['formEmail'];
    $profileImg = "../../img/defaultProfile.png";
    $userCartName = str_replace( array( '|', ' ', ',', ';', '<', '>', '?', '.', ':', '/', '!', '@', '#', '(', ')', '$', '[', ']', '{', '}', '+', '-', '=' ), '', $formUser);
    $isDev = 0;
    echo $userCartName;

    $passwordHashed = password_hash($formPass, PASSWORD_DEFAULT);

    $sth = "INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userCart`, `userImg`, `dev`) VALUES (null, :userName, :userEmail, :userPassword, :userCart, :userProfileImg, :dev)";
    $insrt = $conn->prepare($sth);
    $insrt->bindParam(':userName', $formUser, PDO::PARAM_STR);
    $insrt->bindParam(':userEmail', $formEmail, PDO::PARAM_STR);
    $insrt->bindParam(':userPassword', $passwordHashed, PDO::PARAM_STR);
    $insrt->bindParam(':userProfileImg', $profileImg, PDO::PARAM_STR);
    $insrt->bindParam(':userCart', $userCartName, PDO::PARAM_STR);
    $insrt->bindParam(':dev', $isDev, PDO::PARAM_INT);
    $insrt->execute();

    $_SESSION['user_Email'] = $formEmail;
    $_SESSION['user_Name'] = $formUser;
    $_SESSION['user_Cart'] = $userCartName;
    $_SESSION['user_ProfileImg'] = $profileImg;
    $_SESSION['isDev'] = $isDev; 

    $sql = "CREATE TABLE $userCartName (
    produtoId INT NOT NULL PRIMARY KEY,
    FOREIGN KEY (`produtoId`) REFERENCES produtos(`produtoId`)
    )";
    $conn->exec($sql);

    header("Location: ../frontEnd/consulta.php");
}

?>