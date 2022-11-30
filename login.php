<?php
require_once 'define.php';
session_start();

if (isset($_SESSION['userID'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Đăng nhập</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- fav and touch icons -->

</head>

<?php
require_once app_root . '/controller/loginAuthen.php';

if (isset($_POST['LoginAction'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = userCheckLogin($username, $password);
  if ($result) {
    $current_user = mysqli_fetch_assoc($result);
    $_SESSION['userID'] = $current_user['userID'];
    $_SESSION['user_name'] = $current_user['username'];
    header("Location: index.php");
  } else {
    $message = 'Tài khoản không hợp lệ, vui lòng nhập lại';
  }
}
?>

<body>
  <div class="container my-5">
    <div class="login">
      <div class="login-triangle"></div>
      <h2 class="login-header">Đăng nhập</h2>
      <form action="" method="post" class="login-container">
        <?php
        if (isset($message)) {
          echo '<div class="message">' . $message . '</div>';
        }
        ?>
        <p><input type="text" placeholder="Tên đăng nhập" name="username" required></p>
        <p><input type="password" placeholder="Mật khẩu" name="password" required></p>
        <p><input type="submit" name="LoginAction" value="Đăng nhập"></p>
        <p> Chưa có tài khoản? <a href="register.php"> Đăng ký ngay</a></p>
      </form>
    </div>
  </div>

</body>

</html>