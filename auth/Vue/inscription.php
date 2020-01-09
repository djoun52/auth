<?php

session_start();

if (isset($_SESSION['user'])) {
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
    <form action="../Controler/authControler.php?name=register" method="post">
        <input type="email" name="u_email" id="" placeholder="email">
        <br>
        <br>
        <input type="password" name="u_password" id="" placeholder="mot de passe">
        <br>
        <br>
        <input type="password" name="u_confirm_password" id="" placeholder="confirme mot de passe">
        <br>
        <br>
        <input type="date" name="u_daten" id="" placeholder="date de naisance">
        <br>
        <br>
        <input type="text" name="u_prenom" id="" placeholder="prénom">
        <br>
        <br>
        <input type="text" name="u_nom" placeholder="nom" id="nom">
        <br>
        <br>
        <button type="submit">S'inscrire !</button>
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