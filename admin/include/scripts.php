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
              f: carbonSaved.toFixed(2) + ' carbon'
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
            f: totalCarbonSaved.toFixed(2) + ' carbon'
          }
        ]);

        var dataTable = google.visualization.arrayToDataTable(chartData);

        // Draw the charts
        var options = {
          title: 'Data Over Time',
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
</script>

</body>

</html>