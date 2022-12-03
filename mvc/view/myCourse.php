<?php
require_once(app_root . '/model/course.php');
if (isset($_SESSION['userID'])) {
    $myCourse = new Course();

?>
    <h1>My Course</h1>
    <div class="container my-5">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            <?php
            if ($_SESSION['userRole'] == 'S') {
                $result = $myCourse->getCourseOfStudent($_SESSION['userID']);
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
            } else {
                $result = $myCourse->getCourseOfTeacher($_SESSION['userID']);
                if ($result) {
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <!-- The product element -->
                        <div class="col">
                            <div class="card h-100 text-center">
                                <!-- The products image -->
                                <a href="index.php?q=mycourse&courseID=<?= $data['courseID'] ?>">
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse"><span><i class="fa fa-plus"></i>&nbsp;Add Course</span></button>

                <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCourseLabel">New message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                        <input type="text" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
} ?>