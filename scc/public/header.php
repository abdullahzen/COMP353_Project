<?php
require "../app/operations/auth.php";
isLoggedIn();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--    get the style sheet-->
    <link rel="stylesheet" href="css/style.css">

    <!--    added library for home icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>SCC</title>
</head>
<a href="index.php">Home</a>
<div>
    <h1 style="text-align: center;" >SCC 2019</h1>
    <hr>
    <div class="topnav">
        <!-- we can have elements of the left of the header (insert here)-->
        <div class="topnav-right">
            <a href="user-profile.php"><i class="fa fa-home"></i></a>
            <a href="role-list.php">Switch Access Role</a>|
            <a href="index.php">Log out</a>
        </div>
    </div>
    <hr>

    <!--    TO DO: add if statements according to user role -->
    <div class="row sidenav">
        <ul class="col-3">
            <hr class="fixed-line">
            <li class="welcome_message">Welcome to the SCC System!</li>
            <hr class="fixed-line">
            <?php
                if ($_COOKIE['isAdmin']) {
                    echo "
                        <li class='first-item-on-list'><a href='read.php?table=events'>Manage Events</a></li>
                        <li><a href='read.php?table=roles'>Manage Roles</a></li>
                        <li><a href='read.php?table=users'>Manage Users</a></li>
                        <li><a href='read.php?table=groups'>Manage Groups</a></li>
                        <li><a href='read.php?table=group_members'>Manage Group Members</a></li>
                        <li><a href='read.php?table=posts'>Manage Posts</a></li>
                        <li><a href='read.php?table=group_posts'>Manage Group Posts</a></li>
                        <li><a href='read.php?table=organizations'>Manage Organizations</a></li>
                        <li><a href='read.php?table=post_comments'>Manage Post Comments</a></li>
                        <li><a href='read.php?table=user_roles'>Manage User Roles</a></li>
                        <li><a href='read.php?table=event_groups'>Manage Event Group</a></li>
                        <li><a href='read.php?table=bank_information'>Manage Bank Information</a></li>
                        <li><a href='read.php?table=user_bank_information'>Manage User Bank Information</a></li>
                        <li><a href='read.php?table=event_organization_participants'>Manage Event Organization Participants</a></li>
                    ";
                }
                if ($_COOKIE['isManager']) {
                    echo "
                        ";
                }
                if ($_COOKIE['isController']) {
                    echo "
                        ";
                }
                if ($_COOKIE['isParticipant']) {
                    echo "
                        ";
                }
            ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
</body>

</html>