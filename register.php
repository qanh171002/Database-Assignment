<?php
require_once 'define.php';
require app_root . '/controller/registController.php';
?>
<?php
if (isset($_POST['RegisterAction'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    //$image = $_FILES['image']['name'];
    //$image_tmp_name = $_FILES['image']['tmp_name'];
    //$image_folder = '../../image/' . $image;
    $checkEmail = checkEmail($email);
    $checkUsername = checkUserName($username);

    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        $message = "Email không hợp lệ";
    } else if (!$checkEmail) {
        //header("Location: ../views/regist.php");
        $message = 'Người dùng đã tồn tại';
    } else if (!preg_match("/^0([0-9]){9}$/", $phone)) {
        $message = "Số điện thoại không hợp lệ";
    } else if (strlen($password) < 6 || strlen($password) > 15) {
        $message = "Mật khẩu không hợp lệ";
    } else {
        $result = insert($fullName, $gender, $email, $dob, $address, $username, $password, $phone, $role);
        if ($result) {
            //move_uploaded_file($image_tmp_name, $image_folder);
            $message = "Đăng ký thành công";
        } else {
            $message = "Đăng ký thất bại";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fav and touch icons -->

</head>


<body>

    <div class="container my-5">
        <div class="login">
            <div class="login-triangle"></div>
            <h2 class="login-header">Đăng ký</h2>


            <form action="" method="post" class="login-container" enctype="multipart/form-data">
                <?php
                if (isset($message)) {
                    echo '<div class="message">' . $message . '</div>';
                }
                ?>
                <p><input type="text" placeholder="Họ tên" name="fullName" required></p>
                <label for="gender">Giới tính: </label>
                <select name="gender">
                    <option value="F">Nữ</option>
                    <option value="M">Nam</option>
                </select>
                <p><input type="text" placeholder="Email" name="email" required></p>
                <p><input type="text" placeholder="Số điện thoại" name="phone"></p>
                <p><input type="date" name="dob"></p>
                <p><input type="text" placeholder="Địa chỉ" name="address"></p>
                <p><input type="text" placeholder="Tên đăng nhập" name="username"></p>
                <p><input type="password" id="password" placeholder="Mật khẩu từ 6 ký tự tới 15 ký tự" name="password" required></p>
                <p><input type="password" placeholder="Nhập lại mật khẩu" name="repassword" required oninput="check(this)"></p>
                <label for="role">You are: </label>
                <select name="role">
                    <option value="S">Student</option>
                    <option value="T">Teacher</option>
                </select>
                <p><input type="submit" name="RegisterAction" value="Đăng ký"></p>
                <p> Đã có tài khoản? <a href="login.php"> Đăng nhập ngay</a></p>
            </form>
        </div>
    </div>

    <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>

</body>

</html>