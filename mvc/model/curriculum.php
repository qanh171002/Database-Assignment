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
}
