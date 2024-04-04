<?php
session_start();


include 'dbinfo.php';


$con = mysqli_connect($host, $username, $password, $dbname);


if (!$con) {
    die("Connection failed!" . mysqli_connect_error());
}


$login_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            
            $_SESSION['username'] = $username;
            header("Location: admin-index.php");
            exit();;
        } else {
            
            $login_message = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url('back_image.png'); /* Background image */
        background-size: cover; /* Cover the entire viewport */
        background-position: center; /* Center the background image */
        font-family: Arial, sans-serif; /* Set a default font */
    }
    .login-box {
        text-align: center;
        border: 2px solid #ccc;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* White background with some transparency */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Drop shadow effect */
        max-width: 400px; /* Limit the width of the login box */
        width: 80%; /* Adjust width for smaller screens */
    }
    h2 {
        margin-top: 0; /* Remove default margin for heading */
        color: #333; /* Dark gray text color */
    }
    label {
        display: block;
        margin-bottom: 5px; /* Add spacing between labels */
        color: #666; /* Gray text color for labels */
        font-weight: bold; /* Make labels bold */
    }
    input[type="text"],
    input[type="password"] {
        width: 100%; /* Full width input fields */
        padding: 8px; /* Add padding */
        margin-bottom: 15px; /* Add spacing between input fields */
        border: 1px solid #ccc; /* Add border */
        border-radius: 5px; /* Rounded corners */
        box-sizing: border-box; /* Include padding and border in the element's total width */
    }
    input[type="submit"] {
        width: 100%; /* Full width submit button */
        padding: 10px; /* Add padding */
        border: none; /* Remove default border */
        background-color: #007bff; /* Blue submit button */
        color: #fff; /* White text color */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Change cursor on hover */
        transition: background-color 0.3s; /* Smooth transition for background color */
    }
    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
    .error-message {
        color: #ff0000; /* Red text color for error message */
        margin-top: 10px; /* Add spacing above error message */
    }
</style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <div class="error-message"><?php echo $login_message; ?></div>
</div>

</body>
</html>
