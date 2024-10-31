<?php
session_start();

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
    $query = "SELECT id, password FROM staff WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $staff = $result->fetch_assoc();
        // Debugging: Check if password key exists
        if (isset($staff['password'])) {
            // Directly compare passwords
            if ($password === $staff['password']) {
                $_SESSION['user_id'] = $staff['id'];
                header("Location: ../Staffinfo/staffinfo.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Password key not found in the result.";
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
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        
        <div class="login-container">
            
            <form name="form" action="stafflog.php" onsubmit="return isvalid()" method="POST">
                <h3>Staff Login</h3>

                <label>Email: </label>
                <input type="text" name="email" required><br>

                <label>Password: </label>
                <input type="password" id="password" name="password" required><br><br>

                <input type="hidden" name="roll" value="staff">

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
                }
                else if(email.length == ""){
                    alert("Email field is empty!!!");
                    return false;
                }
                else if(password.length == ""){
                    alert("Password field is empty!!!");
                    return false;
                }
            }
        </script>
    </body>
</html>
