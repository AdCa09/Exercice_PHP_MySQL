<<<<<<< HEAD
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
>>>>>>> 229c9c9674b801e430bb82398721d283d4fb35da
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