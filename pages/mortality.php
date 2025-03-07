<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $deaths = $_POST['deaths'];
    $maturity = $_POST['maturity'];

    // Include database connection
    include '../connection.php';

    $sql = "INSERT INTO mortality (date, time, deaths, maturity) VALUES ('$date', '$time', '$deaths', '$maturity')";
    if ($conn->query($sql) === TRUE) {
        echo "New mortality entry created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mortality Entry</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="content">
        <br>
        <br>
        <h2>Mortality Entry</h2>
        <form method="post" action="">
            Date: <input type="date" name="date" required><br>
            Time: <input type="time" name="time" required><br>
            Deaths: <input type="number" name="deaths" required><br>
            Maturity: 
            <select name="maturity" required>
                <option value="Chick">Chick</option>
                <option value="Grower">Grower</option>
                <option value="Adult">Adult</option>
            </select><br>
            <input type="submit" value="Submit">
        </form>
        <br>
        <h3>Mortality Entries</h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Deaths</th>
                <th>Maturity</th>
            </tr>
            <?php
            include '../connection.php';
            $result = $conn->query("SELECT * FROM mortality");
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['date']}</td><td>{$row['time']}</td><td>{$row['deaths']}</td><td>{$row['maturity']}</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
