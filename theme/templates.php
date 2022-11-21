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
  <link rel="shortcut icon" href="assets/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo web_root;?>plugins/homepage/assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo web_root;?>plugins/homepage/assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo web_root;?>plugins/homepage/assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="<?php echo web_root;?>plugins/homepage/assets/ico/apple-touch-icon-57-precomposed.png">

  <!-- =======================================================
    Theme Name: Lumia
    Theme URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>


<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
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
        <a class="nav-link" href="<?php echo web_root; ?>index.php?q=exercises">Exercises</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo web_root; ?>index.php?q=download">Download</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>

    <section id="maincontent">
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