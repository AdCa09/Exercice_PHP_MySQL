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
<?php

include 'connexionDB.php';
include 'authentification_user/verif_session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $height_difference = $_POST['height_difference'];
    $avaible = $_POST['avaible'];


    $stmt = $dbh->prepare('UPDATE hiking SET name = ?, difficulty = ?, distance = ?, duration = ?, height_difference = ?, avaible = ?WHERE id = ?');
    $stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $avaible, $id]);


    header('Location: read.php');
    exit();
} else {

    header('Location: read.php');
    exit();
}
?>