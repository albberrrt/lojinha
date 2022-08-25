<?php

require_once '../backEnd/DBconnect.php';

$sql = "SELECT userId, userName, userEmail FROM users";

$stmt = $conn->query($sql);