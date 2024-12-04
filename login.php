<?php 
// Enable error reporting
require_once 'classes/user.php';

//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$login = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login->login($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>FloraFlux - Login</title>
</head>
<body>
<div class="grotebox">
    <div class="box1">
        <h1>Welkom</h1>
    </div>
    
    <div class="box2">
        <h2>Inloggen</h2>
     <form action ="login.php" method="post">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Wachtwoord">
        <input type="submit" value="Inloggen">
    </form>
    <p>Nog geen account?
    Meld je <a href='register.php'>hier</a> aan</p>
</div>
</div>
</body>
</html>