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

    <div class="content">
<!--        --><?php //var_dump($_COOKIE['user_id'])?>
<!--        --><?php //var_dump($_COOKIE['current_role'])?>
        <h2>Hi, <?php echo $_COOKIE['name'] ?>!</h2>
        <hr>
        <?php if ($_COOKIE['isAdmin']) {
            echo "As an admin, you have the privilege to perform the following tasks:\r\n
                - Manage Events (create/ delete/ edit events and assign events managers)\r\n
                - Manage Roles (assign roles to members)\r\n
                - Manage Users (create, edit, delete)\r\n
                - Manage Groups (create, edit, delete)\r\n
                - Manage Posts (create, edit, delete)\r\n
                - Send Messages \r\n
        ";}
        if ($_COOKIE['isManager']) {
            echo "As an Event Manager, you have the privilege to perform the following tasks:\r\n
                - Manage Events (create/ delete/ edit events and assign events managers)\r\n
                - Manage Join-Group requests \r\n
                - Send Messages\r\n
                ";
        }
        if ($_COOKIE['isController']) {
            echo "As an Controller, you have the privilege to perform the following tasks:\r\n
                - Send Messages\r\n
";
        }
        if ($_COOKIE['isParticipant']) {
            echo "As an Event Participant, you have the privilege to perform the following tasks:\r\n
            - Request to join an event
            - Send Messages\r\n";
        }

        ?>


    </div>
</div>
</body>

</html>