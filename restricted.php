<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restricted Page</title>
</head>
<body>
<h1>Welcome to the Restricted Page!</h1>
<p>This page can only be accessed by authenticated users.</p>
</body>
</html>
