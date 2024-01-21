my.html
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
        <h1>Appointment Dashboard</h1><br>
        <?php 
        $firstName=$_GET['fname'];
        echo $firstName;
        ?>
    </header>

    <div class="container">
        <aside>
            <h2>Navigation</h2>
            <ul>
                <li><a href="#schedule">Schedule</a></li>
                <li><a href="#patients">Patients</a></li>
                <li><a href="#settings">Settings</a></li>
            </ul>
        </aside>

        <main>
            <section id="schedule">
                <h2>Appointment Schedule</h2>
                <?php
                // Assuming you have a MySQL database setup in XAMPP
                INCLUDE('Connection.php');
                $sql = "SELECT * FROM appointments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<p>Name: ' . $row['name'] . '</p>';
                        echo '<p>Email: ' . $row['email'] . '</p>';
                        echo '<p>Phone: ' . $row['phone'] . '</p>';
                        echo '<p>Appointment Date: ' . $row['appointment_date'] . '</p>';
                        echo '<hr>';
                    }
                } else {
                    echo 'No appointments scheduled.';
                }

                $conn->close();
                ?>
            </section>

            <section id="patients">
                <h2>Patients List</h2>
                <!-- Display patients list here -->
            </section>

            <section id="settings">
                <h2>Settings</h2>
                <!-- Display settings options here -->
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Appointment Dashboard</p>
    </footer>

    <script>
        // Get menu items and content sections
        var menuItems = document.querySelectorAll('aside ul li');
        var contentSections = document.querySelectorAll('main section');

        // Add click event listener to each menu item
        menuItems.forEach(function (menuItem, index) {
            menuItem.addEventListener('click', function () {
                // Remove active class from```html
                menuItems.forEach(function (item) {
                    item.classList.remove('active');
                });
                contentSections.forEach(function (section) {
                    section.style.display = 'none';
                });

                // Add active class to the clicked menu item
                menuItem.classList.add('active');

                // Display the corresponding content section
                contentSections[index].style.display = 'block';
            });
        });
    </script>
    <?php
    // Assuming you have a MySQL database setup in XAMPP
    INCLUDE('Connection.php');
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointmentDate = $_POST['appointment_date'];
    
    
    // Insert form data into the database
    $sql = "INSERT INTO bookappointment(Name, Email, Phone, AppointmentDate) VALUES ('$name', '$email', '$phone', '$appointmentDate')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    }
    $conn->close();
    ?>
</body>
</html>




