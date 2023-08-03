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
                    <label>Today I packed my lunch</label>
                    <br>
                    <select class="form-control w-50 food" required name="food[]" multiple="multiple">
                        <option value="">-- select option --</option>
                        <option value="home made food in a reusable container">home made food in a reusable container</option>
                        <option value="Leftovers from a restaurant">Leftovers from a restaurant</option>
                        <option value="packaged food">packaged food</option>
                        <option value="packaged side dish">packaged side dish</option>
                        <option value="I didn't pack anything, I'm going out for lunch">I didn't pack anything, I'm going out for lunch</option>
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
        $('.food').select2();
    });
</script>
<script>
    function calcPack() {
        var foodTable = {
            "home made food in a reusable container": 10,
            "Leftovers from a restaurant": 15,
            "packaged food": 20,
            "packaged side dish": 25,
            "I didn't pack anything, I'm going out for lunch": 30,
        };

        var foodSelect = document.querySelector('.food');
        var selectedOptions = Array.from(foodSelect.selectedOptions);

        var total = 0;
        var selectedOptionsList = [];

        selectedOptions.forEach(function(option) {
            var value = foodTable[option.value];
            total += value;
            selectedOptionsList.push(option.value);
        });

        console.log(total); // Logs the total to the console
        console.log(selectedOptionsList); // Logs the selected options to the console

        toastr.success('Hello, this is a toaster message!');
        toastr.options.closeButton = true;
    }
</script>