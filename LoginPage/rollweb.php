<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="roleForm">
        <input type="hidden" id="action" name="action" value="">
            <button type="button" id="nextButton" onclick="location.href='doctorlog.php'">Doctor</button>
            <br>
            <button type="button" id="nextButton" onclick="location.href='stafflog.php'">Staff</button>
            <br>
            <button type="button" id="nextButton" onclick="location.href='../Admin/adminlog.php'">Admin</button>
        </form>
        
</body>
</html>