<?php
include('Connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link href="./styles/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="./styles/appoit.css">
</head>
<body>
    <?php
    include("./header.html");
    ?>
<section id="settings" style="margin-top:10rem";>
<form action="" method="POST">
    <h1>Book Appointment </h1>
        <input type="text" id="name" name="name" placeholder="Name" required><br>

        <input type="tel" id="phone" name="phone" placeholder="Phone" required><br>

        <input type="radio" id="male" name="sex" value="Male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="sex" value="Female" required>
        <label for="female">Female</label>
        <input type="radio" id="other" name="sex" value="Other" required>
        <label for="other">Other</label><br>

        <input type="number" id="age" name="age" placeholder="Age" required><br>

        <select name="illness" id="illness" required>
            <option value="" disabled selected>Select your illness</option>
            <?php
            $result = $conn->query("SELECT * FROM illness");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br>

        <input type="datetime-local" id="appointmentTime" name="appointmentTime" placeholder="Appointment Date" required><br>

        <button type="submit">Book Appointment</button>
    </form>
</section>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $illness = $_POST['illness'];
    $appointmentTime = $_POST['appointmentTime'];

    $sql = "INSERT INTO appointment (patientNames, patientPhone, sex, age, illness, appointmentTime) 
            VALUES ('$name', '$phone', '$sex', '$age', '$illness', '$appointmentTime')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
