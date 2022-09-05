<?php
require_once '../backEnd/DBconnect.php';

$sql = "SELECT * FROM categorias";
$stmtCat = $conn->query($sql);
$categoria = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
$categoriaLenght = $stmtCat->rowCount();

?>