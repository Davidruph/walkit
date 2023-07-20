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

  function formatKmSaved(kmSaved) {
    return kmSaved.toFixed(2) + ' kms';
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
            text: data.length > 0 ? `ACTIVE TRANSIT CARBON CALCULATOR DATA - ${data[0].company_name}` : 'ACTIVE TRANSIT CARBON CALCULATOR DATA',
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

    // Add event listeners to the filter checkboxes and date inputs
    document.getElementById('kmCheckbox').addEventListener('change', function() {
      chart.getDatasetMeta(0).hidden = !this.checked;
      chart.update();
    });

    document.getElementById('carbonCheckbox').addEventListener('change', function() {
      chart.getDatasetMeta(1).hidden = !this.checked;
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
      var date = new Date(item.submitted_on);
      return date >= startDate && date <= endDate;
    });

    // Extract data for chart
    var dates = filteredData.map(item => formatDate(item.submitted_on));
    var kmSaved = filteredData.map(item => parseFloat(item.km_saved));
    var carbonSaved = filteredData.map(item => parseFloat(item.saved_carbon));

    return {
      labels: dates,
      datasets: [{
          label: 'KM Saved',
          data: kmSaved,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          fill: false,
          hidden: false, // Initially visible
        },
        {
          label: 'Carbon Saved',
          data: carbonSaved,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          fill: false,
          hidden: false, // Initially visible
        },
      ],
    };
  }

  // Fetch data from the backend
  fetch('../admin/chart.php')
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