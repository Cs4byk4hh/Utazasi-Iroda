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
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Táblázat Stílus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <table border="1">
        <tr>
            <th>Ország 1</th>
            <th>Repülőtér 1</th>
            <th>Kiválasztás</th>
            <th>Ország 2</th>
            <th>Repülőtér 2</th>
            <th>Kiválasztás</th>
        </tr>
        <?php
        while ($row1 || $row2) {
            echo "<tr>";
            if ($row1) {
                echo "<td class='orszag'>" . htmlspecialchars($row1['orszag1']) . "</td>";
                echo "<td class='repter'>" . htmlspecialchars($row1['repter1']) . "</td>";
                echo "<td><button class='select-button' onclick=\"selectCountry1('" . htmlspecialchars($row1['orszag1']) . "', '" . htmlspecialchars($row1['repter1']) . "')\">Kiválaszt</button></td>";
                $row1 = $resultUniqueRepterek1->fetch_assoc(); // Következő sor beolvasása
            } else {
                echo "<td></td><td></td><td></td>";
            }
            
            if ($row2) {
                echo "<td class='orszag'>" . htmlspecialchars($row2['orszag2']) . "</td>";
                echo "<td class='repter'>" . htmlspecialchars($row2['repter2']) . "</td>";
                echo "<td><button class='select-button' onclick=\"selectCountry2('" . htmlspecialchars($row2['orszag2']) . "', '" . htmlspecialchars($row2['repter2']) . "')\">Kiválaszt</button></td>";
                $row2 = $resultUniqueRepterek2->fetch_assoc(); // Következő sor beolvasása
            } else {
                echo "<td></td><td></td><td></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <script>
    let selectedCountry1 = null;
    let selectedRepter1 = null;
    let selectedCountry2 = null;
    let selectedRepter2 = null;

    function selectCountry1(orszag1, repter1) {
        selectedCountry1 = orszag1;
        selectedRepter1 = repter1;
        checkSelection();
    }

    function selectCountry2(orszag2, repter2) {
        selectedCountry2 = orszag2;
        selectedRepter2 = repter2;
        checkSelection();
    }

    function checkSelection() {
        if (selectedCountry1 && selectedRepter1 && selectedCountry2 && selectedRepter2) {
            window.location.href = "szamla.html?orszag1=" + encodeURIComponent(selectedCountry1) + "&repter1=" + encodeURIComponent(selectedRepter1) + "&orszag2=" + encodeURIComponent(selectedCountry2) + "&repter2=" + encodeURIComponent(selectedRepter2);
        }
    }
    </script>
</body>
</html>
<?php
// Adatbáziskapcsolat bezárása
$conn->close();
?>
