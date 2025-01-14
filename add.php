<?php 
$title = 'Plant toevoegen'; 
$css = 'plant-add.css';
require_once 'assets/sidebar.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/plant.php';
    $plant = new Plant();
    $plant->addPlant($_POST['plant-id'], $_POST['nickname'], $_SESSION['id'], $_FILES['img']);
    header('Location: index.php');
}

?>
<section>
    <div class="box1">
        <h1>Nieuwe plant toevoegen</h1>
        <br>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <input type="text" name="plant-id" placeholder="Plant ID">
            <br>
            <input type="text" name="nickname" placeholder="Nickname">
            <br>
            <input type="file" name="img" accept="image/png, image/jpeg, image/jpg" placeholder="Image">
            <br>
            <input class="toevoegen" type="submit" value="Toevoegen">
        </form>
    </div>
</section>
</body>
</html>