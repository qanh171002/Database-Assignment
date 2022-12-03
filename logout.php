<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['user_name']);
unset($_SESSION['userRole']);
session_destroy();
header("Location: login.php");
