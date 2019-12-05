<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>SCC</title>
</head>
<!--<body onload=--><?php //session_start()?><!-->-->
<div align="center">
    <h1>SCC 2019 Admin Panel</h1>
    <hr>

<!--    TO DO: add if statements according to user role -->

    <a href="index.php">Home</a>
    <a href="read.php?table=bank_information">Bank Information</a>
    <a href="read.php?table=events">Events</a>
    <a href="read.php?table=event_groups">Event Group</a>
    <a href="read.php?table=event_organization_participants">Event Organization Participants</a>
    <a href="read.php?table=groups">Groups</a>
    <a href="read.php?table=group_members">Group Members</a>
    <a href="read.php?table=group_posts">Group Posts</a>
    <a href="read.php?table=messages">Messages</a>
    <a href="read.php?table=organizations">Organizations</a>
    <a href="read.php?table=posts">Posts</a>
    <a href="read.php?table=post_comments">Post Comments</a>
    <a href="read.php?table=roles">Roles</a>
    <a href="read.php?table=user_bank_information">User Bank Information</a>
    <a href="read.php?table=user_roles">User Roles</a>
    <a href="read.php?table=users">Users</a>
    <a href="index.php">
        <?php
        session_destroy();
        ?>
        Log out</a>
</div>

</div>
</body>

</html>