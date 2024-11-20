<?php $title = 'Home'; 
$css = 'plant-overview.css';
require_once 'assets/sidebar.php'; ?>

<section>
    <?php
    for ($i = 0; $i < 10; $i++) {
        echo '<a href="plant.php?id='.$i.'">
        <div class="plant">
            <div class="plant-img">
                <img src="assets/images/plant.jpg" alt="plant">
            </div>
            <div class="plant-info">
                <p>Plant:<br>Fungi Nuisance</p>
                <p>Aantal water gekregen:<br>21</p>
                <p>Vochtigheid percentage:<br>100%</p>
                <p>Tijd van uitgave<br>11:49</p>
            </div>
            <div class="plant-warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
        </a>';
    }
    ?>

    
</section>
</body>

</html>