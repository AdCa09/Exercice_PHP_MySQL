<?php

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "ile_reunion";

try{
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    error_log('Connexion établie');

    
}
catch(PDOException $e){
    die('Impossible de se connecter à la base de données : ' . $e->getMessage());
}

    ?>