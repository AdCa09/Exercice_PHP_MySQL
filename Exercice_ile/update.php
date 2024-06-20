<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <h1>Modifier une randonnée</h1>

    <?php
    
    include 'connexionDB.php';

    
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];

        
        $stmt = $dbh->prepare('SELECT * FROM hiking WHERE id = ?');
        $stmt->execute([$id]);
        $hiking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hiking) {
            ?>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $hiking['id']; ?>">
                
                <label for="name">Nom :</label><br>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($hiking['name']); ?>" required><br><br>
        
                <label for="difficulty">Difficulté :</label><br>
                <select id="difficulty" name="difficulty" required>
                    <option value="très facile" <?php if ($hiking['difficulty'] === 'très facile') echo 'selected'; ?>>Très facile</option>
                    <option value="facile" <?php if ($hiking['difficulty'] === 'facile') echo 'selected'; ?>>Facile</option>
                    <option value="moyen" <?php if ($hiking['difficulty'] === 'moyen') echo 'selected'; ?>>Moyen</option>
                    <option value="difficile" <?php if ($hiking['difficulty'] === 'difficile') echo 'selected'; ?>>Difficile</option>
                    <option value="très difficile" <?php if ($hiking['difficulty'] === 'très difficile') echo 'selected'; ?>>Très difficile</option>
                </select><br><br>
        
                <label for="distance">Distance (km) :</label><br>
                <input type="number" id="distance" name="distance" value="<?php echo htmlspecialchars($hiking['distance']); ?>" min="0" step="0.1" required><br><br>
        
                <label for="duration">Durée :</label><br>
                <input type="time" id="duration" name="duration" value="<?php echo htmlspecialchars($hiking['duration']); ?>" required><br><br>
        
                <label for="height_difference">Dénivelé (m) :</label><br>
                <input type="number" id="height_difference" name="height_difference" value="<?php echo htmlspecialchars($hiking['height_difference']); ?>" min="0" required><br><br>
        
                <input type="submit" value="Enregistrer les modifications">
            </form>
            <?php
        } else {
            echo "Randonnée non trouvée.";
        }
    }
    ?>

    <br>
    <a href="read.php">Retour à la liste des randonnées</a>
</body>
</html>
