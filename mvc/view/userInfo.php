<?php
if (!isset($_SESSION['userID'])) header('Location: login.php');
require_once app_root . '/model/user.php';
$me = new User();
$result = $me->getMemById($_SESSION['userID']);
$value = $result->fetch_assoc();
?>
<form action="" method="POST">
    <div class="container-fluid rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings (student)</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="Full name" value="<?= $value['fullName'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Birthday</label><input type="date" class="form-control" placeholder="Birthday" value="<?= $value['dob'] ?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="<?= $value['phoneNum'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address line 1" value="<?= $value['address'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter email id" value="<?= $value['email'] ?>"></div>


                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                    </div>
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
                        <div class="d-flex justify-content-between align-items-center experience"><span>Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                        <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" value=""></div> <br>
                        <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>