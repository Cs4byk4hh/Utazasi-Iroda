<?php
//Megjelenítőrendszer
        $servername = "localhost"; // Adatbázis szerver neve (általában localhost)
        $dbname = "utazasiiroda"; // Adatbázis neve

        // Kapcsolat létrehozása
        $conn = new mysqli($servername, "root", "", $dbname);

        // Kapcsolat ellenőrzése
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }

        // SQL lekérdezés az országokhoz
        $sql = "SELECT nicename FROM country";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Országok megjelenítése
            while($row = $result->fetch_assoc()) {
                echo $row["nicename"] . "<br>";
            }
        } else {
            echo "Nincsenek eredmények";
        }
        $conn->close();
?>