<?php
$servername = "localhost";
$dbname = "utazasiiroda";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, "root", "", $dbname);

// Kapcsolódási hibaellenőrzés
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

// A POST kérésből származó országok tömbjének megszerzése
$countries = isset($_POST['orszag']) ? $_POST['orszag'] : [];

// Az országok tömbből egyetlen string létrehozása SQL lekérdezéshez
$countryList = "'" . implode("','", $countries) . "'";

// SQL lekérdezés az ország-repülőtér párok megszerzésére
$sql = "SELECT 
            country1.nicename AS orszag1, 
            airports1.name AS repter1, 
            country2.nicename AS orszag2, 
            airports2.name AS repter2
        FROM 
            country AS country1
            JOIN airports AS airports1 ON airports1.countryName = country1.nicename
            JOIN country AS country2 ON country2.nicename IN ($countryList)
            JOIN airports AS airports2 ON airports2.countryName = country2.nicename
        WHERE 
            country1.nicename = '$countries[0]'";

$result = $conn->query($sql);

// Eredmények ellenőrzése és megjelenítése
if ($result->num_rows > 0) {
    // Ha vannak eredmények, megjelenítjük az ország-repülőtér párokat
    echo "<table>";
    echo "<tr><th>Ország 1</th><th>Repülőtér 1</th><th>Ország 2</th><th>Repülőtér 2</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["orszag1"] . "</td>";
        echo "<td>" . $row["repter1"] . "</td>";
        echo "<td>" . $row["orszag2"] . "</td>";
        echo "<td>" . $row["repter2"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Ha nincsenek eredmények, hibaüzenetet jelenítünk meg
    echo "Nincsenek találatok";
}

// Adatbáziskapcsolat bezárása
$conn->close();
?>