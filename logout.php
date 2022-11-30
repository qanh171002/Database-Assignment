<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['user_name']);
session_destroy();
header("Location: login.php");
