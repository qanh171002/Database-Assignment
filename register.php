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
        $message = "Invalid Email";
    } else if (!$checkEmail) {
        //header("Location: ../views/regist.php");
        $message = 'User already existed';
    } else if (!preg_match("/^0([0-9]){9}$/", $phone)) {
        $message = "Invalid phone number";
    } else if (strlen($password) < 6 || strlen($password) > 15) {
        $message = "Invalid password";
    } else {
        $result = insert($fullName, $gender, $email, $dob, $address, $username, $password, $phone, $role);
        if ($result) {
            //move_uploaded_file($image_tmp_name, $image_folder);
            $message = "Successful Registration";
        } else {
            $message = "Registration Failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/qanh.css">
    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fav and touch icons -->

</head>


<body>
<section>
<form action="" method="post" class="login-container" enctype="multipart/form-data">
                <?php
                if (isset($message)) {
                    echo '<div class="message">' . $message . '</div>';
                }
                ?>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-5">
                  <h3 class="fw-normal mb-5" style="color: #000;">Account Infomations</h3>

                  <div class="row">
                    <div class="mb-4 pb-2">

                      <div class="form-floating mb-3 mt-3">
                        <input type="email" id="form3Examplev2`" name="email" class="form-control form-control-lg" required />
                        <label class="form-label" for="form3Examplev2">Email</label>
                      </div>

                  <div class="mb-4 pb-2">
                    <div class="form-floating mb-3 mt-3">
                      <input type="text" id="form3Examplev4" name="username" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplev4">Username</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="mb-4 pb-2">

                      <div class="form-floating mb-3">
                        <input type="password" id="form3Examplev5" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev5">Password</label>
                      </div>
                    </div>
                    
                    <div class="mb-4 pb-2">
                    <div class="form-floating mb-3">
                      <input type="password" id="form3Examplev4" name="repassword" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplev4">Re-enter password</label>
                    </div>
                  </div>
                   
                  <div class="col-md-6">
                    <label for="role">You are: </label>
                      <select class="select" name="role">
                        <option value="S">Student</option>
                        <option value="T">Teacher   </option>
                      </select>

                    </div>
                  </div>

                </div>
              </div>
              
              </div>
                    <div class="col-md-6 mb-4 pb-2">
                    </div>
                  </div>
              <div class="col-lg-6 bg-indigo text-dark">
                <div class="p-5">
                  <h3 class="fw-normal mb-5">Contact Details</h3>

                  <div class="mb-4 pb-2">
                    <div class="form-floating mb-3">
                      <input type="text" id="form3Examplea2" name="fullName" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Full name</label>
                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                  <label class="form-label" for="form3Examplev2">Gender :</label>
                    <select class="select" name="gender">
                      <option value="F">Female</option>
                      <option value="M">Male</option>
                    </select>
                  </div>

                  <div class="mb-4 pb-2">
                    <div class="form-floating mb-3">
                      <input type="tel" id="form3Examplea2" name="phone" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Phone number</label>
                    </div>
                  </div>
                   
                  <div class="mb-4 pb-2">
                    <div class="form-floating mb-3">
                      <input type="text" id="form3Examplea2" name="address" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Address</label>
                    </div>  
                  </div>

                  <div class="mb-4 pb-2">
                    <div class="form-floating mb-3">
                      <input type="date" id="form3Examplea2" name="dob" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Date of birth</label>
                    </div>
                  </div>

                  <p><input type="submit" name="RegisterAction" value="Register"></p>
                <p> Already have an account? <a href="login.php"> Login now</a></p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
</section>

</body>

</html>