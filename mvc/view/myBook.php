<?php
require_once app_root . '/model/curriculum.php';
$curri = new Curriculum();
$result = $curri->getBookOfUser($_SESSION['userID']);
if ($result) {
?>
    <div class="container-fluid">
        <h3 class="mb-3">My Book</h3>
        <div class="table-responsive">
            <table class="table table-hover mb-5">
                <thead class=" text-center align-middle">
                    <tr>
                        <th class="text-start">
                            Book
                        </th>
                        <th>Name</th>
                        <th> Author </th>
                        <th> Publisher </th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody class="  text-center align-middle ">
                    <?php
                    while ($value = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <!-- The product html template -->
                            <td>

                                <img src="<?php echo asset . "/book/" . $value['image'] ?>" alt="..." height="150px" width="150px">

                            </td>
                            <td class="h4"><?php echo $value['curriName'] ?></td>
                            <td><?php echo $value['author'] ?></td>
                            <td><?php echo $value['publisher'] ?></i></a></td>
                            <td><?php echo $value['publishYear'] ?></i></a></td>
                        </tr>

                    <?php
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <!--end table-->
    </div>

<?php
}
?>