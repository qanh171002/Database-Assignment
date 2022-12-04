<?php
require_once app_root . '/model/course.php';
$course = new Course();
$result = $course->getById($_GET['courseID']);
if ($result) {
    while ($data = $result->fetch_assoc()) {
?>
        <div class="container-fluid">
            <div id="heading">
                <h2><?= $data['courseName'] ?></h2>

                <p><?= $data['description'] ?></p>

            </div>
            <?php
            if (isset($_POST['lesson-name'])) {
                $courseID = $data['courseID'];
                $lessonName = $_POST['lesson-name'];
                $duration = $_POST['duration'];

                $content = $_FILES['content']['name'];
                $content_tmp = $_FILES['content']['tmp_name'];
                $content_upload = site_root . '/asset/lesson/' . $content;


                $exercise = $_FILES['exercise']['name'];
                $exercise_tmp = $_FILES['exercise']['tmp_name'];
                $exercise_upload = site_root . '/asset/exercise/' . $exercise;

                $course->addLesson($courseID, $lessonName, $duration, $content, $exercise);
                move_uploaded_file($content_tmp, $content_upload);
                move_uploaded_file($exercise_tmp, $exercise_upload);
            ?>
                <script>
                    alert("Success");
                </script>
            <?php

            }
            ?>
            <div id="lesson-field">

                <div class="table-responsive">
                    <table class="table table-hover mb-5">
                        <thead class=" text-center align-middle">
                            <tr>
                                <th colspan="2" class="text-start">
                                    <h3>Lessons</h3>
                                </th>
                                <th> Duration </th>
                                <th> Exercise </th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="  text-center align-middle ">

                            <?php
                            //print_r($_SESSION['cart']);
                            $lessonList = $course->getLesson($_GET['courseID']);
                            if ($lessonList) {
                                while ($value = $lessonList->fetch_assoc()) {
                            ?>

                                    <tr style="transform: rotate(0);">
                                        <!-- The product html template -->

                                        <td><?= $value['no'] ?></td>
                                        <td><?php echo $value['lessonName'] ?></td>
                                        <td><?php echo $value['duration'] ?> mins</td>
                                        <td><a href=" <?php echo  asset . '/exercise/' . $value['exercise'] ?>" target="_blank"><i class="fa-solid fa-code"></i></a></td>
                                        <td><a href="<?php echo  asset . '/lesson/' . $value['lessonSrc'] ?>" target="_blank" class="btn btn-primary">View Lesson</a></td>


                                    </tr>

                            <?php
                                }
                            }
                            ?>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse"><span><i class="fa fa-plus"></i>&nbsp;Add Lesson</span></button>
                                <div class="mb-3"></div>
                                <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addLessonLabel">New Leson</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3 form-floating">
                                                        <input type="text" class="form-control" id="lesson-name" name="lesson-name" placeholder="">
                                                        <label for="lesson-name" class="form-label">Lesson Name</label>

                                                    </div>

                                                    <div class="mb-3 form-floating">
                                                        <input type="number" class="form-control" id="duration" name="duration" placeholder="">
                                                        <label for="duration" class="form-label">Time</label>

                                                    </div>

                                                    <div class="mb-3 ">
                                                        <label for="content" class="form-label">Content</label>
                                                        <input class="form-control" type="file" name="content" id="content" accept="application/pdf">
                                                    </div>

                                                    <div class="mb-3 ">
                                                        <label for="exercise" class="form-label">Exercise</label>
                                                        <input class="form-control" type="file" name="exercise" id="exercise" accept="application/pdf">
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
                            </div>
                        </tbody>
                    </table>
                </div>
                <!--end table-->
            </div>
        </div>
<?php
    }
}
?>