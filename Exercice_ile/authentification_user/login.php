<?php
include '../connexionDB.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $dbh->prepare('SELECT username , password  FROM informations');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];

        header('Location: ../read.php');
        exit;
    } else {
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        echo '<meta http-equiv="refresh" content="0;URL=../authentification.php">';
    }
} else {
    echo 'Les variables ne sont pas déclarées';
}
?>