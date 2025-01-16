<?php $title = 'Plant'; 
$css = 'plant.css';
require_once 'assets/sidebar.php'; 
require_once 'classes/plant.php';
$plant = new Plant();
$plantData = $plant->showPlant($_GET['id']);
$plantData = json_decode($plantData, true);
$plantData = $plantData[0];
$plantMeting = $plant->plantMeting($_GET['id']);
$timeDifference = $plantMeting[1];
$plantMeting = $plantMeting[0];
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if ($plantData['plaatje'] == null) {
    $img = 'assets/images/plant.png';
} else {
    $dir = 'assets/images/user-uploads/';
    $img = $dir . $plantData['id'] . '.' . $plantData['plaatje'];
    if (!file_exists($img)) {
        $img = 'assets/images/plant.png';
    }
}
?>

<section>
    <div class="plant">
        <div class="plant-info">
            <div class="plant-img">
                <img src="<?= $img ?>" alt="plant">
            </div>
            <div class="plant-text">
                <h1><?= $plantData['nicknaam'] ?></h1>
                <p>De plant leeft al: <?= $timeDifference ?></p>
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
if (empty($plantMeting)) {
    $plantMeting = [
        ['timestamp' => date('Y-m-d'), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-1 day')), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-2 days')), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-3 days')), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-4 days')), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-5 days')), 'waterGebruikt' => 0],
        ['timestamp' => date('Y-m-d', strtotime('-6 days')), 'waterGebruikt' => 0]
    ];
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
                data: <?php echo json_encode(array_column($plantMeting, 'waterGebruikt')); ?>,
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