<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>SCC</title>
</head>
<body onload=<?php session_start()?>>
<div>
    <h1 align="centre">SCC 2019 Admin Panel</h1>
    <hr>
        <!--    TO DO: add if statements according to user role -->
    <div class="sidenav">
        <ul al>
            <li><a href="index.php">Home</a></li>
            <li><a href="read.php?table=bank_information">Bank Information</a></li>
            <li><a href="read.php?table=events">Events</a></li>
            <li><a href="read.php?table=event_groups">Event Group</a></li>
            <li><a href="read.php?table=event_organization_participants">Event Organization Participants</a></li>
            <li><a href="read.php?table=groups">Groups</a></li>
            <li><a href="read.php?table=group_members">Group Members</a></li>
            <li><a href="read.php?table=group_posts">Group Posts</a></li>
            <li><a href="read.php?table=messages">Messages</a></li>
            <li><a href="read.php?table=organizations">Organizations</a></li>
            <li><a href="read.php?table=posts">Posts</a></li>
            <li><a href="read.php?table=post_comments">Post Comments</a></li>
            <li><a href="read.php?table=roles">Roles</a></li>
            <li><a href="read.php?table=user_bank_information">User Bank Information</a></li>
            <li><a href="read.php?table=user_roles">User Roles</a></li>
            <li><a href="read.php?table=users">Users</a></li>
            <li><a href="index.php">
                    <?php
                    session_destroy();
                    ?>
                    Log out</a>
            </li>


        </ul>
    </div>

</div>

</div>
</body>

</html>