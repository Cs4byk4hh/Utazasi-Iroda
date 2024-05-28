<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("Location: login.html");
}
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo
        "<script> alert('Username or Email Has Already Taken'); </script>";
    }
    else {
        if($password == $confirmpassword){
            $query = "INSERT INTO tb_user VALUES('', '$name', '$username','$email', '$password')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Sikeres regisztráció!'); </script>";
        }
        else {
            echo
            "<script> alert('A jelszavak nem egyeznek!'); </script>";
        }
    }
}
?>
