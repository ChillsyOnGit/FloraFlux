<?php $title = 'Home';
$css = 'plant-overview.css';
require_once 'assets/sidebar.php';
?>

<section>
    <?php

    require_once 'classes/plant.php';
    $plant = new Plant();
    $plants = $plant->showPlants($_SESSION['id']);
    $plants = json_decode($plants, true);

    for ($i = 0; $i < count($plants); $i++) {
        $img = 'assets/images/plant.png';
        if ($plants[$i]['plaatje'] != null) {
            $dir = 'assets/images/user-uploads/';
            $img = $dir . $plants[$i]['id'] . '.' . $plants[$i]['plaatje'];
            if (!file_exists($img)) {
                $img = 'assets/images/plant.png';
            }
        }

        if ($plants[$i]['nieuwsteVochtigheid'] !== null) {
            $vochtigheid = ($plants[$i]['nieuwsteVochtigheid'] / 4) . '%';
            if ($plants[$i]['nieuwsteVochtigheid'] > 400) {
                $vochtigheid = '100%';
            }
        } else {
            $vochtigheid = '-';
        }

        if ($plants[$i]['laatsteKeerWater'] == null) {
            $plants[$i]['laatsteKeerWater'] = '-';
        } else {
            $date = date('Y-m-d');
            $laatsteKeerWaterDate = date('Y-m-d', strtotime($plants[$i]['laatsteKeerWater']));

            if ($laatsteKeerWaterDate == $date) {
                $plants[$i]['laatsteKeerWater'] = date('H:i', strtotime($plants[$i]['laatsteKeerWater']));
            } else {
                $plants[$i]['laatsteKeerWater'] = date('d-m-Y H:i', strtotime($plants[$i]['laatsteKeerWater']));
            }
        }
        echo '<a href="plant.php?id=' . $plants[$i]['id'] . '">
        <div class="plant">
            <div class="plant-img">
                <img src="' . $img . '" alt="plant">
            </div>
            <div class="plant-info">
                <p>Plant:<br>' . $plants[$i]['nicknaam'] . '</p>
                <p>Aantal keer water vandaag:<br>' . $plants[$i]['aantalKeerWater'] . '</p>
                <p>Vochtigheid percentage:<br>' . $vochtigheid . '</p>
                <p>Laatste uitgave<br>' . $plants[$i]['laatsteKeerWater'] . '</p>
            </div>
            </div>
        </a>';
    }
    ?>
</section>
</body>

</html>