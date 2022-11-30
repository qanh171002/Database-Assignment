<?php

include_once app_root . "/Database.php";

function userCheckLogin($username, $password)
{
    $db = Database::getInstance();

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' ";
    $result = mysqli_query($db->con, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}
// function adminCheckLogin($email, $password)
// {

//     $db = new DB();

//     $user = $db->getInstance();

//     $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND roleID='1'";
//     $result = mysqli_query($user->con, $sql);
//     $num_rows = mysqli_num_rows($result);
//     if ($num_rows > 0) {
//         return $result;
//     } else {
//         return false;
//     }
// }