<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id_pilota'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM Putnici";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podaci o putnicima</title>
    <link rel="stylesheet" href="pregled_putnika.css">
</head>
<body>
    <header>
        <div class="header-buttons">
            <a href="index.php">Početna stranica</a>
            <a href="dodaj_putnika.php">Dodaj putnika</a>
            <a href="https://ventura.travel/pregled-aranzmana#arrangements-fragment" class="button">Pregled putovanja</a>
        </div>
        <h2>Podaci o putnicima</h2>
    </header>
    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Pasoš</th>
                        <th>Broj leta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_putnika']); ?></td>
                            <td><?php echo htmlspecialchars($row['ime']); ?></td>
                            <td><?php echo htmlspecialchars($row['prezime']); ?></td>
                            <td><?php echo htmlspecialchars($row['pasos']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_pilota']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nema putnika.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
