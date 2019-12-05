<?php
require "../app/operations/auth.php";
isLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Role List</title>
</head>
<body>
<div align="center">
    <h2>Your Access Roles in SCC -- The Share, Contribute and Comment System</h2>
    <hr>
    <div>Choose one of the roles to proceed</div>
    <br>
    <a href="user-profile.php">Administrator</a><br>
    <a href="user-profile.php">Event Manager</a><br>
    <a href="user-profile.php">Controller</a><br>
    <a href="user-profile.php">Event Participant</a><br>
    <a href="logout.php">Logout</a><br>
</body>

</html>