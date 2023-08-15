<?php
//All header tag to be included
include('include/header.php');
?>

<?php

//db connection
include("../dbconn.php");
//fetch
$id = $_SESSION['user'];
$sql = mysqli_query($conn, "SELECT * FROM packit WHERE user_id = $id");

?>

<?php
//sidebar tag to be included
include('include/sidebar.php');
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Packit Data</li>
        </ol>

        <div class="col-md-12">
            <div class="demo-box m-t-20">

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-dark" id="dataTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Selected Options</th>
                                <th>Carbon Saved</th>
                                <th>Date/Time</th>
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
                                        <td><?php echo $row['selected_option']; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td><?php echo $row['created_on']; ?></td>
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

        <div class="row mb-4 mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>FILTER DATA</h3>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="carbonCheckbox" checked>
                            <label class="form-check-label" for="carbonCheckbox">Carbon Saved</label>
                        </div>
                        <div class="form-inline justify-content-center pt-3">
                            <label class="mr-2" for="startDate">Start Date:</label>
                            <input class="form-control mr-4" type="date" id="startDate" value="2023-01-01">
                            <label class="mr-2" for="endDate">End Date:</label>
                            <input class="form-control" type="date" id="endDate" value="2023-12-31">
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="chart-container">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php
//footer tag to be included
include('include/footer.php');
?>

<script src="assets/js/jquery.js" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    // Call the dataTables jQuery plugin

    $.extend(true, $.fn.dataTable.defaults, {
        searching: true,
        ordering: false,
    });
    $(document).ready(function() {
        $("#dataTable").DataTable();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    function formatDate(dateString) {
        const date = new Date(dateString);
        return `${date.toLocaleString('default', { month: 'short' })} ${date.getDate()}, ${date.getFullYear()}`;
    }

    function drawChart(data) {
        var ctx = document.getElementById('myChart').getContext('2d');

        // Create initial chart with all data
        var chart = new Chart(ctx, {
            type: 'line',
            data: getChartData(data),
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: data.length > 0 ? `ACTIVE TRANSIT PACKIT CARBON CALCULATOR DATA - ${data[0].company_name}` : 'ACTIVE TRANSIT CARBON CALCULATOR DATA',
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 10,
                            callback: function(value, index, values) {
                                // Display every 5th label to avoid overlapping
                                return index % 5 === 0 ? value : '';
                            },
                        },
                    },
                    y: {
                        beginAtZero: true,
                        // ticks: {
                        //   callback: function(value, index, values) {
                        //     return formatKmSaved(value); // Format the y-axis labels with "kms"
                        //   },
                        // },
                    },
                },
            },
        });

        document.getElementById('carbonCheckbox').addEventListener('change', function() {
            chart.getDatasetMeta(0).hidden = !this.checked;
            chart.update();
        });

        document.getElementById('startDate').addEventListener('change', function() {
            chart.data = getChartData(data);
            chart.update();
        });

        document.getElementById('endDate').addEventListener('change', function() {
            chart.data = getChartData(data);
            chart.update();
        });
    }

    function getChartData(data) {
        // Get the start and end dates from the input fields
        var startDate = new Date(document.getElementById('startDate').value);
        var endDate = new Date(document.getElementById('endDate').value);

        // Filter data based on the date range
        var filteredData = data.filter(item => {
            var date = new Date(item.created_on);
            return date >= startDate && date <= endDate;
        });

        // Extract data for chart
        var dates = filteredData.map(item => formatDate(item.created_on));
        var carbonSaved = filteredData.map(item => parseFloat(item.total));
        var selected_option = filteredData.map(item => item.selected_option);
        var combinedLabels = dates.map((date, index) => `${date} (${selected_option[index]})`);

        return {
            labels: combinedLabels,
            datasets: [{
                label: 'Carbon Saved',
                data: carbonSaved,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: false,
                hidden: false, // Initially visible
            }, ],
        };
    }

    // Fetch data from the backend
    fetch('../admin/packit_chart.php')
        .then(response => response.json())
        .then(data => {
            drawChart(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>
</body>

</html>