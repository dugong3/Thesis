<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee = $_POST['employee'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];

    // Include database connection
    include '../connection.php';

    $sql = "INSERT INTO schedule (employee, time_in, time_out) VALUES ('$employee', '$time_in', '$time_out')";
    if ($conn->query($sql) === TRUE) {
        echo "New schedule entry created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Schedule Entry</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="content">
        <br>
        <br>
        <h2>Schedule Entry</h2>
        <form method="post" action="">
            Employee: <input type="text" name="employee" required><br>
            Time In: <input type="time" name="time_in" required><br>
            Time Out: <input type="time" name="time_out" required><br>
            <input type="submit" value="Submit">
        </form>
        <br>
        <h3>Schedule Entries</h3>
        <table>
            <tr>
                <th>Employee</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
            <?php
            include '../connection.php';
            $result = $conn->query("SELECT * FROM schedule");
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['employee']}</td><td>{$row['time_in']}</td><td>{$row['time_out']}</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
