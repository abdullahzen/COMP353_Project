<?php

require "../app/operations/eventsCrud.php";
require "../app/operations/crud.php";
include "header.php";

$success = null;

try {
    $result = readSingleEvent("events", "event_ID", $_GET['id']);
    // switch($_COOKIE['current_role']) {
    //     case 'admin':
    //         $result = readSingleEvent("events", "event_ID", $_GET['id']);
    //         break;
        // case 'manager':
        //     $result = readManagedEvents();
        //     break;
        // case 'controller':
        //     $result = readAllEvents();
        //     break;
        // case 'participant':
        //     $result = readParticipatingEvents();
        //     break;
    // }
//    var_dump($result);
?>
<?php
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

if (isset($_POST["submit"])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        delete('events', key($result[0]), $_POST["submit"]);
        $success = "Event successfully deleted";
        ?>
        <script type="text/javascript">
            window.location = "/events.php";
        </script>
        <?php
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php
    if ($result) {
        $result = $result[0];
?>
       <div >
            <form method="post">
                <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                <div align="middle">
<div class="card text-center">
<div class="card-header">
<h3><?php echo $result['name'] ?></h3><br>
  </div>
  <div class="card-body">
    <p class="card-text">
        <b>Location</b><br>
        <?php echo $result['address'] ?><br><br>
        <b>Date</b><br>
        <?php echo $result['date'] ?><br><br>
        <?php if ($_COOKIE['current_role'] === 'admin' || $_COOKIE['current_role'] === 'event_manager'){?>
            <b>Expiration Date</b><br>
            <?php echo $result['expiration_date'];?><br><br>
            <b>Archived</b><br>
            <?php 
            if ($result['status'] === 1) {
                    echo "no";
                } else{
                    echo "yes";
                }
            ?><br><br>
        <?php } ?>
        <b>Price</b><br>
        <?php echo $result['price'] ?> <br>
    </p>
    <a href="#" class="btn btn-primary">Pariticpants</a><br><br>
    <div class="card-footer text-muted">
    <b>Event Managed by <?php readSingle('users', 'user_ID', $result['manager_ID'])[0] ?></b>
</div>
  </div>
                </div>
</div>
</div>
</form>
</div>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>