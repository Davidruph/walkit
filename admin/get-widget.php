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
            <li class="breadcrumb-item active">Widget Code</li>
        </ol>
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <textarea id=" widget-code" rows="10" cols="100" readonly>
                    <div class="wrapper" style="border: 1px solid grey;box-shadow: 1px;justify-content: center;align-items: center;width: 17%;background-color:#bfcec2;">
                        <div class="box" style="padding: 2px;">
                            <h1 class="widget-total" style="text-align:center;font-size:60px;font-weight:bolder;margin-bottom:0px;"></h1>
                            <h4 class="widget-text" style="text-align:center;font-size:17px;font-weight:bold;margin-top:10px;">KG CO2e Saved</h4>
                            <h4 class="widget-text" style="text-align:center;font-size:17px;">Active Transit users have saved<br><span class="widget-total"></span> KG CO2e travelling to our<br>facility this month</h4>
                            <h4 class="logo" style="color:#003b49;text-align:right;margin-right:10px;font-weight:bold;font-size:20px;">ECO<span style="color:#698020;">DEMY</span></h4>
                        </div>
                    </div>
                    <script>
                        window.addEventListener("DOMContentLoaded", function() {
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "http://localhost/walkit/admin/widget.php?ID=<?= $id; ?>", true);
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
                        </textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy=' 
                    <div class="wrapper" style="border: 1px solid grey;box-shadow: 1px;justify-content: center;align-items: center;width: 17%;background-color:#bfcec2;">
                        <div class="box" style="padding: 2px;">
                            <h1 class="widget-total" style="text-align:center;font-size:60px;font-weight:bolder;margin-bottom:0px;"></h1>
                            <h4 class="widget-text" style="text-align:center;font-size:17px;font-weight:bold;margin-top:10px;">KG CO2e Saved</h4>
                            <h4 class="widget-text" style="text-align:center;font-size:17px;">Active Transit users have saved<br><span class="widget-total"></span> KG CO2e travelling to our<br>facility this month</h4>
                            <h4 class="logo" style="color:#003b49;text-align:right;margin-right:10px;font-weight:bold;font-size:20px;">ECO<span style="color:#698020;">DEMY</span></h4>
                        </div>
                    </div>
                    <script>
                        window.addEventListener("DOMContentLoaded", function() {
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "http://localhost/walkit/admin/widget.php?ID=<?= $id; ?>", true);
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
                    </script>' title="Copy to clipboard">
                    <i class="fa fa-fw fa-md fa-copy icon"></i> Copy
                </button>
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
<script>
    function copyToClipboard(text, el) {
        var copyTest = document.queryCommandSupported('copy');
        var elOriginalText = el.attr('data-original-title');

        if (copyTest === true) {
            var copyTextArea = document.createElement("textarea");
            copyTextArea.value = text;
            document.body.appendChild(copyTextArea);
            copyTextArea.select();
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'Copied!' : 'Whoops, not copied!';
                el.attr('data-original-title', msg).tooltip('show');
            } catch (err) {
                console.log('Oops, unable to copy');
            }
            document.body.removeChild(copyTextArea);
            el.attr('data-original-title', elOriginalText);
        } else {
            // Fallback if browser doesn't support .execCommand('copy')
            window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
        }
    }
    $(document).ready(function() {
        // Initialize
        // ---------------------------------------------------------------------

        // Tooltips
        // Requires Bootstrap 3 for functionality
        $('.js-tooltip').tooltip();

        // Copy to clipboard
        // Grab any text in the attribute 'data-copy' and pass it to the 
        // copy function
        $('.js-copy').click(function() {
            var text = $(this).attr('data-copy');
            var el = $(this);
            copyToClipboard(text, el);
        });
    });
</script>