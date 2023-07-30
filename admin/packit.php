<?php
require 'functions/dbconn.php';
?>
<?php
//All header tag to be included
include('include/header.php');
?>

<?php
//sidebar tag to be included
include('include/sidebar.php');
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">PackIt</li>
        </ol>

        <div class="row mb-4">
            <div class="col-md-12">
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Today I packed my lunch</label>
                        <select class="form-control w-50" name="" required>
                            <option value="">-- select option --</option>
                            <option value="home made food in a reusable container">home made food in a reusable container</option>
                            <option value="Leftovers from a restaurant">Leftovers from a restaurant</option>
                            <option value="packaged food">packaged food</option>
                            <option value="packaged side dish">packaged side dish</option>
                            <option value="I didn't pack anything, I'm going out for lunch">I didn't pack anything, I'm going out for lunch</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit_packit_data" class="btn w-50">Submit</button>
                    </div>
                </form>
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