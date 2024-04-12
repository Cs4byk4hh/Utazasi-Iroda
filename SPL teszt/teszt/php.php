<?php
//Szortírozó rendszer

$servername = "localhost";
$dbname = "country";

$input1 = isset($_GET['input1']) ? $_GET['input1'] : '';
$input2 = isset($_GET['input2']) ? $_GET['input2'] : '';

$conn = new mysqli($servername, "root", "", $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

$sql = "SELECT nicename FROM country WHERE nicename LIKE '%$input1%' OR nicename LIKE '%$input2%'";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["nicename"] . "<br>";
        }
    } else {
        echo "Nincsenek találatok";
    }
} else {
    echo "Hiba a lekérdezésben: " . $conn->error;
}

$conn->close();
?>

