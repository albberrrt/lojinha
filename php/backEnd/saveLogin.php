<?php
require_once '../backEnd/DBconnect.php';

if(empty($_POST['formUser']) || empty($_POST['formPass'])){

    echo "tá vazio manin";
    header('Location: ../frontEnd/login.php?error=101');
    
} else {
    $formUser = $_POST['formUser'];
    $formPass = $_POST['formPass'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE userEmail= :userInput OR userName = :userInput');
    $stmt->bindParam(':userInput', $formUser, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();

        $user_Id = $user['userId'];
        $user_Email = $user['userEmail'];
        $user_Name = $user['userName'];
        $user_Password = $user['userPassword'];
        $user_ProfileImg = $user['userImg'];
        $user_Cart = $user['userCart'];
        
        if($formUser === $user_Email or $formUser === $user_Name) {
            if (password_verify($formPass, $user['userPassword'])) {
                $_SESSION['user_Id'] = $user_Id;
                $_SESSION['user_Email'] = $user_Email;
                $_SESSION['user_Name'] = $user_Name;
                $_SESSION['user_Cart'] = $user_Cart;
                $_SESSION['user_ProfileImg'] = $user_ProfileImg;
                
                header("Location: ../frontEnd/home.php");
                
            } else {
                header("Location: ../frontEnd/login.php?error=Incorrect_data&email=$formUser");
                
            }
        } else {
            header("Location: ../frontEnd/login.php?error=Incorrect_data&email=$formUser");
        }
    } else {
        header("Location: ../frontEnd/login.php?error=Incorrect_data&email=$formUser");
    }
}
?>