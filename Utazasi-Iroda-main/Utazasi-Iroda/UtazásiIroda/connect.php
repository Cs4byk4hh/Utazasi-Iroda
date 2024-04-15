<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordagain = $_POST['passwordagain'];

    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'teszteles');
    if ($conn->connect_error) {
        die('Connection Failed : '. $conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("insert into registrationtest1(name, email, password, passwordagain) values(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $passwordagain);
        $stmt->execute();
        echo"Registration succesful!";
        $stmt->close();
        $conn->close();
    }

    // Redirect to index.html after successful registration
    header("Location: index.html");
    exit();
?>