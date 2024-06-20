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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_button'])) {
    $id = $_POST['id'];

    try {
        
        $stmt_delete = $dbh->prepare("DELETE FROM hiking WHERE id = :id");
        $stmt_delete->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_delete->execute();

        
        header("Location: read.php");
        exit;
    } catch (PDOException $e) {
        echo 'Erreur de suppression : ' . $e->getMessage();
    }
} else {
    echo "Action de suppression non autorisée.";
}
?>
