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

require "../app/operations/sendMessage.php";
require "../app/operations/crud.php";

$success = null;

try {
    if ($_COOKIE['user_id']){
        $result = readAll('users');
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
          
        <h2>My Messages</h2>
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
              <a  href="message.php?id=<?php echo escape($result[$index]['user_ID'])?>"
              ><h5 class="mb-1"><?php echo $result[$index]['name'] ?></h5></a>
              <medium>
                  <span class="badge badge-success badge-pill align-right"><?php echo countMessages($_COOKIE['user_id'], $result[$index]['user_ID'])[0]['num'] ?> Messages</span>
                </medium>
              </div>
              <p class="mb-1">
               
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