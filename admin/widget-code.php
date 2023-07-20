<?php session_start();
$id = $_SESSION['user'];
echo '<script>var ID="' . $id . '";</script>'; ?>

<div class="wrapper" style="border: 1px solid grey;box-shadow: 1px;justify-content: center;align-items: center;width: 20%;background-color:#bfcec2;">
    <div class="box" style="padding: 5px;">
        <h1 class="widget-total" style="text-align:center;font-size:60px;font-weight:bolder;margin-bottom:0px;">2333</h1>
        <h4 class="widget-text" style="text-align:center;font-size:17px;font-weight:bold;margin-top:10px;">KG CO2e Saved</h4>
        <h4 class="widget-text" style="text-align:center;font-size:17px;">Active Transit users have saved<br><span class="widget-total">2334</span> KG CO2e travelling to our<br>facility this month</h4>
        <h3 class="logo" style="color:#003b49;text-align:right;margin-right:10px;font-weight:bold;">ECO<span style="color:#698020;">DEMY</span></h3>
    </div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/walkit/admin/widget.php?ID=" + encodeURIComponent(ID), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var total = xhr.responseText;
                var totalElements = document.querySelectorAll(".widget-total");
                totalElements.forEach(function(element) {
                    element.textContent = total;
                });
            }
        };
        xhr.send();
    });
</script>