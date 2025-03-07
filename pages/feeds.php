<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = $_POST['product'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $sack = $_POST['sack'];

    // Include database connection
    include '../connection.php';

    $sql = "INSERT INTO feeds (product, date, time, sack) VALUES ('$product', '$date', '$time', '$sack')";
    if ($conn->query($sql) === TRUE) {
        echo "New feed entry created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feeds Entry</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="content">
        <br>
        <br>
        <h2>Feeds Entry</h2>
        <form method="post" action="">
            Product: <input type="text" name="product" required><br>
            Date: <input type="date" name="date" required><br>
            Time: <input type="time" name="time" required><br>
            Sack: <input type="number" name="sack" required><br>
            <input type="submit" value="Submit">
        </form>
        <br>
        <h3>Feed Entries</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Date</th>
                <th>Time</th>
                <th>Sack</th>
            </tr>
            <?php
            include '../connection.php';
            $result = $conn->query("SELECT * FROM feeds");
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['product']}</td><td>{$row['date']}</td><td>{$row['time']}</td><td>{$row['sack']}</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
