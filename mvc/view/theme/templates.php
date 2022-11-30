<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- fav and touch icons -->

</head>

<body>
  <div class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid ">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Yes Learning</a>
        </li>
        <li class="nav-item">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?q=lesson">Lesson</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="index.php?q=exercises">Exercises</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?q=download">Download</a>
        </li>

      </ul>


      <ul class="navbar-nav">

        <?php
        if (isset($_SESSION['userID'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?= $_SESSION['user_name'] ?></a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">My Information</a>
              </li>
              <li><a class="dropdown-item" href="#">My profile</a>
              </li>
              <li><a class="dropdown-item" href="#">My course</a>
              </li>
              <li><a class="dropdown-item" href="logout.php">Log out</a>
              </li>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Đăng ký</a>
          </li>
        <?php  }
        ?>


      </ul>
    </div>
  </div>
  <section id="maincontent">
    <div class="container">

      <?php require_once $content; ?>
    </div>
  </section>

</body>

</html>