<?php
require_once(app_root . '/Database.php');
class Curriculum
{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM curriculum";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getBookOfUser($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM curriculum,possess WHERE curriculum.curriCode=possess.curriCode AND userID='$id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
