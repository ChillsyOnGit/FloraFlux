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
    $temp = false;

    for ($i = 0; $i < count($plants); $i++) {  
        $img = 'assets/images/plant.png';  
        if ($plants[$i]['plaatje'] != null) {

        if (file_exists($plants[$i]['plaatje'])) {
            $img = $plants[$i]['plaatje'];
        }
    }
        echo '<a href="plant.php?id='.$plants[$i]['id'].'">
        <div class="plant">
            <div class="plant-img">
                <img src="'.$img.'" alt="plant">
            </div>
            <div class="plant-info">
                <p>Plant:<br>'.$plants[$i]['nicknaam'].'</p>
                <p>Aantal water gekregen:<br>21</p>
                <p>Vochtigheid percentage:<br>100%</p>
                <p>Tijd van uitgave<br>11:49</p>
            </div>';
            if ($temp) {
                echo '<div class="plant-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>';
            }
        echo '</div>
        </a>';
    }
    ?>
</section>
</body>
</html>