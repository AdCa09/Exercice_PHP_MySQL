Exercice 1
Afficher tous les clients.


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colyseum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
}


$sql = "SELECT firstName, birthDate FROM clients";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

        echo "<h2>Liste des clients :</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Prénom</th><th>Date de naissance</th></tr>";
        while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["birthDate"] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
} else {
        echo "Aucun résultat trouvé.";
}



?>
<br>

Exercice 2
Afficher tous les types de spectacles possibles.


<?php



$sql = "SELECT * FROM shows";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

        echo "<h2>Liste des clients :</h2>";
        echo "<table border='1'>";
        echo "<tr><th>title</th><th>performer</th><th>date</th><th>showTypeId</th><th>firstGenresId</th><th>secondGenreId</th><th>duration</th><th>startTime</th></tr>";
        while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["performer"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["showTypesId"] . "</td>";
                echo "<td>" . $row["firstGenresId"] . "</td>";
                echo "<td>" . $row["secondGenreId"] . "</td>";
                echo "<td>" . $row["duration"] . "</td>";
                echo "<td>" . $row["startTime"] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
} else {
        echo "Aucun résultat trouvé.";
}


?>
<br>

Exercice 3
Afficher les 20 premiers clients.



<?php

$sql = "SELECT id, firstName, birthDate FROM clients LIMIT 20";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

        echo "<h2>Liste des clients :</h2>";
        echo "<table border='1'>";
        echo "<tr><th>id</th><th>Prénom</th><th>Date de naissance</th></tr>";
        while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["birthDate"] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
} else {
        echo "Aucun résultat trouvé.";
}



?>
<br>


Exercice 4
N'afficher que les clients possédant une carte de fidélité.



<?php

$sql = "SELECT id, firstName, birthDate, card FROM clients WHERE card = 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

        echo "<h2>Liste des clients :</h2>";
        echo "<table border='1'>";
        echo "<tr><th>id</th><th>Prénom</th><th>Date de naissance</th><th>card</th></tr>";
        while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["birthDate"] . "</td>";
                echo "<td>" . $row["card"] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
} else {
        echo "Aucun résultat trouvé.";
}



?>
<br>

Exercice 5
Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".



<?php

$sql = "SELECT  firstName, lastname FROM clients WHERE lastname LIKE 'm%' ORDER BY lastname ASC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>Nom : " . $row["lastname"] . "</p>";
                echo "<p>Prénom : " . $row["firstName"] . "</p>";
                echo "</div>";
        }
} else {
        echo "Aucun résultat trouvé.";
}

?>
<br>


Exercice 6
Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre
alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.