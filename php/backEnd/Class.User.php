<?php

class User{

   private $db; 

   function __construct($conn){
      $this -> db = $conn;
   }

   public function registerUser($userName, $userEmail, $userPass){
      try {
         $userImg = "../../img/defaultProfile.png";
         $userCartName = str_replace( array( '|', ' ', ',', ';', '<', '>', '?', '.', ':', '/', '!', '@', '#', '(', ')', '$', '[', ']', '{', '}', '+', '-', '=' ), '', $userName) . "Cart";
         $passHashed = password_hash($userPass, PASSWORD_DEFAULT);
         $isDev = 0;

         $stmt = $this->db->prepare("INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userCart`, `userImg`, `dev`) 
         VALUES (null, :userName, :userEmail, :userPassword, :userCart, :userProfileImg, :dev);
         CREATE TABLE $userCartName (
            produtoId INT NOT NULL PRIMARY KEY,
            FOREIGN KEY (`produtoId`) REFERENCES produtos(`produtoId`)
         )");
         $stmt->bindParam(":userName", $userName);
         $stmt->bindParam(":userEmail", $userEmail);
         $stmt->bindParam(":userPassword", $passHashed);
         $stmt->bindParam(":userCart", $userCartName);
         $stmt->bindParam(":userProfileImg", $userImg);
         $stmt->bindParam(":dev", $isDev);
         $stmt->execute();
         
         return $stmt;


      } catch(PDOException $e) {
         echo $e -> getMessage();
      }
   }

   public function loginUser($userName, $userPass){
      try{

         $stmt = $this->db->prepare("SELECT * FROM users WHERE userName = :userInput OR userEmail = :userInput");
         $stmt->bindParam(':userInput', $userName, PDO::PARAM_STR);
         $stmt->execute();

         if($stmt->rowCount() === 1){
            $userRow = $stmt->fetch(PDO:FETCH_ASSOC);

            if(password_verify($userPass, $userRow['userPassword'])){
               
            }
         }

      } catch(PDOException $e) {
         echo $e -> getMessage();
      }
   }

   

}

?>