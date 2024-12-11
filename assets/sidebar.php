<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="css/<?= $css ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>FloraFlux<?= isset($title) ? " - ".$title : '' ?></title></title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> </a></li>
            <li><a href="add.php"><i class="fas fa-plus"></i> </a></li>
            <li><a href="account.php"><i class="fas fa-user"></i> </a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> </a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> </a>
            </li>
        </ul>
</nav>