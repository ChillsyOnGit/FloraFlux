<?php $title = 'Plant toevoegen'; 
$css = 'plant-add.css';
require_once 'assets/sidebar.php'; ?>

<section>
    
    <div class="box1">
        <h1>Nieuwe plant</h1>
        <br><br><br>
     <form action ="login.php" method="post">
        <input type="text" name="Naam plant" placeholder="Naam plant">
        <br>
        <input type="text" name="Pomp ID" placeholder="Pomp ID">
        <br>
        <select id="Plant soort">
            <option selected disabled>Soort plant</option>
            <option value="Dolle-Kervel">Dolle Kervel</option>
            <option value="Verlariaan">Valeriaan</option>
            <option value="Gele-Lis">Gele Lis</option>
            <option value="Zombo">Zombo</option>
        </select>
        <br>
        <input class="toevoegen" type="submit" value="Toevoegen">
    </div>
</section>
</body>

</html>