<?php $title = 'Plant'; 
$css = 'plant.css';
require_once 'assets/sidebar.php'; ?>

<section>
    <div class="plant">
        <div class="plant-info">
            <div class="plant-img">
            <img src="assets/images/plant.jpg" alt="plant">
            </div>
            <div class="plant-text">
                <h1>Fungi Nuisance</h1>
                <p>Plant leeft al voor 142 dagen</p>
                <p class="plant-warning"><i class="fas fa-exclamation-triangle"></i>Water bijna op</p>
            </div>
        </div>
        <div class="plant-graphic">
        <canvas id="myChart" width="9000" height="2200" style="display: block; box-sizing: border-box; height: 2200px; width: 900px;"></canvas>
        </div>
    </div>
</section>

<?php
$labels = [];
for ($i = 6; $i >= 0; $i--) {
    $labels[] = date('Y-m-d', strtotime("-$i days"));
}
$labels_json = json_encode($labels);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $labels_json; ?>, // Use the generated labels
            datasets: [{
                label: 'Water Level',
                data: [65, 59, 80, 81, 56, 55, 40], // Example data
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>