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

if (empty($countries)) {
    die("Nincsenek megadva országok.");
}

// Egyedi országok és repterek lekérdezése
$countriesList = implode("','", $countries);
$sqlUniqueRepterek1 = "SELECT DISTINCT country.nicename AS orszag1, airports.name AS repter1
                       FROM country
                       JOIN airports ON airports.countryName = country.nicename
                       WHERE country.nicename = '" . $countries[0] . "'";

$sqlUniqueRepterek2 = "SELECT DISTINCT country.nicename AS orszag2, airports.name AS repter2
                       FROM country
                       JOIN airports ON airports.countryName = country.nicename
                       WHERE country.nicename IN ('$countriesList') AND country.nicename != '" . $countries[0] . "'";

$resultUniqueRepterek1 = $conn->query($sqlUniqueRepterek1);
$resultUniqueRepterek2 = $conn->query($sqlUniqueRepterek2);

$row1 = $resultUniqueRepterek1->fetch_assoc();
$row2 = $resultUniqueRepterek2->fetch_assoc();

// Megjelenítés
echo "<table border='1'>";
echo "<tr><th>Ország 1</th><th>Repülőtér 1</th><th>Ország 2</th><th>Repülőtér 2</th></tr>";

while ($row1 || $row2) {
    echo "<tr>";
    if ($row1) {
        echo "<td>" . $row1['orszag1'] . "</td>";
        echo "<td>" . $row1['repter1'] . "</td>";
        $row1 = $resultUniqueRepterek1->fetch_assoc(); // Következő sor beolvasása
    } else {
        echo "<td></td><td></td>";
    }

    if ($row2) {
        echo "<td>" . $row2['orszag2'] . "</td>";
        echo "<td>" . $row2['repter2'] . "</td>";
        $row2 = $resultUniqueRepterek2->fetch_assoc(); // Következő sor beolvasása
    } else {
        echo "<td></td><td></td>";
    }
    echo "</tr>";
}

echo "</table>";

// Adatbáziskapcsolat bezárása
$conn->close();
?>