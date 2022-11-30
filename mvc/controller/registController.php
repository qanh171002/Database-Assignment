<?php
require_once(app_root . '/Database.php');
function insert($fullName, $gender, $email, $dob, $address, $username, $password, $phone, $role)
{
    $db = Database::getInstance();

    $sql = "INSERT INTO user(fullName, gender, email, dob, address, username, password, phoneNum, userRole) VALUES ('$fullName','$gender','$email','$dob','$address','$username','$password','$phone', '$role')";
    $result = mysqli_query($db->con, $sql);
    //echo mysqli_error($user->con);
    if ($result) {
        return true;
    } else return false;
}



function checkEmail($email)
{
    $db = Database::getInstance();

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($db->con, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

function checkUserName($username)
{
    $db = Database::getInstance();

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($db->con, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        return false;
    } else {
        return true;
    }
}
