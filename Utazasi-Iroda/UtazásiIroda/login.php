<?php
    // Ellenőrizze, hogy a POST kérés elküldődött-e
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fogadja a bejelentkezési adatokat
        $loginName = $_POST['loginName'];
        $loginPassword = $_POST['loginPassword'];

        // Adatbázis kapcsolat létrehozása
        $conn = new mysqli('localhost', 'root', '', 'teszteles');
        if ($conn->connect_error) {
            die('Connection Failed : '. $conn->connect_error);
        }

        // Ellenőrizze, hogy a felhasználó létezik-e a regisztrációban
        $stmt = $conn->prepare("SELECT * FROM registrationtest1 WHERE name = ?");
        $stmt->bind_param("s", $loginName);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // Felhasználó létezik, ellenőrizze a jelszót
            $row = $result->fetch_assoc();
            if ($loginPassword == $row['password']) {
                // Sikeres bejelentkezés
                echo "Sikeres bejelentkezés!";
            } else {
                // Hibás jelszó
                echo "Hibás jelszó!";
            }
        } else {
            // Felhasználó nem található
            echo "Felhasználó nem található!";
        }

        // Bezárjuk az adatbázis kapcsolatot és a lekérdezést
        $stmt->close();
        $conn->close();
    }
?>
