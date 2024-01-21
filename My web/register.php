<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
            background-color: red;
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
    <div class="registration">
        <form method="post" action="">
            <center><h3>Registration Form</h3></center>
            <input type="text" name="fname" id="fname" placeholder="Enter your Firstname" required>
            <input type="text" name="lname" id="lname" placeholder="Enter your Lastname" required>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <select name="specializedIn" id="specializedIn" required>
            <option value="" disabled selected>Select what you are specialized in</option>
            <?php
            $query = "SELECT * FROM illness";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
            <div class="password-container">
                <input type="password" name="psw" id="psw" placeholder="Enter your password" required>
                <span class="toggle-password" onclick="togglePassword('psw')">&#x1F441;</span>
            </div>
            <input type="submit" value="Register">
            Already a member?<a href="login.php">Login</a>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $firstname=$_POST['fname'];
            $lastname=$_POST['lname'];
            $email=$_POST['email'];
            $password=$_POST['psw'];
            $specializedIn=$_POST['specializedIn'];

            $sql="INSERT INTO doctor (firstname,lastname,email,password,specializedIn) values('$firstname','$lastname','$email','$password','$specializedIn')";
            $connect=mysqli_query($conn,$sql);
            if($connect)
            {
                echo "You have successfully registed";
                header("location: Login.php");
            }
            else {
                echo "";
            }
        }
        $conn->close()
         ?>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>
</body>
</html>s