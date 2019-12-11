<?php
require "../app/operations/auth.php";
require "./bootstrap.php";

// <!-- 
// - P2 - Project 2
// - Group 15
// - Team Member, Student IDs, and Emails:
//     Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca
//
//     Kevin LIN, 40002383, email: k_in@encs.concordia.ca
//
//     Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca
//
//     Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
// -->

isLoggedIn();
if ($_COOKIE['current_role'] !== $_GET['role'] && ($_GET['role'] != "" || $_GET['role'] != NULL)) {
  $role = $_GET['role'];
  echo "<script>setTimeout(function(){
    window.location.href='home.php?role=$role';
    }, 0)</script>";
} 
?>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154376590-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154376590-1');
</script>
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

    <?php if ($_COOKIE['isParticipant'] && $_COOKIE['current_role'] === 'participant' || $_COOKIE['isManager'] && $_COOKIE['current_role'] === 'manager') {?>
        <li class='nav-item '>
            <a class='nav-link' href='events.php?user_id=<?php echo $_COOKIE['user_id']?>'>My Events</a>
        </li>
        <li class='nav-item '>
            <a class='nav-link' href='groups.php?user_id=<?php echo $_COOKIE['user_id']?>'>My Groups</a>
        </li>
    <?php } ?>

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

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Create
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            if ($_COOKIE['isAdmin'] && $_COOKIE['current_role'] === 'admin') {?>
                    <a class='dropdown-item' href='create.php?table=events'>New Event</a>
                    <a class='dropdown-item' href='create.php?table=event_organization_participants'>New Event Participant</a>
                    <a class='dropdown-item' href='create.php?table=event_groups'>New Events Group</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=groups'>New Group</a>
                    <a class='dropdown-item' href='create.php?table=group_members'>New Group Member</a>
                    <a class='dropdown-item' href='create.php?table=group_posts'>New Group Posts</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=posts'>New Post</a>
                    <a class='dropdown-item' href='create.php?table=post_comments'>New Post Comment</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=users'>New User</a>
                    <a class='dropdown-item' href='create.php?table=user_roles'>New User Role</a>
                    <a class='dropdown-item' href='create.php?table=user_bank_information'>New User Bank Information</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=roles'>New Role</a>
                    <a class='dropdown-item' href='create.php?table=bank_information'>New Bank Information</a>
                    <a class='dropdown-item' href='create.php?table=organizations'>New Organization</a>      
            <?php } 
            if ($_COOKIE['isManager'] && $_COOKIE['current_role'] === 'manager') { ?>
                    <a class='dropdown-item' href='create.php?table=events'>New Event</a>
                    <a class='dropdown-item' href='create.php?table=event_organization_participants'>New Events Participant</a>
                    <a class='dropdown-item' href='create.php?table=event_groups'>New Events Group</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=groups'>New Group</a>
                    <a class='dropdown-item' href='create.php?table=group_members'>New Group Member</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='create.php?table=users'>New User for an Event</a>
            <?php } 
            if ($_COOKIE['isParticipant'] && $_COOKIE['current_role'] === 'participant') { ?>
                    <a class='dropdown-item' href='create.php?table=groups'>New Group</a>
            <?php } ?>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav">
    <li class='nav-item'>
              <a class='nav-link' href='messages.php'>My Messages</a>
      </li>
      <li class='nav-item'>
              <a class='nav-link' href='user.php?id=<?php echo $_COOKIE['user_id'] ?>'>My Profile</a>
      </li>
      <li class='nav-item'>
          <a class='nav-link' href='role-list.php'>Switch Access Role</a>
      </li>
      <li class='nav-item'>
          <a class='nav-link' href='logout.php'>Log out</a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>