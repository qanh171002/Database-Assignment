<?php
require_once(app_root . '/model/course.php');
if (isset($_SESSION['userID'])) {
    $myCourse = new Course();

?>
    <h1>My Course</h1>
    <div class="container my-5">
        <?php
        if ($_SESSION['userRole'] == 'S') {
            $result = $myCourse->getCourseOfStudent($_SESSION['userID']);
        ?>
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
                                        <img src="<?php echo asset . "/course_image/" . $data['image'] ?>" class="card-img-top" alt="...">
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
        } else { ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse"><span><i class="fa fa-plus"></i>&nbsp;Add Course</span></button>
            <div class="mb-3"></div>
            <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCourseLabel">New Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="mb-3 form-floating">

                                    <input type="text" class="form-control" id="course-id" name="course-id" placeholder="">
                                    <label for="course-id" class="form-label">Course ID</label>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" id="course-name" name="course-name" placeholder="">
                                    <label for="course-name" class="form-label">Course Name</label>

                                </div>
                                <div class="mb-3 form-floating">
                                    <textarea class="form-control" id="desc" style="height: 100px" name="desc" placeholder=""></textarea>
                                    <label for="desc" class="form-label">Description</label>

                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="number" class="form-control" id="fee" name="fee" placeholder="">
                                    <label for="fee" class="form-label">Fee</label>

                                </div>
                                <div class="mb-3 ">
                                    <label for="course-image" class="form-label">Image</label>

                                    <input class="form-control" type="file" name="course-image" id="course-image" accept="image/jpg, image/jpeg, image/png">


                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 g-4">
                <?php
                if (isset($_POST['course-id'])) {
                    $courseID = $_POST['course-id'];
                    $courseName = $_POST['course-name'];
                    $des = $_POST['desc'];
                    $fee = $_POST['fee'];


                    $image = $_FILES['course-image']['name'];
                    //echo $image;
                    $image_tmp_name = $_FILES['course-image']['tmp_name'];
                    //echo $image_tmp_name;
                    $image_folder = site_root . '/asset/course_image/' . $image;
                    //echo $image_folder;

                    $userid = $_SESSION['userID'];
                    $myCourse->createCourse($courseID, $userid, $courseName, $des, $fee, $image);
                    move_uploaded_file($image_tmp_name, $image_folder);

                ?>
                    <script>
                        alert("Success");
                    </script>
                    <?php

                }
                $result = $myCourse->getCourseOfTeacher($_SESSION['userID']);
                if ($result) {
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <!-- The product element -->
                        <div class="col">
                            <div class="card h-100 text-center">
                                <!-- The products image -->

                                <div class="zoom">
                                    <img src="<?php echo asset . "/course_image/" . $data['image'] ?>" class="card-img-top" alt="...">
                                </div>

                                <!-- The products name -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['courseName'] ?></h5>
                                    <p class="card-text"><?php echo $data['description'] ?></p>
                                    <a href="index.php?q=mycourse&courseID=<?= $data['courseID'] ?>" class="btn btn-primary stretched-link">Edit Course</a>
                                </div>
                            </div>
                        </div> <!-- End of product element -->
                <?php
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>

    </div>
<?php
} ?>