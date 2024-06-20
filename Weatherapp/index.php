<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log('Connexion établie');


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (isset($_POST['ville']) && isset($_POST['haut']) && isset($_POST['bas'])) {
            $ville = $_POST['ville'];
            $haut = $_POST['haut'];
            $bas = $_POST['bas'];

            try {
                $stmt = $dbh->prepare("INSERT INTO météo (ville, haut, bas) VALUES (:ville, :haut, :bas)");
                $stmt->bindParam(':ville', $ville);
                $stmt->bindParam(':haut', $haut);
                $stmt->bindParam(':bas', $bas);

                $stmt->execute();
                echo "Insertion réussie.";


                /*Si nous ne mettons pas de redirection, lors du rafraichissement de la page, génere les mêmes valeurs déjà rentrer dans l'input à chaque refresh de la page et les inserts dans le tableau.*/
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                die('Erreur d\'insertion : ' . $e->getMessage());
            }
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        if (isset($_POST['selection']) && !empty($_POST['selection'])) {
            $selection = $_POST['selection'];
            foreach ($selection as $ville) {
                try {
                    $stmt_delete = $dbh->prepare("DELETE FROM météo WHERE ville = :ville");
                    $stmt_delete->bindParam(':ville', $ville);
                    $stmt_delete->execute();
                    echo "Suppression réussie de l'élément avec Ville : $ville.<br>";
                } catch (PDOException $e) {
                    die('Erreur de suppression : ' . $e->getMessage());
                }
            }
        } else {
            echo "Aucune sélection à supprimer.";
        }
    }

    $stmt = $dbh->prepare('SELECT * FROM météo');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<form action="index.php" method="post">';
    echo '<table border="1px">
            <tr>
                <th>Sélectionner</th>
                <th>Ville</th>
                <th>Haut</th>
                <th>Bas</th>
            </tr>';
    foreach ($results as $row) {
        echo '<tr>
                <td><input type="checkbox" name="selection[]" value="' . $row['ville'] . '"></td>
                <td>' . htmlspecialchars($row['ville']) . '</td>
                <td>' . htmlspecialchars($row['haut']) . '</td>
                <td>' . htmlspecialchars($row['bas']) . '</td>
              </tr>';
    }
    echo '</table>';
    echo '<input type="submit" name="delete" value="Supprimer sélection">';
    echo '</form>';

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<form action="index.php" method="post">
    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville" placeholder="Entrez une ville"><br>

    <label for="haut">Haut :</label>
    <input type="number" id="haut" name="haut"><br>

    <label for="bas">Bas :</label>
    <input type="number" id="bas" name="bas"><br>

    <input type="submit" name="submit" value="Ajouter">
</form>