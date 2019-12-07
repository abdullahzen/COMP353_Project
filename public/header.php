<?php
require "../app/operations/auth.php";
isLoggedIn();
if ($_COOKIE['current_role'] !== $_GET['role'] && $_GET['role'] !== NULL) {
    header("location: home.php?role=".$_GET['role']);
}
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
    <h1 class="center addMargin" >SCC 2019</h1>
    <hr>
    <div class="topnav">
        <!-- we can have elements of the left of the header (insert here)-->
        <div class="topnav-right">
            <a href="home.php"><i class="fa fa-home"></i></a>
            <a href="role-list.php">Switch Access Role</a>|
            <a href="logout.php">Log out</a>
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
                if ($_COOKIE['isAdmin'] && $_COOKIE['current_role'] === 'admin') {
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
                if ($_COOKIE['isManager'] && $_COOKIE['current_role'] === 'manager') {
                    echo "
                        <li class='first-item-on-list'><a href='home.php'>Home</a></li>
                        <li><a href='events.php'>My Managed Events</a></li>
                        <li><a href='home.php'>My Managed Groups [NOT DONE]</a></li>
                        ";
                }
                if ($_COOKIE['isController'] && $_COOKIE['current_role'] === 'controller') {
                    echo "
                        <li class='first-item-on-list'><a href='home.php'>Home [NOT STARTED]</a></li>
                        <li><a href='index.php'>Controller Action 1</a></li>
                        <li><a href='index.php'>Controller Action 2</a></li>
                        ";
                }
                if ($_COOKIE['isParticipant'] && $_COOKIE['current_role'] === 'participant') {
                    echo "
                        <li class='first-item-on-list'><a href='home.php'>Home [NEED TO DISPLAY POSTS]</a></li>
                        <li><a href='home.php'>My Groups [NOT DONE]</a></li>
                        <li><a href='events.php'>My Events</a></li>
                        <li><a href='home.php'>Create Group [NOT DONE]</a></li>
                        <li><a href='create.php?table=events'>Create Event</a></li>
                        ";
                }
            ?>
        </ul>
    </div>
</div>
</body>

</html>