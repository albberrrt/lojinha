<?php 
require_once '../backEnd/DBconnect.php';

    if(isset($_POST['searchInput'])){
        if($_POST['searchInput'] !== ""){
            $search = strtolower($_POST['searchInput']);
            $search = trim($search);
            echo "search: " . $search;

            header("Location: ../frontEnd/home.php?page=search&search=$search");
        } else {
            header("Location: ../frontEnd/home.php?page=home");
        }
    } else {
        header("Location: ../frontEnd/home.php?page=home");
    }




?>