<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <a href="/Exercice_PHP_MySQL/Exercice_ile/read.php">Liste des données</a>
    <h1>Ajouter</h1>
    <form action="create.php" method="post">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="difficulty">Difficulté :</label><br>
        <select id="difficulty" name="difficulty" required>
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="très difficile">Très difficile</option>
        </select><br>

        <label for="distance">Distance (km) :</label><br>
        <input type="number" id="distance" name="distance" min="0" step="0.1" required><br>

        <label for="duration">Durée :</label><br>
        <input type="time" id="duration" name="duration" required><br>

        <label for="height_difference">Dénivelé (m) :</label><br>
        <input type="number" id="height_difference" name="height_difference" min="0" required><br>

        <label for="avaible">Avaible(Y/N) :<br>
            <select name="avaible" id="avaible">
                <option value="YES">YES</option>
                <option value="NO">NO</option>
            </select>
        </label><br>

        <button type="submit" name="button" onclick="alert('La randonnée a été ajoutée avec succès.)">Envoyer</button>

    </form>
</body>

</html>


<?php




try {

    include 'connexionDB.php';
    include 'authentification_user/verif_session.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button'])) {
        if (isset($_POST['name']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['height_difference']) && isset($_POST['avaible'])) {
            $name = $_POST['name'];
            $difficulty = $_POST['difficulty'];
            $distance = $_POST['distance'];
            $duration = $_POST['duration'];
            $denivele = $_POST['height_difference'];
            $avaible = $_POST['avaible'];

            try {
                $stmt = $dbh->prepare("INSERT INTO hiking (name, difficulty , distance, duration, height_difference, avaible) VALUES (:name, :difficulty , :distance, :duration , :height_difference, :avaible)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':difficulty', $difficulty);
                $stmt->bindParam(':distance', $distance);
                $stmt->bindParam(':duration', $duration);
                $stmt->bindParam(':height_difference', $denivele);
                $stmt->bindParam(':avaible', $avaible);

                $stmt->execute();



                /*Si nous ne mettons pas de redirection, lors du rafraichissement de la page, génere les mêmes valeurs déjà rentrer dans l'input à chaque refresh de la page et les inserts dans le tableau.*/
                header("Location:read.php");
                exit;

            } catch (PDOException $e) {
                die('Erreur d\'insertion : ' . $e->getMessage());
            }
        } else {
            echo "Tous les champs sont requis.";
        }
    }



} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}