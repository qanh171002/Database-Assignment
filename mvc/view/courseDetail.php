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
                <?php
                if (isset($_SESSION['userID'])) {


                ?>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                <?php } ?>
            </div>

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

                                    <tr>
                                        <!-- The product html template -->
                                        <td><?= $value['no'] ?></td>
                                        <td><?php echo $value['lessonName'] ?></td>
                                        <td><?php echo $value['duration'] ?> mins</td>
                                        <td><a href="<?php echo  asset . '/exercise/' . $value['exercise'] ?>" target="_blank"><i class="fa-solid fa-code"></i></a></td>
                                        <td><a href="<?php echo  asset . '/lesson/' . $value['lessonSrc'] ?>" target="_blank" class="btn btn-primary stretched-link">View Lesson</a></td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
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