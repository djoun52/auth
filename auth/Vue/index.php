<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User !</title>
</head>

<body>
    <?php
    if (isset($_SESSION['user'])) {
    ?>
        <a href="profil.php">Profile</a>
        <a href="../Controler/authControler.php?name=deco">Deconnexion</a>
    <?php
    } else {
    ?>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
    <?php
    }
    ?>
</body>

</html>