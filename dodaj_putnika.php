<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id_pilota'])) {
    header("Location: login.php");
    exit();
}

$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $pasos = $_POST['pasos'];
    $id_pilota = $_SESSION['id_pilota'];

    $stmt = $conn->prepare("INSERT INTO Putnici (ime, prezime, pasos, id_pilota) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sidi", $ime, $prezime, $pasos, $id_pilota);
    if ($stmt->execute()) {
        $success_message = "Putnik uspješno dodan!";
    } else {
        $success_message = "Greška: " . $stmt->error;
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
    <title>Dodajte putnika</title>
    <link rel="stylesheet" href="dodaj_putnika.css">
</head>
<body>
    <header>
        <div class="button-container">
            <b><a href="index.php">Početna stranica</a></b>
            <b><a href="pregled_putnika.php">Podaci o putnicima</a></b>
           <b> <a href="https://ventura.travel/pregled-aranzmana#arrangements-fragment" class="button">Pregled putovanja</a></b>
        </div>
    </header>
    <div class="container">
        <h2>Dodajte putnika</h2>
        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="dodaj_putnika.php" method="POST">
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="Ime" required>
            <br>
            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" pattern="[A-Za-z0-9]+"  required>
            <br>
            <label for="pasos">Pasoš:</label>
            <input type="text" id="pasos" name="pasos" pattern="[A-Za-z0-9]+"  required>
            <br>
            <input type="submit" value="Dodaj putnika">
        </form>
    </div>
</body>
</html>


