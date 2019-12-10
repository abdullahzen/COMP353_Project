<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca-->

<?php
if ($_COOKIE['current_role'] === NULL || $_COOKIE['current_role'] !== $_GET['role']) {
    setcookie('current_role', $_GET['role']);
}
if ($_GET['role'] === NULL) {
    $curr_role = $_COOKIE['current_role'];
    echo "<script>setTimeout(function(){
        window.location.href='home.php?role=$curr_role';
        }, 0)</script>";
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

    <div class="container">
<!--        --><?php //var_dump($_COOKIE['user_id'])?>
<!--        --><?php //var_dump($_COOKIE['current_role'])?>
        <h2>Hi, <?php echo $_COOKIE['name'] ?>!</h2>
        <hr>
        <?php if ($_COOKIE['isAdmin']) {
        echo "
                <p><h4>As an admin, you have the privilege to perform the following tasks:</h4><br>
                       <ul>
                           <li>Manage Events (view/ create/ delete/ edit events and assign events managers)</li>
                           <li>Manage Users (view/ create, edit, delete)</li>
                           <li>Manage Posts (view/ create, edit, delete)</li>
                           <li>Manage Roles (view/ assign roles to members)</li>
                           <li>Manage Groups (view/ create, edit, delete)</li>
                           <li>Request to join an event</li>
                           <li>Send Messages</li>
                        </ul> 
                </p><br>";}
        ?>

        <?php if ($_COOKIE['isManager']) {
            echo "<p><h4>As an Event Manager, you have the privilege to perform the following tasks:</h4><br>
                       <ul>
                           <li>Manage Events (view/ create/ delete/ edit events and assign events managers)</li>
                           <li>Add members to groups/events</li>
                           <li>Manage Join-Group requests</li>
                           <li>Request to join an event</li>
                           <li>Send Messages</li>
                        </ul> 
                </p><br>";
        }
        ?>

        <?php if ($_COOKIE['isController']) {

            echo "
                <p><h4>As a Controller, you have the privilege to perform the following tasks:</h4><br>
                       <ul>
                           <li>View Events</li>
                           <li>View Groups</li>
                           <li>Set Event Prices</li>
                           <li>Send Messages</li>
                      
                        </ul> 
                </p>";
        }
        ?>
        <br>
        <?php if ($_COOKIE['isParticipant']) {

            echo "
                <p><h4>As an Event Participant, you have the privilege to perform the following tasks:</h4><br>
                       <ul>
                           <li>View Events you are a participant of</li>
                           <li>View groups you are a member of</li>
                           <li>Request to join an event</li>
                           <li>Send Messages</li>
                        </ul> 
                </p>";

        }

        ?>


    </div>
</div>
</body>

</html>