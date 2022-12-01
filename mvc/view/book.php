<?php
require_once app_root . '/model/curriculum.php';
$curri = new Curriculum();
$result = $curri->getAll();
if ($result) {
?>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover mb-5">
                <thead class=" text-center align-middle">
                    <tr>
                        <th class="text-start">
                            Book
                        </th>
                        <th>Name</th>
                        <th> Author </th>
                        <th> Price </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="  text-center align-middle ">
                    <?php
                    while ($value = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <!-- The product html template -->
                            <td>

                                <img src="<?php echo web_root . "/book/" . $value['image'] ?>" alt="..." height="150px" width="150px">

                            </td>
                            <td class="h4"><?php echo $value['curriName'] ?></td>
                            <td><?php echo $value['author'] ?></td>
                            <td><?php echo $value['cost'] ?></i></a></td>
                            <td><a href="" target="_blank" class="btn btn-primary">Buy</a></td>
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