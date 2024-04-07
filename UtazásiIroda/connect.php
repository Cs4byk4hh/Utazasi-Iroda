<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'registrationtest');
    if ($conn->connect_error) {
        die('Connection Failed : '. $conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("insert into teszteles(name, email, password) values(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        echo"Registration succesful!";
        $stmt->close();
        $conn->close();
    }

    // Redirect to index.html after successful registration
    header("Location: index.html");
    exit();
?>