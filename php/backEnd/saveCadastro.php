<?php

require_once '../backEnd/DBconnect.php';

if(empty($_POST['formUser']) || empty($_POST['formPass']) || empty($_POST['formEmail'])) {
    echo "eita";

    header('Location: ../frontEnd/cadastro.php?error=101');

} else {

    $formUser = $_POST['formUser'];
    $formPass = $_POST['formPass'];
    $formEmail = $_POST['formEmail'];
    $profileImg = "../../img/defaultProfile.png";
    $userCartName = $formUser . "Cart";
    echo $userCartName;

    $passwordHashed = password_hash($formPass, PASSWORD_DEFAULT);

    $sth = "INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userCart`, `userImg`) VALUES (null, :userName, :userEmail, :userPassword, :userCart, :userProfileImg)";
    $insrt = $conn->prepare($sth);
    $insrt->bindParam(':userName', $formUser, PDO::PARAM_STR);
    $insrt->bindParam(':userEmail', $formEmail, PDO::PARAM_STR);
    $insrt->bindParam(':userPassword', $passwordHashed, PDO::PARAM_STR);
    $insrt->bindParam(':userProfileImg', $profileImg, PDO::PARAM_STR);
    $insrt->bindParam(':userCart', $userCartName, PDO::PARAM_STR);
    $insrt->execute();

}

?>