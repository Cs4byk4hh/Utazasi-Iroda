<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
    $row = mysqli_fetch_array($result);
}
else{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="Hu" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>Welcome <?php echo $row["name"]; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>