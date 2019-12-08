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
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        deleteEvent(key($result[0]), $_POST["submit"]);
        $success = "event successfully deleted";
        if ($_GET['user_id']){
          header('location: events.php?user_id=$_GET["user_id"]');
        } else {
          header('location: events.php');
        }    
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php
    include "header.php";
?>
<?php
    if (sizeof($result) > 0) {
?>
<div class="container">
  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <div class="row">
      <div class="col-10">
          
        <h2><?php if ($_GET['user_id']) {echo "My ";}?>Events</h2>
      </div>
        <div class="col-2">
        <div class="btn btn-secondary " onclick="window.location='create.php?table=events'">Add a new Event
        </div>
      </div>
    </div>
    <div class="row">
      <div class="list-group col-12">
        <div style="list-style-type:none;">
          <?php
            $index = 0;
            foreach ($result as $key => $value) { ?>
          <li>
            <a style='border-color:black;' href="event.php?id=<?php echo escape($result[$index]['event_ID'])?>"
              class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $result[$index]['name'] ?></h5>
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
                </medium>
              </div>
              <p class="mb-1">
                <b>Location</b>: <?php echo $result[$index]['address']; ?><br>
                <b>Date</b>: <?php echo $result[$index]['date']; ?><br>
                <b>Expiration</b>: <?php echo $result[$index]['expiration_date']; ?><br>
                <div class="btn btn-secondary pull-right"
                  onclick="window.location='update.php?table=events&key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]);?>';">
                  Edit</div>
                <button class="btn btn-danger pull-right" style="margin-right: 5px;" type="submit" name="submit"
                  value="<?php echo escape($result[$index][key($result[$index])]); ?>">Delete</button>
                <b>Price</b>: <?php echo $result[$index]['price']; ?>
              </p>
            </a>
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