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
                <div class="form-group">
                    <label>Are you a Plant Based Eater, including Vegetarian or Vegan?</label>
                    <br>
                    <select class="form-control w-50 eating_options" required name="eating_options">
                        <option value="">-- select option --</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group plant">
                    <label>Today I packed my lunch</label>
                    <br>
                    <select class="form-control w-50 food" required name="food[]">
                        <option value="">-- select option --</option>
                        <option value="food delivery">Food Delivery</option>
                        <option value="home made food in a reusable container">home made food in a reusable container</option>
                        <option value="Leftovers from a restaurant">Leftovers from a restaurant</option>
                        <option value="Lunch at a restaurant">Lunch at a restaurant</option>
                        <option value="Lunch at cafeteria">Lunch at cafeteria</option>
                        <option value="Meal kit">Meal kit</option>
                        <option value="packaged food">packaged food</option>
                        <option value="packaged side dish">packaged side dish</option>
                    </select>
                </div>

                <div class="form-group meat">
                    <label>Today I packed my lunch</label>
                    <br>
                    <select class="form-control w-50 food" required name="food[]">
                        <option value="">-- select option --</option>
                        <option value="food delivery">Food Delivery</option>
                        <option value="home made food in a reusable container">home made food in a reusable container</option>
                        <option value="Leftovers from a restaurant">Leftovers from a restaurant</option>
                        <option value="Lunch at a restaurant">Lunch at a restaurant</option>
                        <option value="Lunch at cafeteria">Lunch at cafeteria</option>
                        <option value="Meal kit">Meal kit</option>
                        <option value="packaged food">packaged food</option>
                        <option value="packaged side dish">packaged side dish</option>
                    </select>
                </div>

                <div class="form-group">
                    <button name="submit_packit_data" class="btn w-50 text-white" onclick="calcPack();">Submit</button>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.plant').hide();
        $('.meat').hide();
        // $('.food').select2();
        // $('.eating_options').select2();
        $('.eating_options').change(function() {
            // If "yes" is selected, show the plant div and hide the meat div
            if (this.value == 'yes') {
                $('.plant').show();
                $('.meat').hide();
            }
            // If "no" is selected, show the meat div and hide the plant div
            else if (this.value == 'no') {
                $('.meat').show();
                $('.plant').hide();
            }
            // If neither "yes" nor "no" is selected, hide both divs
            else {
                $('.plant').hide();
                $('.meat').hide();
            }
        });
    });
</script>
<script>
    function calcPack() {
        var userId = <?php echo $id; ?>;
        var foodTablePlant = {
            "food delivery": 2.35,
            "home made food in a reusable container": 1.6,
            "Leftovers from a restaurant": 1.75,
            "Lunch at a restaurant": 1.925,
            "Lunch at cafeteria": 2.025,
            "Meal kit": 2.5,
            "packaged food": 2.35,
            "packaged side dish": 1,
        };

        var foodTableMeat = {
            "food delivery": 7.75,
            "home made food in a reusable container": 7.075,
            "Leftovers from a restaurant": 9.03,
            "Lunch at a restaurant": 7.325,
            "Lunch at cafeteria": 7.125,
            "Meal kit": 6.2,
            "packaged food": 6.55,
            "packaged side dish": 3.95,
        };

        var eatingOption = document.querySelector(".eating_options").value;
        var foodSelect;

        if (eatingOption === "yes") {
            foodSelect = document.querySelector(".plant .food");
        } else if (eatingOption === "no") {
            foodSelect = document.querySelector(".meat .food");
        } else {
            toastr.error("Please select an eating option.");
            return;
        }

        var selectedOptionValue = foodSelect.value;
        var foodTable = eatingOption === "yes" ? foodTablePlant : foodTableMeat;

        var value = foodTable[selectedOptionValue];

        if (selectedOptionValue === "") {
            toastr.error("Please select a food option.");
            return;
        } else if (value === undefined) {
            toastr.error("Invalid food selection.");
            return;
        }

        console.log(value); // Logs the total to the console
        console.log(selectedOptionValue); // Logs the selectedOptionValue to the console

        $.ajax({
            url: "save_food_data.php",
            method: "POST",
            data: {
                total: value,
                selectedOptions: selectedOptionValue,
                user_id: userId,
            },
            success: function(response) {
                if (response == "success") {
                    toastr.success("Data saved successfully.");
                }
            },
            error: function(error) {
                console.error(error);
            },
        });
    }
</script>