<?php
if ($_COOKIE['current_role'] === NULL || $_COOKIE['current_role'] !== $_GET['role']) {
    setcookie('current_role', $_GET['role']);
}
if ($_GET['role'] === NULL) {
    header("location: home.php?role=".$_COOKIE['current_role']);
}
?>
 <?php
        include 'header.php';
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin</title>
</head>
<body>
<div>
<!--    <h2>Admin Profile</h2>-->
    <hr>

    <div>
<!--        --><?php //var_dump($_COOKIE['user_id'])?>
<!--        --><?php //var_dump($_COOKIE['current_role'])?>
        <h2>Hi, <?php echo $_COOKIE['name'] ?>!</h2>
        <hr>
        <?php if ($_COOKIE['isAdmin']) {
            echo "As an admin, you have the privilege to perform the following tasks:";
               echo "\n- Manage Events (view/ create/ delete/ edit events and assign events managers)";
               echo "\n- Manage Roles (view/ assign roles to members)";
               echo "\n- Manage Users (view/ create, edit, delete)";
               echo "\n- Manage Groups (view/ create, edit, delete)";
               echo "\n- Manage Posts (view/ create, edit, delete)";
               echo "\n- Send Messages";}
        ?>
        <br><br>
        <?php if ($_COOKIE['isManager']) {
            echo "\n As an Event Manager, you have the privilege to perform the following tasks:";
                echo "\n- Manage Events (view/ create/ delete/ edit events and assign events managers)";
                echo "\n- Manage Join-Group requests";
                echo "\n- Send Messages\n";
        }
        ?>
        <br><br>
        <?php if ($_COOKIE['isController']) {
            echo "\n As an Controller, you have the privilege to perform the following tasks:
                \n - Set Event Prices
                \n - Send Messages\r\n";
        }
        ?>
        <br><br>
        <?php if ($_COOKIE['isParticipant']) {
            echo "\n As an Event Participant, you have the privilege to perform the following tasks:
            \n- View Events you are a participant of
            \n- Request to join an event
            \n- Send Messages\r\n";
        }

        ?>


    </div>
</div>
</body>

</html>