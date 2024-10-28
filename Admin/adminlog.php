<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query
    $query = "SELECT id, password FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Directly compare passwords
        if ($password === $admin['password']) {
            $_SESSION['user_id'] = $admin['id'];
            // Redirect to admin_info.php
            header("Location: admin_info.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
    <div class="login-container">
        <form name="form" action="adminlog.php" onsubmit="return isvalid()" method="POST">
            <h3>Admin Login</h3>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            <label>Email: </label>
            <input type="email" name="email" required><br>
            <label>Password: </label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="btn" value="Login" name="submit"/>
        </form>
    </div>
    <script>
        function isvalid(){
            var email = document.form.email.value;
            var password = document.form.password.value;
            if(email.length == "" && password.length == ""){
                alert("Email and password fields are empty!!!");
                return false;
            } else if(email.length == ""){
                alert("Email field is empty!!!");
                return false;
            } else if(password.length == ""){
                alert("Password field is empty!!!");
                return false;
            }
        }
    </script>
</body>
</html>
