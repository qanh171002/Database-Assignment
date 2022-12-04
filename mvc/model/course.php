<?php


require_once(app_root . '/Database.php');
class Course
{

    // private static $instance = null;

    // // public static function getInstance()
    // // {
    // //     if (!self::$instance) {
    // //         self::$instance = new Course();
    // //     }

    // //     return self::$instance;
    // // }

    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM course";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    // public function getPage($page)
    // {
    //     $db = Database::getInstance();
    //     $per_page_record = 6;  // Number of entries to show in a page.   
    //     $start_from = ($page - 1) * $per_page_record;

    //     $sql = "SELECT * FROM Products  WHERE qty>0 LIMIT $start_from, $per_page_record";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function getPageandCateid($page, $cateid)
    // {
    //     $db = Database::getInstance();
    //     $per_page_record = 6;  // Number of entries to show in a page.   
    //     $start_from = ($page - 1) * $per_page_record;
    //     $sql = "SELECT * FROM Products  WHERE cateId='$cateid' AND qty>0 LIMIT $start_from, $per_page_record";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function getPageandSearch($page, $searchkey)
    // {
    //     $db = Database::getInstance();
    //     $per_page_record = 6;  // Number of entries to show in a page.   
    //     $start_from = ($page - 1) * $per_page_record;
    //     $tmp = '%' . $searchkey . '%';
    //     $sql = "SELECT * FROM Products  WHERE name LIKE '$tmp' AND qty>0 LIMIT $start_from, $per_page_record";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function search($keyword)
    // {
    //     $db = Database::getInstance();
    //     $sql = "SELECT * FROM Products WHERE MATCH(name,des) AGAINST ('$keyword') AND status=1";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    public function getById($Id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM course WHERE courseID='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getLesson($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM lesson WHERE courseID='$id' ORDER BY no";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getBook($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM `use` INNER JOIN curriculum ON `use`.curriCode = curriculum.curriCode WHERE courseID='$id' ";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getCourseOfStudent($userid)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM course, attend WHERE course.courseID = attend.courseID AND studentID='$userid'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getCourseOfTeacher($userid)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM course WHERE teacherID='$userid'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function createCourse($courseID, $userid, $courseName, $des, $fee, $image)
    {
        $db = Database::getInstance();
        $createTime = date("Y-m-d h:i:sa");
        $sql = "INSERT INTO course (courseID, teacherID, courseName, description, fee, createTime,image) VALUES ('$courseID','$userid','$courseName','$des','$fee','$createTime','$image')";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function addLesson($courseID, $lessonName, $duration, $content, $exercise)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM course WHERE courseID='$courseID'";
        $result = mysqli_query($db->con, $sql);
        if (mysqli_num_rows($result) <= 0) return false;
        $lessonNum = null;
        while ($data = $result->fetch_assoc()) $lessonNum = $data['lessonNum'];
        echo $lessonNum;
        $lessonNum = $lessonNum + 1;
        $sql = "INSERT INTO lesson (courseID, no, lessonName, duration, lessonSrc,exercise) VALUES ('$courseID','$lessonNum','$lessonName','$duration','$content','$exercise')";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
    // public function getByCateId($CateId)
    // {
    //     $db = Database::getInstance();
    //     $sql = "SELECT * FROM Products WHERE cateId='$CateId' AND qty>0";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function getFeaturedProducts()
    // {
    //     $db = Database::getInstance();
    //     $sql = "SELECT * FROM Products WHERE status=1 ORDER BY soldCount DESC";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function checkQuantity($Id, $qty)
    // {
    //     $db = Database::getInstance();
    //     $sql = "SELECT qty FROM Products WHERE status=1 AND Id='$Id'";
    //     $result = mysqli_query($db->con, $sql);
    //     $product = $result->fetch_assoc();
    //     if (intval($qty) > intval($product['qty'])) {
    //         return false;
    //     }
    //     return true;
    // }

    // public function updateQuantity($Id, $qty)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET qty = qty - $qty WHERE id = $Id";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function searchKey($key)
    // {
    //     $db = Database::getInstance();
    //     $tmp = '%' . $key . '%';
    //     $sql = "SELECT * FROM products WHERE name LIKE '$tmp'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function removeProductById($productId)
    // {
    //     $db = Database::getInstance();
    //     $sql = "DELETE FROM products WHERE id='$productId'";
    //     mysqli_query($db->con, $sql);
    //     echo mysqli_error($db->con);
    // }

    // public function addNewProduct($listValue)
    // {
    //     $db = new Database();

    //     $product = $db->getInstance();

    //     $sql = "INSERT INTO products(id, name, originalPrice, promotionPrice,image, createdBy, createdDate, cateId, qty, des,status, soldCount) VALUES
    //          (NULL,'$listValue[0]','$listValue[1]','$listValue[2]','$listValue[3]','$listValue[4]','$listValue[5]','$listValue[6]','$listValue[7]','$listValue[8]','1','0')";
    //     $result = mysqli_query($product->con, $sql);
    //     if ($result) {
    //         return 1;
    //     }
    //     return mysqli_error($product->con);
    // }


    // public function changeNameById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET name = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function changePriceById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET originalPrice = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }


    // public function changeCreatedDateById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET createdDate = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function changeCateIdById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET cateId = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function changeQtyById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET qty = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }

    // public function changeDesById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET des = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }


    // public function changeSoldoutById($productId, $value)
    // {
    //     $db = Database::getInstance();
    //     $sql = "UPDATE products SET soldCount = '$value' WHERE id='$productId'";
    //     $result = mysqli_query($db->con, $sql);
    //     return $result;
    // }
}
