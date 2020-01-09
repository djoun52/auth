<?php

session_start();

if(isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="../Controler/authControler.php?name=connect" method="post">
        <input type="email" name="u_email" id="" placeholder="email">
        <input type="password" name="u_password" id="" placeholder="mot de passe">
        <button type="submit">Se connecter !</button>
    </form>
    <?php

    if (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '') {
        echo '<p>' . $_SESSION['error_msg'] . '</p>';
    }

    ?>

<a href="connexion.php">Connexion</a>
    <a href="inscription.php">Inscription</a>
    <a href="profil.php">Profile</a>

</body>

</html>