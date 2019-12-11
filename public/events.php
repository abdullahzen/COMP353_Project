<!-- 
- P2 - Project 2
- Group 15
- Team Member, Student IDs, and Emails:
    Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca

    Kevin LIN, 40002383, email: k_in@encs.concordia.ca

    Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca

    Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
-->

<?php

require "../app/operations/eventsCrud.php";

$success = null;

try {
    $result = readAllEvents();
    $participants_num = getEventParticipantsNumber();
    if ($_COOKIE['current_role'] === 'participant' && $_GET['user_id']){
        $result = readParticipatingEvents($_GET['user_id']);
    }
    if ($_COOKIE['current_role'] === 'manager' && $_GET['user_id']){
        $result = readManagedEvents($_GET['user_id']);
    }


if (isset($_POST["submit"])) {
    try {
        deleteEvent(key($result[0]), $_POST["submit"]);
        $success = "Event successfully deleted";
        var_dump($success);
        if ($_GET['user_id']){
          header('location: events.php?user_id=$_GET["user_id"]');
        } else {
          header('location: events.php');
        }    
    } catch(PDOException $e) {
        $error = "Failed to delete event.";
    }
}
?>
<?php
} catch(PDOException $e) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php
    include "header.php";
?>
<?php
    if (sizeof($result) > 0) {
?>
<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error ?>
  </div>
<?php } ?>
<div class="container">
  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <div class="row">
      <div class="col-10">
          
        <h2><?php if ($_GET['user_id']) {echo "My ";}?>Events</h2>
      </div>
        <div class="col-2">
          <?php if ($_COOKIE['current_role'] !== 'participant' && $_COOKIE['current_role'] !== 'controller'){?>
            <div class="btn btn-secondary " onclick="window.location='create.php?table=events'">Add a new Event
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="list-group col-12">
        <div style="list-style-type:none;">
          <?php
            $index = 0;
            foreach ($result as $key => $value) { ?>
          <li class="list-group-item list-group-item-action flex-column align-items-start" style='border-color:black;'>
              <div class="d-flex w-100 justify-content-between">
              <a  href="event.php?id=<?php echo escape($result[$index]['event_ID'])?>"
              ><h5 class="mb-1"><?php echo $result[$index]['name'] ?></h5></a>
                <medium><?php if ($result[$index]['status'] == 1){?>
                  <span class="badge badge-success badge-pill align-right">Active</span>
                  <?php } else { ?><span class="badge badge-danger badge-pill align-right">Archived</span> <?php } ?>
                        <span
                        class="badge badge-dark badge-pill align-right"><?php echo $participants_num[$index]['participants_num'] ?>
                        participants</span>
                        <?php if ($_COOKIE['current_role'] === 'manager' && $_COOKIE['user_id'] === $result[$index]['manager_ID']){?>
                            <span
                        class="badge badge-info badge-pill align-right">Managing</span>
                        <?php } ?>
                        <?php if (isEventParticipant($_COOKIE['user_id'], $result[$index]['event_ID'])){?>
                            <span
                        class="badge badge-primary badge-pill align-right">Participating</span>
                        <?php } ?>
                </medium>
              </div>
              <p class="mb-1">
                <b>Location</b>: <?php echo $result[$index]['address']; ?><br>
                <b>Date</b>: <?php echo $result[$index]['date']; ?><br>
                <b>Expiration</b>: <?php echo $result[$index]['expiration_date']; ?><br>
                <?php if (($_COOKIE['current_role'] === 'manager' && $result[$index]['manager_ID'] == $_COOKIE['user_id']) || $_COOKIE['current_role'] === 'admin'){?>
                <div class="btn btn-secondary pull-right"
                  onclick="window.location='update.php?table=events&key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]);?>';">
                  Edit</div>
                <button class="btn btn-danger pull-right" style="margin-right: 5px;" type="submit" name="submit"
                  value="<?php echo escape($result[$index][key($result[$index])]); ?>">Delete</button>
                <?php } ?>
                <b>Price</b>: <?php echo $result[$index]['price']; ?>
              </p>
          </li>
          <?php
                $index++;
            }
            ?>
        </div>
      </div>
    </div>
  </form>
</div>
<?php } else { ?>
<blockquote>No results found.</blockquote>
<?php
} ?>