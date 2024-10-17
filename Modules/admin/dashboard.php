<h3>Dashboard</h3>
<div class="container">
  <!-- <div class="row"> -->
  <div class=" offset-md-3">
    <canvas id="bloodStockChart"></canvas>
  </div>
  <!-- </div> -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Fetch blood stock data from the PHP file
  fetch('Model/barGraphData.php')
    .then(response => response.json())
    .then(data => {
      const bloodGroups = data.map(item => item.blood_group);
      const quantities = data.map(item => item.total_quantity);

      // Create the bar chart using Chart.js
      new Chart('bloodStockChart', {
        type: 'bar',
        data: {
          labels: bloodGroups,
          datasets: [{
            label: 'Blood Stock',
            data: quantities,
            backgroundColor: 'rgba(0, 123, 255, 0.8)'
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Quantity'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Blood Group'
              }
            }
          }
        }
      });
    });
</script>