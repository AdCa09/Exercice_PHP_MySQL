<?php
include 'authentification_user/verif_session.php';


session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {

  echo '<html>';
  echo '<head>';
  echo '<title>read.php</title>';
  echo '</head>';

  echo '<body>';
  echo 'Votre username est ' . $_SESSION['username'] . ' et votre mot de passe est ' . $_SESSION['password'] . '.';

  echo '<a href=/Exercice_PHP_MySQL/Exercice_ile/authentification_user/logout.php>Déconnexion</a>';



} else {
  echo 'Variables non déclarées.';
}
;
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Liste des randonnées</title>
  <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
  <h1>Liste des randonnées</h1>
  <table>

    <tbody>
      <?php
      include 'connexionDB.php';

      $stmt = $dbh->prepare("SELECT * FROM hiking");
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo '<table border="1">';
      echo '<thead><tr><th>ID</th><th>Name</th><th>Difficulty</th><th>Distance</th><th>Duration</th><th>Height Difference</th></tr></thead>';
      echo '<tbody>';

      foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td><a href="update.php?id=' . $row['id'] . '">' . $row['name'] . '</a></td>';
        echo '<td>' . $row['difficulty'] . '</td>';
        echo '<td>' . $row['distance'] . '</td>';
        echo '<td>' . $row['duration'] . '</td>';
        echo '<td>' . $row['height_difference'] . '</td>';
        echo '<td>' . $row['avaible'] . '</td>';
        echo '<td><a href="update.php?id=' . $row['id'] . '">Modifier</a></td>';
        echo '<td><form action="delete.php" method="post"><input type="hidden" name="id" value="' . $row['id'] . '"><button type="submit" name="delete_button">Supprimer</button></form></td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <button onclick="window.location.href='create.php'">Ajouter une randonnée</button>
</body>

</html>