<?php 
$title = 'Plant toevoegen'; 
$css = 'plant-add.css';
require_once 'classes/plant.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $_POST['test'];
    $plant = new Plant();
    $plants = $plant->searchPlants($query);
    var_dump($plants); // Display the search results for debugging
    exit();
}

require_once 'assets/sidebar.php'; 
?>
<section>
    <div class="box1">
        <h1>Nieuwe plant toevoegen</h1>
        <br>
        <form action="add.php" method="post">
            <input type="text" name="Naam plant" placeholder="Nickname plant">
            <br>
            <input type="text" name="Pomp ID" placeholder="Pomp ID">
            <br>
            <input type="text" name="test" placeholder="Soort plant">
            <br>
            <input class="toevoegen" type="submit" value="Toevoegen">
        </form>
    </div>
</section>
</body>
</html>