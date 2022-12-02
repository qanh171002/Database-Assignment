<?php

require_once app_root . '/model/course.php';
?>

<div class="container-fluid">
    <div id="thecarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="4"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://img.freepik.com/free-vector/kindergarten-school-scene-with-two-children-playing-toys-room_1308-61743.jpg?t=st=1655493033~exp=1655493633~hmac=855248686d9e7b0cd04b5c24413d1a1adb442dd3fded21b1a4653b3ef936dd40&w=996" alt="First slide" class="d-block w-100" height="500px">
            </div>
            <div class="carousel-item">
                <img src="https://putatu.com/storage/campaign/f774561620f3dcf730d66fffd820d278.png" alt="Second slide" class="d-block w-100" height="500px">
            </div>
            <div class="carousel-item">
                <img src="https://i.pinimg.com/originals/60/37/ed/6037ed9add0170c6d368caa182dd7b22.png" alt="Third slide" class="d-block w-100" height="500px">
            </div>
            <div class="carousel-item">
                <img src="https://i.pinimg.com/originals/7f/1f/bb/7f1fbbdf63ab5b49e50dc0de5441fab7.png" alt="Third slide" class="d-block w-100" height="500px">
            </div>
            <div class="carousel-item">
                <img src="https://u6wdnj9wggobj.vcdn.cloud/media/mgs_blog/s/i/sinh-nhat-mykingdom-1004.jpg" alt="Third slide" class="d-block w-100" height="500px">
            </div>
        </div>

        <button type="button" class="carousel-control-prev" data-bs-target="#thecarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button type="button" class="carousel-control-next" data-bs-target="#thecarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>



    <!-- product card grid-->
    <div class="container my-5">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            <?php
            // Fetching the products from the JSON file 
            $courseList = new Course();


            // Look for a GET variable page if not found default is 1.        
            // if (isset($_GET["page"])) {
            //     $page  = $_GET["page"];
            // } else {
            //     $page = 1;
            // }
            // if (isset($_GET['search-submit'])) {
            //     $key = $_GET['search-key'];
            //     $result = $prod->getPageandSearch($page, $key);
            //     if ($result && mysqli_num_rows($result) > 0) {
            //     } else {
            //         echo "<div class='message'>Không tồn tại sản phẩm tìm kiếm</div>";
            //     }
            // } 

            $result = $courseList->getAll();

            if ($result) {
                while ($data = $result->fetch_assoc()) {
            ?>
                    <!-- The product element -->
                    <div class="col">
                        <div class="card h-100 text-center">
                            <!-- The products image -->
                            <a href="index.php?q=course&courseID=<?= $data['courseID'] ?>">
                                <div class="zoom">
                                    <img src="<?php echo asset . "/course_image/" . $data['image'] ?>" class="card-img-top" alt="...">
                                </div>
                            </a>
                            <!-- The products name -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['courseName'] ?></h5>
                                <!--p class="name"><,?php echo $data['name'] ?></p-->
                                <!-- The products price formatted with two decimals  -->
                                <p class="card-text text-danger"><?php echo number_format($data['fee']) ?> USD</p>
                                <!--p class="price">$<,?php echo number_format($data['originalPrice'], 2) ?></p-->
                                <!-- The add cart button -->
                                <?php
                                // if (!isset($_SESSION['user_id'])) {
                                //     $url = "../controllers/script.php?store-product-id=" . $data['id'];
                                // } else {
                                //     $url = "../controllers/script.php?store-product-id-user=" . $data['id'];
                                // }
                                //echo $_SERVER;
                                ?>
                                <form action="<?= web_root . '/mvc/controller/attend.php' ?>" method="post">
                                    <input type="hidden" name="courseID" value="<?= $data['courseID'] ?>">
                                    <button type="submit" class="btn btn-dark">Đăng ký ngay</button>
                                </form>

                            </div>
                        </div>
                    </div> <!-- End of product element -->
            <?php
                }
            }
            ?>
        </div> <!-- End of products -->

        <!-- <nav aria-label="Page navigation" class="my-3 text-dark">
            <ul class="pagination justify-content-center">
                <?php
                // if (isset($_GET['cateid'])) {
                //     $result = $prod->getByCateid($_GET['cateid']);
                // } else if (isset($_GET['search-submit'])) {
                //     $key = $_GET['search-key'];
                //     $result = $prod->searchKey($key);
                // } else {
                // $result = $courseList->getAll();
                // //}
                // $total_records = mysqli_num_rows($result);

                // $per_page_record = 6;
                // $total_pages = ceil($total_records / $per_page_record);
                // $pagLink = "";
                // if ($page >= 2) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="home.php?page="><i class="fa-solid fa-chevron-left"></i></a>
                </li>

                <?php
                // }
                // for ($i = 1; $i <= $total_pages; $i++) {
                //     if ($i == $page) {
                //         $pagLink .= "<li class='page-item active'><a class = 'page-link' href='home.php?page="
                //             . $i . "'>" . $i . " </a></li>";
                //     } else {
                //         $pagLink .= "<li class='page-item'><a class = 'page-link' href='home.php?page="
                //             . $i . "'>" . $i . " </a></li>";
                //     }
                // };
                // echo $pagLink;

                // if ($page < $total_pages) {
                ?>
                <li class="page-item">
                    <a class="page-link" href='index.php?q=course&page='><i class="fa-solid fa-chevron-right"></i></a>
                </li>
                <?php //} 
                ?>
            </ul>
        </nav> -->
    </div>
</div>
<!-- Carousel-->