<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $lozinka = md5($_POST['lozinka']); 

    $stmt = $conn->prepare("SELECT * FROM Pilot WHERE email = ? AND lozinka = ?");
    $stmt->bind_param("ss", $email, $lozinka);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id_pilota'] = $row['id_pilota'];
        header("Location: index2.php");
        exit();
    } else {
        echo "Pogrešna lozinka ili email!";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h2>Prijavite se!</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            <input type="submit" value="Prijavi se">
        </form>
    </div>
</body>
</html>


