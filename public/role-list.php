<?php
require "../app/operations/auth.php";
require "../app/operations/crud.php";
isLoggedIn();

//var_dump($_COOKIE);
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
    <div class="choose_role">Choose one of the roles to proceed</div>
    <br>
    <?php
        if ($_COOKIE['isAdmin']) {
            echo "<a class='role_list_option <?php ($_COOKIE[isAdmin])?
                        display : hide} ?>' href='home.php?role=admin'>Administrator</a><br>";
        }
        if ($_COOKIE['isManager']) {
            echo "<a class='role_list_option <?php ($_COOKIE[isManager] )?
                        display : hide} ?>' href='home.php?role=manager'>Event Manager</a><br>";
        }
        if ($_COOKIE['isController']) {
            echo "<a class='role_list_option <?php ($_COOKIE[isController] )?
                        display : hide} ?>' href='home.php?role=controller'>Controller</a><br>";
        }
        if ($_COOKIE['isParticipant']) {
            echo "<a class='role_list_option <?php ($_COOKIE[isParticipant] )?
                        display : hide} ?>'
                        href='home.php?role=participant'>Event Participant</a><br>";
        }
    ?>
    <a class="log_out_button"  href="logout.php">Logout</a><br>
</body>

</html>
