<?php
require "../app/operations/auth.php";
require "./bootstrap.php";

isLoggedIn();
if ($_COOKIE['current_role'] !== $_GET['role'] && $_GET['role'] !== NULL) {
    header("location: home.php?role=".$_GET['role']);
}
?>

<head>
  <meta charset="UTF-8">
  <!--    get the style sheet-->
  <link rel="stylesheet" href="css/style.css">

  <!--    added library for home icon-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>SCC</title>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">SCC 2019</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="events.php">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="groups.php">Groups</a>
      </li>
      <?php if ($_COOKIE['isAdmin'] && $_COOKIE['current_role'] === 'admin' ||
                       $_COOKIE['isManager'] && $_COOKIE['current_role'] === 'manager'||
                       $_COOKIE['isController'] && $_COOKIE['current_role'] === 'controller') {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            if ($_COOKIE['isAdmin'] && $_COOKIE['current_role'] === 'admin') {?>
                    <a class='dropdown-item' href='read.php?table=events'>Events</a>
                    <a class='dropdown-item' href='read.php?table=event_organization_participants'>Events Participants</a>
                    <a class='dropdown-item' href='read.php?table=event_groups'>Events Groups</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='read.php?table=groups'>Groups</a>
                    <a class='dropdown-item' href='read.php?table=group_members'>Group Members</a>
                    <a class='dropdown-item' href='read.php?table=group_posts'>Group Posts</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='read.php?table=posts'>Posts</a>
                    <a class='dropdown-item' href='read.php?table=post_comments'>Post Comments</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='read.php?table=users'>Users</a>
                    <a class='dropdown-item' href='read.php?table=user_roles'>User Roles</a>
                    <a class='dropdown-item' href='read.php?table=user_bank_information'>User Bank Information</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='read.php?table=roles'>Roles</a>
                    <a class='dropdown-item' href='read.php?table=bank_information'>Bank Information</a>
                    <a class='dropdown-item' href='read.php?table=organizations'>Organizations</a>      
            <?php } 
            if ($_COOKIE['isManager'] && $_COOKIE['current_role'] === 'manager') { ?>
                    <a class='dropdown-item' href='read.php?table=events'>Events</a>
                    <a class='dropdown-item' href='read.php?table=event_organization_participants'>Events Participants</a>
                    <a class='dropdown-item' href='read.php?table=event_groups'>Events Groups</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='read.php?table=groups'>Groups</a>
                    <a class='dropdown-item' href='read.php?table=group_members'>Group Members</a>
            <?php } 
            if ($_COOKIE['isController'] && $_COOKIE['current_role'] === 'controller') { ?>
                    <a class='dropdown-item' href='read.php?table=events'>Events</a>
            <?php } ?>
        </div>
      </li>
    <?php } ?>

    <?php if ($_COOKIE['isParticipant'] && $_COOKIE['current_role'] === 'participant') {?>
        <li class='nav-item active'>
            <a class='nav-link' href='events.php'>My Events</a>
        </li>
        <li class='nav-item active'>
            <a class='nav-link' href='groups.php'>My Groups</a>
        </li>
        <li class='nav-item active'>
            <a class='nav-link' href='create.php?table=groups'>Create Group</a>
        </li>
        <li class='nav-item active'>
            <a class='nav-link' href='read.php?table=users'>My Profile</a>
        </li>
    <?php } ?>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>