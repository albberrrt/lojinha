<?php 
require_once '../backEnd/DBconnect.php';

    if(isset($_POST['searchInput'])){
        $search = $_POST['searchInput'];
        echo "search: " . $search;
    }




?>