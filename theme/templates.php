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
<div class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid ">
    <ul class="navbar-nav me-auto" >
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
     <li class="nav-item">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo web_root; ?>index.php?q=lesson">Lesson</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="<?php echo web_root; ?>index.php?q=exercises">Exercises</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo web_root; ?>index.php?q=download">Download</a>
      </li>
      
    </ul>

    <ul class="navbar-nav" >
      
      <li class="nav-item  dropdown" >
        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">User</a>
        <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="userin4.php">User infor</a></li>
    <li><a class="dropdown-item" href="#">My course</a></li>
    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
  </ul>
      </li>
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">User</a>
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
    </ul>  
  </div>
</div>
<<<<<<< HEAD
    <section id="maincontent" style="margin-top:80px">
=======

    <section id="maincontent">
>>>>>>> anh
      <div class="container"> 
<?php check_message(); ?>  
    <?php require_once $content; ?> 
  </div>   
</section>
 <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/raphael-min.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/bootstrap.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/google-code-prettify/prettify.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery.elastislide.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery.prettyPhoto.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery.flexslider.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/jquery-hover-effect.js"></script>
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/animate.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="<?php echo web_root;?>plugins/homepage/assets/js/custom.js"></script>
</body>
</html>