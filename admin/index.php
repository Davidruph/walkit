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
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Participants</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">

                  <?php
                  $count = $connection->prepare("SELECT * FROM data_accumulator WHERE company_user_id = $id");
                  $count->execute();
                  $users = $count->rowCount();
                  echo $users;
                  ?>

                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-green-300 text-dark"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div id="chart_div" style="width: 100%; height: 400px;"></div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ["corechart"]
  });
  google.charts.setOnLoadCallback(drawCharts);

  function drawCharts() {
    // Fetch data from the backend
    fetch('../admin/chart.php')
      .then(response => response.json())
      .then(data => {
        var chartData = [
          ['Date', 'KM Saved', 'Carbon Saved']
        ];
        var companyName = data.length > 0 ? data[0].company_name : '';

        var groupedData = {};
        var totalKmSaved = 0;
        var totalCarbonSaved = 0;

        data.forEach(row => {
          var date = row.submitted_on;
          if (!groupedData[date]) {
            groupedData[date] = {
              kmSaved: 0,
              carbonSaved: 0
            };
          }
          var kmSaved = parseFloat(row.km_saved);
          var carbonSaved = parseFloat(row.saved_carbon);
          groupedData[date].kmSaved += kmSaved;
          groupedData[date].carbonSaved += carbonSaved;
          totalKmSaved += kmSaved;
          totalCarbonSaved += carbonSaved;
        });

        Object.keys(groupedData).forEach(date => {
          var kmSaved = groupedData[date].kmSaved;
          var carbonSaved = groupedData[date].carbonSaved;
          chartData.push([
            date,
            {
              v: kmSaved,
              f: kmSaved.toFixed(2) + ' km'
            },
            {
              v: carbonSaved,
              f: carbonSaved.toFixed(2) + ' kg'
            }
          ]);
        });

        // Add separate totals as annotations
        chartData.push([
          'Total',
          {
            v: totalKmSaved,
            f: totalKmSaved.toFixed(2) + ' kms'
          },
          {
            v: totalCarbonSaved,
            f: totalCarbonSaved.toFixed(2) + ' kg'
          }
        ]);

        var dataTable = google.visualization.arrayToDataTable(chartData);

        // Draw the charts
        var options = {
          title: companyName + ' ACTIVE TRANSIT CARBON CALCULATOR DATA',
          curveType: 'function',
          legend: {
            position: 'bottom'
          },
          series: {
            0: { // KM Saved series
              annotations: {
                textStyle: {
                  fontSize: 12
                },
                stem: {
                  length: 8
                }
              },
              pointSize: 8, // Adjust the point size
              pointShape: 'circle' // Set the point shape to circle
            },
            1: { // Carbon Saved series
              annotations: {
                textStyle: {
                  fontSize: 12
                },
                stem: {
                  length: 8
                }
              },
              pointSize: 8, // Adjust the point size
              pointShape: 'circle' // Set the point shape to circle
            }
          },
          annotations: {
            alwaysOutside: true
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(dataTable, options);
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  }
</script>