<?php

session_start();

unset($_SESSION['user_Name']);
unset($_SESSION['user_Email']);
unset($_SESSION['user_Cart']);
unset($_SESSION['user_ProfileImg']);

session_unset();
session_destroy();

header("Location: ../frontEnd/home.php");