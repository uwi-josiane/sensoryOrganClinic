
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="./styles/style.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 2em;
            width: 300px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h3 {
            margin-bottom: 20px;
            color: #333;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #55efc4;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2d4373;
        }

        .password-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        #psw, #psw1 {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
include("./header.html")
?>
<?php
include('connection.php');

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $sql = "SELECT * FROM doctor WHERE email='$email' AND Password='$password'";
    $connect = mysqli_query($conn, $sql);

    if (mysqli_num_rows($connect) > 0) {
        $row = mysqli_fetch_assoc($connect);
        session_start();
        $_SESSION['doctorId'] = $row['id'];
        $_SESSION['doctorName'] = $row['firstname'];
        $message = "Login successful!";
        header("location: dashbapp.php");
        exit();
    } else {
        $message = "Invalid credentials. Please try again.";
    }
}

$conn->close();
?>

<div class="registration">
    <?php if (!empty($message)) : ?>
        <script>
            alert("<?php echo $message; ?>");
        </script>
    <?php endif; ?>

    <form method="post" action="">
        <center><h3>Login Form</h3></center>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <div class="password-container">
            <input type="password" name="psw" id="psw" placeholder="Enter your password" required>
            <span class="toggle-password" onclick="togglePassword('psw')">&#x1F441;</span>
        </div>
        <input type="submit" value="Login">
            Not a member yet?<a href="register.php" style="color:#55efc4;text-decoration:none"> Register</a>
    </form>
</div>

</body>
</html>
