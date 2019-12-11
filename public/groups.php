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

require "../app/operations/groupsCrud.php";
require "../app/operations/crud.php";
include "header.php";

$success = null;
$error = null;

try {
    $result = readAllGroups();
    $members_num = getGoupsMembersNumber();
    if ($_GET['user_id']){
        $result = readGroupsMemberOf($_GET['user_id']);
    }

if (isset($_POST["submit"])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        deleteGroup(key($result[0]), $_POST["submit"]);
        $success = "group successfully deleted";
        $result = readAllGroups();
        $members_num = getGoupsMembersNumber();
        if ($_COOKIE['current_role'] === 'participant' && $_GET['user_id']){
            $result = readGroupsMemberOf($_GET['user_id']);
        }
        if ($_COOKIE['current_role'] === 'manager' && $_GET['user_id']){
            $result = readManagedGroups($_GET['user_id']);
        }
        if ($_GET['user_id']){
          $id = $_GET['user_id'];
          echo "<script>setTimeout(function(){
              window.location.href='./groups.php?user_id=$id';
              }, 2000)</script>";      
        } else {
          echo "<script>setTimeout(function(){
            window.location.href='./groups.php';
            }, 2000)</script>"; 
        }
        
    } catch(PDOException $e) {
        $error = 'Could not delete group'.$_GET['group_id'];
    }
}

if (isset($_GET["join"])){
  try{
      joinGroup($_GET['group_id'], $_GET['user_id']);
      $success = "Group ".$_GET['group_id']. " joined successfully";
      $result = readAllGroups();
      $members_num = getGoupsMembersNumber();
      if ($_COOKIE['current_role'] === 'participant' && $_GET['user_id']){
          $result = readGroupsMemberOf($_GET['user_id']);
      }
      if ($_COOKIE['current_role'] === 'manager' && $_GET['user_id']){
          $result = readManagedGroups($_GET['user_id']);
      }
      if ($_GET['user_id'] && ['current_role'] != 'admin'){
        $id = $_GET['user_id'];
        echo "<script>setTimeout(function(){
            window.location.href='./groups.php?user_id=$id';
            }, 2000)</script>";      
      } else {
        echo "<script>setTimeout(function(){
          window.location.href='./groups.php';
          }, 2000)</script>"; 
      }
  } catch (PDOException $e){
    $error = "Cannot join group".$_GET['group_id'];
  }
}
?>
<?php
} catch(PDOException $e) {

}
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
          
        <h2><?php if ($_GET['user_id']) {echo "My ";}?>Groups</h2>
      </div>
        <div class="col-2">
        <div class="btn btn-secondary " onclick="window.location='create.php?table=groups'">Add a new Group
        </div>
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
              <a href="group.php?id=<?php echo escape($result[$index]['group_ID'])?>">
                <h5 class="mb-1"><?php echo $result[$index]['name'] ?></h5></a>
                <medium>
                        <span
                        class="badge badge-dark badge-pill align-right"><?php echo $members_num[$index]['members_num'] ?>
                        members</span>
                        <?php if ($_COOKIE['user_id'] === $result[$index]['manager_ID']){?>
                            <span
                        class="badge badge-info badge-pill align-right">Managing</span>
                        <?php } ?>
                        <?php $group_mem = isGroupMember($_COOKIE['user_id'], $result[$index]['group_ID']);
                         if ($group_mem === 'pending'){?>
                                <span
                          class="badge badge-warning badge-pill align-right">Pending Membership</span>
                        <?php }else if ($group_mem === 'joined'){ ?>
                          <span
                          class="badge badge-success badge-pill align-right">Joined</span>
                        <?php } ?>
                </medium>
              </div>
              <p class="mb-1">
                <b>Managed By:</b> <br><a href="user.php?id=<?php echo $result[$index]['manager_ID'] ?>"><?php 
                if ($_COOKIE['user_id'] == $result[$index]['manager_ID']){
                    echo "You";
                } else {
                    echo readSingle('users', 'user_ID', $result[$index]['manager_ID'])[0]['name'];
                } ?>
                </a>
              <br>
              
                <b>Associated Event(s):</b><br> 
                <?php if ($_COOKIE['current_role'] === 'admin' || ($_COOKIE['user_id'] === $result[$index]['manager_ID'])){?>
                  <div class="btn btn-secondary pull-right"
                  onclick="window.location='update.php?table=groups&key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]);?>';">
                  Edit</div>
                  <button class="btn btn-danger pull-right" style="margin-right: 5px;" type="submit" name="submit"
                    value="<?php echo escape($result[$index][key($result[$index])]); ?>">Delete</button>
                <?php } ?>
                <?php $group_mem = isGroupMember($_COOKIE['user_id'], $result[$index]['group_ID']);
                if ( $group_mem === 'not'){?>
                <div class="btn btn-primary pull-right" style="margin-right: 5px;"
                  onclick="window.location='groups.php?group_id=<?php echo $result[$index]['group_ID']?>&user_id=<?php echo $_COOKIE['user_id']?>&join=';">
                  Request to Join Group</div>
                <?php } ?>
                <?php $associatedEvents = readEventsFromGroup($result[$index]['group_ID']);
                      if (sizeof($associatedEvents) > 0){
                        $index2 = 0;
                        foreach($associatedEvents as $key => $value){?>
                          <span class="btn btn-link" onclick="window.location='event.php?id=<?php echo $associatedEvents[$index2]['event_ID'] ?>';"><?php echo $associatedEvents[$index2]['name'] ?></span>
                       <?php 
                          $index2++;
                       }
                      } else {?>
                        None
                      <?php }
                ?>
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