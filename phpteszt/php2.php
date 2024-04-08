
<?php
//Szortírozó rendszer

$servername = "localhost";
$dbname = "utazasiiroda";

$input1 = $_GET['input1'];
$input2 = $_GET['input2'];

$conn = new mysqli($servername, "root", "", $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

$sql = "SELECT nicename FROM country WHERE nicename LIKE '%$input1%' OR nicename LIKE '%$input2%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["nicename"] . "<br>";
    }
} else {
    echo "Nincsenek találatok";
}
$conn->close();
?>