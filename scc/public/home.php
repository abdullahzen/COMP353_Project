<?php
if ($_COOKIE['current_role'] === NULL || $_COOKIE['current_role'] !== $_GET['role']) {
    setcookie('current_role', $_GET['role']);
}
if ($_GET['role'] === NULL) {
    header("location: home.php?role=".$_COOKIE['current_role']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin</title>
</head>
<body>
<div>
<!--    <h2>Admin Profile</h2>-->
    <hr>

    <?php
        include 'header.php';
    ?>

    <div class="content">
<!--        --><?php //var_dump($_COOKIE['user_id'])?>
<!--        --><?php //var_dump($_COOKIE['current_role'])?>
        <h2>Hi, <?php echo $_COOKIE['name'] ?>!</h2>
    </div>
</div>
</body>

</html>