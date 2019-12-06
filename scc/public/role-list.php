<?php
//require "sign-in.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Role List</title>
</head>
<body onload=<?php session_start()?>>
<div align="center">
    <h2>Your Access Roles in SCC -- The Share, Contribute and Comment System</h2>
    <hr>
    <div class="choose_role">Choose one of the roles to proceed</div>
    <br>
    <a href="user-profile.php">Administrator</a><br>
    <a href="user-profile.php">Event Manager</a><br>
    <a href="user-profile.php">Controller</a><br>
    <a href="user-profile.php">Event Participant</a><br>
    <a href="index.php">
        <?php
        session_destroy();
        ?>
        Log out</a>
</div>
</body>

</html>