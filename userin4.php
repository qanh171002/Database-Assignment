<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Lumia - Multipurpose responsive bootstrap website template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- fav and touch icons -->
 
  <!-- =======================================================
    Theme Name: Lumia
    Theme URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>


<body>
<div class="container-md my-5 px-5">
        <h3>Thông tin tài khoản</h3>
        <div class="container-fluid px-3 bg-light">
            <div class="row">
                <div class="col-md-6 self-info border border-2 border-start-0 border-top-0 border-bottom-0 py-3">
                    <h5>Thông tin cá nhân</h5>
                    <div class="avatar text-center">
                        <?php
                            if($value['image']==''){
                                echo '<img src="../../image/default-avatar.png" class="rounded-circle" width="200px" height="200px">';
                            }else{
                                echo '<img src="../../image/'.$value['image'].'" class="rounded-circle" width="200px" height="200px">';
                            }
                        ?>
                    </div>
                        <form action="../controllers/infoController.php" method="POST" enctype="multipart/form-data">
                            <div class="text-center my-3">
                            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png">
                            </div>
                            <input type="hidden" name="user-id" value=<?=$user_id?>>
                            <!--input class="btn btn-outline-secondary" type="submit" name="change-avt" value="Đổi ảnh đại diện"-->

                            <div class="mb-3 fullName">
                                <label for="" class="input-label">Họ và tên</label>
                                <input type="text" name="change-fullname" id="fullname" value="<?= $value['fullName'] ?>">
                            </div>

                            <div class="mb-3 birthDate">
                                <label for="" class="input-label">Ngày sinh</label>
                                <input type="date" name="change-dob" value="<?=$value['dob']?>"/>
                            </div>
                        
                            <div class="mb-3 address">
                                <label for="" class="input-label">Địa chỉ</label>
                                <input type="text" name="change-address" id="address" value="<?= $value['address'] ?>">
                            </div>
                        
                        <!--p class="card-text">Mã số tài khoản: <,?php echo $value['id'];?></p-->
                            <div class="mb-3 address">
                                <label for="" class="input-label"></label>
                                <button class="btn btn-primary" type="submit" name="change-avt">Lưu thay đổi</button>
                            </div>
                            
                        </form>
                        
                </div>

                <div class="col-md-6 self-contact py-3">
                    <div class="contact mb-3">
                    <h5>Thông tin liên hệ</h5>
                        <ul class="list-group">
                            <li class="phoneli">
                                <form action="../controllers/infoController.php" method="post" enctype="multipart/form-data">
                                <div class="py-1 phone-num ms-4 d-flex">
                                    <div>
                                        <span>Số điện thoại</span> <br>
                                        <input class="form-control-plaintext" type="text" name="phone" value="<?= $value['phone']?>">
                                        <input type="hidden" name="user-id-phone" value="<?=$user_id?>">
                                    </div>
                                    <div class="text-end flex-fill">
                                        <input type="submit" class="btn btn-outline-primary" name="change-phone-user" value="Cập nhật">
                                    </div>
                                </div>
                                <?php 
                                        if(isset($_GET['messagephone'])&&$_GET['messagephone']!=""){
                                        ?>
                                        <span class="text-danger"><?php echo $_GET['messagephone']?></span>
                                        <?php
                                            }       
                                        ?>
                                </form>
                            </li>

                            <li class="emaili">
                            
                                <form action="../controllers/infoController.php" method="post">
                                <div class="py-1 email d-inline-block ms-4 d-flex">
                                    <div>
                                        
                                        <span>Địa chỉ email</span> <br>
                                        <input class="form-control-plaintext" type="text" name="new-email" value="<?= $value['email'] ?>">
                                        <input type="hidden" name="user-id-email" value="<?=$user_id?>">
                                    </div>
                                    <div class="text-end flex-fill">
                                        <button type="submit" class="btn btn-outline-primary" name="change-email-user">Cập nhật</button>
                                    </div>
                                </div>
                                <?php 
                                        if(isset($_GET['message'])&&$_GET['message']!=""){
                                        ?>
                                        <span class="text-danger"><?php echo $_GET['message']?></span>
                                        <?php
                                            }       
                                        ?>
                                </form>
                                
                            </li>
                        </ul>
                    </div>

                    <div class="security mb-3">
                    <h5>Bảo mật</h5>
                        <ul class="list-group">
                            <li class="lockli">
                            <div class="py-2 pwd d-inline-block ms-4 d-flex">
                                <div>
                                    <span>
                                        Thiết lập mật khẩu
                                    </span>
                                    <div class="card card-body collapse" id="collapsepwd">

                                        <?php
                                        if(isset($_POST['submit-change-pass'])){
                                            $id = $_POST['user_id'];
                                            $sql="SELECT * FROM users WHERE id='$id'";
                                            $result= mysqli_query($db->con, $sql);
                                            $value=$result->fetch_assoc();
                                            $new_pass=$_POST['new-pass'];
                                            if($_POST['old-pass']!=$value['password']){
                                                $message="Sai mật khẩu";
                                            }else if($_POST['new-pass']!=$_POST['confirm-pass']){
                                                $message="Mật khẩu xác nhận không khớp";
                                            }else if(strlen($_POST['new-pass'])<6 || strlen($_POST['new-pass'])>15){
                                                $message="Mật khẩu không hợp lệ";
                                            }else{
                                                $sql = "UPDATE users SET password='$new_pass' WHERE id='$id'";
                                                $result= mysqli_query($db->con, $sql);
                                                if($result){
                                                    echo "Change password successfully";
                                                }else{
                                                    echo mysqli_error($db->con);
                                                }
                            
                                            }
                                        }
                                        ?>
                                        <form action="" method="POST" >
                                            <?php
                                                if(isset($message)){
                                                echo "<span class='text-danger'>".$message.'</span>';
                                                }
                                            ?>
                                            <input type="hidden" name="user_id" value="<?=$user_id?>">
                                            <!--input type="hidden" name="change-pass" value="Đổi mật khẩu"-->
                                            <div class="mb-2 old-pwd">
                                                <label for="">Mật khẩu hiện tại :</label>
                                                <input class="form-control" type="password" name="old-pass" placeholder="Mật khẩu hiện tại" required>
                                            </div>

                                            <div class="mb-2 new-pwd">
                                                <label for="">Mật khẩu mới :</label>
                                                <input class="form-control" type="password" name="new-pass" placeholder="Mật khẩu mới" required>
                                            </div>
                                            
                                            <div class="mb-2 confirm-pwd">
                                                <label for="">Nhập lại mật khẩu mới :</label>
                                                <input class="form-control" type="password" name="confirm-pass" placeholder="Nhập lại mật khẩu mới" required>
                                            </div>
                                            <input class="btn btn-primary" type="submit" name="submit-change-pass" value="Xác nhận">
                                        </form>
                                    </div> 
                                </div>
                                <div class="text-end flex-fill">
                                        <a href="#collapsepwd" class="btn border border-2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapsepwd">Đổi mật khẩu</a>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>

                    <div class="role">
                    <h5>Tư cách</h5>
                        <ul class="list-group">
                            <li class="roleli">
                                <form action="">
                                <div class="py-1 rol d-inline-block ms-4 d-flex">
                                    <div>
                                    <select name="roleId" id="roleID" class="form-control-plaintext">
				                        <?php
                                            if($value['roleId']== 1 ) {
                                        ?>
                                            <option value="1" selected>Quản trị viên</option>
                                            <option value="2">Khách hàng</option>
                                        <?php } else {
                                        ?>
                                            <option value="1">Quản trị viên</option>
                                            <option value="2" selected>Khách hàng</option>
                                        <?php } ?>
			                        </select>
                                    </div>
                                    <div class="text-end flex-fill">
                                        <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
                                    </div>
                                </div>
                                </form>
                            
                            </li>
                        </ul>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
                
               
            </div>
        </div>
        </div>

</body>
</html>