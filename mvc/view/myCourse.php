<?php
require_once(app_root . '/model/course.php');
if (isset($_SESSION['userID'])) {
    $myCourse = new Course();
    $result = $myCourse->getCourseOfUser($_SESSION['userID']);
?>
    <h1>My Course</h1>
    <div class="container my-5">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            <?php

            if ($result) {
                while ($data = $result->fetch_assoc()) {
            ?>
                    <!-- The product element -->
                    <div class="col">
                        <div class="card h-100 text-center">
                            <!-- The products image -->
                            <a href="index.php?q=course&courseID=<?= $data['courseID'] ?>">
                                <div class="zoom">
                                    <img src="<?php echo "../../image/" . $data['image'] ?>" class="card-img-top" alt="...">
                                </div>
                            </a>
                            <!-- The products name -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['courseName'] ?></h5>

                            </div>
                        </div>
                    </div> <!-- End of product element -->
            <?php
                }
            }
            ?>
        </div>
    <?php
} ?>