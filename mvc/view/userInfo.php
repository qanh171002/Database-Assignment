<?php
if (!isset($_SESSION['userID'])) header('Location: login.php');
require_once app_root . '/model/user.php';
$me = new User();
if (isset($_POST['full-name'])) {
    $fullName = $_POST['full-name'];
    $address = $_POST['address'];
    $bdate = $_POST['bdate'];
    $phoneNum = $_POST['pnum'];
    $me->updateUserInfo($_SESSION['userID'], $fullName, $address, $bdate, $phoneNum);
?>
    <script>
        alert('Success');
    </script>
<?php
    sleep(2);
    header("Location: index.php?q=info");
}
$result = $me->getMemById($_SESSION['userID']);
$value = $result->fetch_assoc();
?>

<div class="container-fluid rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?= $value['fullName'] ?></span><span class="text-black-50"><?= $value['username'] ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="" method="post">
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Full Name</label><input type="text" name="full-name" class="form-control" placeholder="Full name" value="<?= $value['fullName'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Birthday</label><input type="date" name="bdate" class="form-control" placeholder="Birthday" value="<?= $value['dob'] ?>"></div>
                        <div class="col-md-12 py-2"><label>Gender: <?php echo ($value['gender'] == 'M') ? "Male" : "Female" ?></label></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" name="pnum" class="form-control" placeholder="enter phone number" value="<?= $value['phoneNum'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Address</label><input type="text" name="address" class="form-control" placeholder="enter address line 1" value="<?= $value['address'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="enter email id" value="<?= $value['email'] ?>" disabled></div>


                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-md-4">
            <?php
            if ($value['userRole'] == 'S') {
            ?>
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Education</span></div><br>
                    <div class="col-md-12">
                        <span>Primary</span><br>
                        <?php
                        $result = $me->getPrimary($_SESSION['userID']);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <input type="text" class="form-control" value="<?php echo $data['inst'] ?>"><label>Institution</label>
                        <?php } ?>
                    </div> <br>
                    <div class="col-md-12">
                        <span>Secondary</span><br>
                        <?php
                        $result = $me->getSecondary($_SESSION['userID']);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <input type="text" class="form-control" value="<?php echo $data['inst'] ?>"><label>Institution</label>
                        <?php } ?>
                    </div> <br>
                    <div class="col-md-12">
                        <span>High School</span><br>
                        <?php
                        $result = $me->getHigh($_SESSION['userID']);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <input type="text" class="form-control" value="<?php echo $data['inst'] ?>"><label>Institution</label>
                        <?php } ?>
                    </div> <br>
                    <div class="col-md-12">
                        <span>University</span><br>
                        <?php
                        $result = $me->getUniversity($_SESSION['userID']);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <input type="text" class="form-control" value="<?php echo $data['inst'] ?>"><label>Institution</label>
                            <input type="text" class="form-control" value="<?php echo $data['spec'] ?>"><label>Specialization</label>
                        <?php } ?>
                    </div> <br>
                </div>
            <?php } else { ?>
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Degree</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Degree</span></div>
                    <div class="mb-2"></div>
                    <?php
                    $result = $me->getDegree($_SESSION['userID']);
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <div class="row">
                            <div class="col-md-3 form-floating px-1"><input type="text" class="form-control" placeholder="additional details" id="degree-rank" value="<?php echo $data['acaRank'] ?>"><label for="degree-rank">&nbsp;Rank</label></div>
                            <div class="col-md-9 form-floating px-1"><input type="text" class="form-control" placeholder="additional details" id="degree-spec" value="<?php echo $data['specialization'] ?>"><label for="degree-spec">&nbsp;Specialization</label></div>
                        </div>
                    <?php } ?>
                </div>

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div>
                    <div class="mb-2"></div>
                    <?php
                    $result = $me->getExperience($_SESSION['userID']);
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <div class="row">
                            <div class="col-md-10 form-floating px-1"><input type="text" class="form-control" placeholder="additional details" id="exp-inst" value="<?php echo $data['place'] ?>"><label for="exp-inst">&nbsp;Institution</label></div>
                            <div class="col-md-2 form-floating px-1"><input type="text" class="form-control" placeholder="additional details" id="exp-time" value="<?php echo $data['numYears'] ?>"><label for="exp-time">&nbsp;Time</label></div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>