<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Floraflux - register</title>
</head>
<body>
    
    <div class="box2">
        <h2>Aanmelden</h2>
     <form action ="login.php" method="post">
        <input type="email" name="email" placeholder="E-mail" required>
        <div><input type="text" name="vnaam" placeholder="Voornaam" required>
        <input type="text" name="anaam" placeholder="Achternaam"></div>
        <input type="tel" name="tnummer" placeholder="Telefoonnummer">
        <div><input type="password" name="password" placeholder="Wachtwoord" required>
        <input type="password" name="bpassword" placeholder="Bevestig wachtwoord" required></div>
        <input type="submit" value="Inloggen">
    </form>
    <div class="text"><p>*verplicht veld</php>
    <p>Al een account?
    Log je <a href='login.php'>hier</a> in</p></div>
</div>   
</body>
</html>