<?php

$dsn    = "mysql:host=localhost;dbname=users";
$dbuser = "root";
$dbpass = "";

try {

    $bdd = new PDO($dsn, $dbuser, $dbpass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $bdd->exec("SET CHARACTER SET utf8");
} catch (PDOException $err) {
    $now = new DateTime("", new DateTimeZone('Europe/Paris'));
    $now = $now->format("d-M-Y H:i:s");
    $msg = $now . " - ERREUR BDD : " . $err->getMessage() . PHP_EOL;
    file_put_contents('log.txt', $msg, FILE_APPEND);
    die();
}
