<?php
session_start();
include('connection.php');
if (isset($_SESSION['doctorId'])) {
    $doctorId = $_SESSION['doctorId'];
    $sql = "SELECT * FROM appointment WHERE illness IN (SELECT specializedIn FROM doctor WHERE id = $doctorId)";
$result = $conn->query($sql);
} else {
    echo "Doctor ID not set in the session.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header, footer {
            background-color: #3498db;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            display: flex;
        }

        aside {
            width: 20%;
            background-color: #2c3e50;
            padding: 20px;
            color: white;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Styles for the appointment booking form */
        #book-appointment {
            margin-top: 20px;
        }

        #book-appointment h2 {
            margin-bottom: 10px;
            color: #3498db;
        }

        #book-appointment form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
        }

        #book-appointment label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        #book-appointment input[type="text"],
        #book-appointment input[type="email"],
        #book-appointment input[type="tel"],
        #book-appointment input[type="date"] {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #book-appointment input[type="submit"] {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #book-appointment input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .active {
            background-color: #1a2226;
        }
    </style>
</head>
<body>
    <header>
        <?php
        echo "<h1>".$_SESSION['doctorName']." Appointment Dashboard"."</h1><br>"
        ?>
    </header>

    <div class="container">
        <!-- <aside>
            <h2>Navigation</h2>
            <ul>
                <li><a href="#schedule">Schedule</a></li>
                <li><a href="#patients">Patients</a></li>
                <li><a href="#settings">Booking</a></li>
            </ul>
        </aside> -->

        <main>
            <section id="schedule">
                <h2>Appointment Schedule</h2>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<p>Patient Names: ' . $row['patientNames'] . '</p>';
                        echo '<p>Patient Phone number: ' . $row['patientPhone'] . '</p>';
                        echo '<p>Sex: ' . $row['sex'] . '</p>';
                        echo '<p>Age: ' . $row['age'] . '</p>';
                        echo '<p>Appointment Date: ' . $row['appointmentTime'] . '</p>';
                        echo '<hr>';
                    }
                } else {
                    echo 'No appointments scheduled for this doctor\'s illness.';
                }
                ?>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Appointment Dashboard</p>
    </footer>
</body>
</html>
