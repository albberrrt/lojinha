<?php

require_once '../backEnd/DBconnect.php';

$sql = "SELECT userId, userName, userEmail, dev FROM users";

$stmt = $conn->query($sql);