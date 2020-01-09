<?php

require_once('../Modele/connect.php');

session_start();

var_dump($_POST);

// die();

// $_SESSION['user'] = $_POST['u_email'];
// header('Location: ../Vue/profil.php');

if ($_GET['name'] == "connect") {
    if (!empty($_POST['u_email']) && !empty($_POST['u_password'])) {
        $stmt = $bdd->prepare('SELECT * FROM users WHERE email= :mail');
        $stmt->bindParam("mail", $_POST['u_email']);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result !== false) {
            if (password_verify($_POST['u_password'], $result['password'])) {
                // var_dump($result);
                $_SESSION['user'] = $result;
                // unset($_SESSION['error_msg']);
                $_SESSION['error_msg'] = '';
                header('Location: ../Vue/profil.php');
            } else {
                $_SESSION['error_msg'] = 'mauvais mot de passe';
                header('Location: ../Vue/connexion.php');
                die();
            }
        } else {
            //utlisateur nexiste pas 
            $_SESSION['error_msg'] = "L'utilisateur n'existe pas";
            header('Location: ../Vue/connexion.php');
            die();
        }
    } else {
        // remplir les champs
        $_SESSION['error_msg'] = 'Veuillez remplir les champs';
        header('Location: ../Vue/connexion.php');
        die();
    }
}

if ($_GET['name'] == "register") {
    $email = filter_input(INPUT_POST, 'u_email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'u_password', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/"))); // regex miniscule et chiffre minimum 6 character max 18 charachter
    $password_confirm = filter_input(INPUT_POST, 'u_confirm_password', FILTER_DEFAULT);
    $daten = filter_input(INPUT_POST, 'u_daten', FILTER_DEFAULT);
    $prenom = filter_input(INPUT_POST, 'u_prenom', FILTER_DEFAULT);
    $nom = filter_input(INPUT_POST, 'u_nom', FILTER_DEFAULT);

    $dateTmp = date('Y/m/d');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_msg'] = "Mets un email valide !";
        header('Location: ../Vue/inscription.php');
        die();
    }

    if (!empty($_POST['u_email']) && !empty($_POST['u_password']) && !empty($_POST['u_confirm_password']) && !empty($_POST['u_daten']) && !empty($_POST['u_nom']) && !empty($_POST['u_prenom'])) {
        $stmt = $bdd->prepare('SELECT * FROM users WHERE email= :mail');
        $stmt->bindParam("mail", $_POST['u_email']);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result == false) {
            if (strtotime($dateTmp) > strtotime($_POST['u_daten'])) {
                if (filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/")))) {
                    if ($_POST['u_password'] == $_POST['u_confirm_password']) {
                        $hashage = password_hash($_POST['u_password'], PASSWORD_DEFAULT);
                        $stmt = $bdd->prepare("INSERT INTO users (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
                        $stmt->execute(array($_POST['u_email'], $hashage, $_POST['u_daten'], $_POST['u_nom'], $_POST['u_prenom']));
                        $_SESSION['error_msg'] = '';
                        header('Location: ../Vue/connexion.php');
                    } else {
                        $_SESSION['error_msg'] = 'les mot de passe ne concorde pas';
                        header('Location: ../Vue/inscription.php');
                        die();
                    }
                } else {
                    $_SESSION['error_msg'] = 'la mot de passe doit faire entre 8 et 16 caractere au moins 1 Majuscule 1 chiffre et 1 miniscules';
                    header('Location: ../Vue/inscription.php');
                    die();
                }
            } else {
                $_SESSION['error_msg'] = 'me prends pas pour un con avec ta datte';
                header('Location: ../Vue/inscription.php');
                die();
            }
        } else {
            $_SESSION['error_msg'] = 'Utilsateur existe déjà';
            header('Location: ../Vue/inscription.php');
            die();
        }
    } else {
        $_SESSION['error_msg'] = 'Veuillez remplir les champs';
        header('Location: ../Vue/inscription.php');
        die();
    }
}

if ($_GET['name'] == 'deco') {
    session_start();
    unset($_SESSION['user']);
    header("Location: ../Vue/index.php");
    die();
}

header("Location:../Vue/index.php");
