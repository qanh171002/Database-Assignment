<?php
session_start();
require_once '../../define.php';
require_once app_root . '/Database.php';
if (!isset($_SESSION['userID'])) {
    header("Location: " . web_root . "/login.php");
} else {
    if (isset($_POST['courseID'])) {
        if (checkLearn($_POST['courseID'], $_SESSION['userID'])) {
            header('Location: ' . web_root . '/index.php?q=mycourse');
        } else {
            attend($_POST['courseID'], $_SESSION['userID']);
            header('Location: ' . web_root . '/index.php?q=course');
        }
    }
}

function attend($courseID, $studentID)
{
    $newDate  = date("Y-m-d");
    $db = Database::getInstance();
    $sql = "INSERT INTO attend VALUES ('$courseID','$studentID','$newDate',0,0)";
    $result =  mysqli_query($db->con, $sql);
    return $result;
}

function checkLearn($courseID, $studentID)
{

    $db = Database::getInstance();
    $sql = "SELECT * FROM attend WHERE studentID='$studentID' AND courseID='$courseID'";
    $result =  mysqli_query($db->con, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
