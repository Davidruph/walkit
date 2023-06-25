<?php
//All header tag to be included
include('include/header.php');
?>

<?php

//db connection
include("../dbconn.php");
//fetch
$id = $_SESSION['user'];
$sql = mysqli_query($conn, "SELECT * FROM data_accumulator WHERE company_user_id=$id");

?>

<?php
//sidebar tag to be included
include('include/sidebar.php');
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">User rows</li>
        </ol>

        <div class="col-md-12">
            <div class="demo-box m-t-20">

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-dark" id="dataTable">
                        <thead>
                            <tr>
                                <th>s/n</th>
                                <th>Home Address</th>
                                <th>Km saved</th>
                                <th>IP</th>
                                <th>Device</th>
                                <th>OS</th>
                                <th>Browser</th>
                                <th>date/time</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (mysqli_num_rows($sql) > 0) {
                                $counter = 0;
                                while ($row = mysqli_fetch_assoc($sql)) {
                            ?>

                                    <tr>
                                        <td><?php echo ++$counter; ?></td>
                                        <td><?php echo $row['user_home_address']; ?></td>
                                        <td><?php echo $row['km_saved']; ?></td>
                                        <td><?php echo $row['ip']; ?></td>
                                        <td><?php echo $row['device']; ?></td>
                                        <td><?php echo $row['os']; ?></td>
                                        <td><?php echo $row['browser']; ?></td>
                                        <td><?php echo $row['submitted_on']; ?></td>

                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No Record Found";
                            }

                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>


    </div>
</main>

<?php
//footer tag to be included
include('include/footer.php');
?>

<?php
//javascripts files to be included
include('include/scripts.php');
?>