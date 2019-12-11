<?php

require "../app/operations/crud.php";
require "../app/operations/sendMessage.php";
include "header.php";

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

$success = null;
$error = null;

try {
    if ($_COOKIE['user_id']){
        $sentMessages = readMessages('messages',$_COOKIE['user_id'], $_GET['id']);
        $receivedMessages = readMessages('messages', $_GET['id'], $_COOKIE['user_id']);
        $messages = array_merge($sentMessages, $receivedMessages);
        usort($messages, 'cmp');
        $sender = readSingle('users', 'user_ID', $_COOKIE['user_id'])[0];
        $receiver = readSingle('users', 'user_ID', $_GET['id'])[0];
    } else {
        throw new PDOException();
    }

    if (isset($_GET["sendmessage"])) {
        if ($_COOKIE['user_id']){
            sendMessage($_COOKIE['user_id'], $_GET['id'], escape(urldecode($_GET['sendmessage'])));
            $id = $_GET['id'];
            $success = "Message sent successfully.";
        }
    }

    if (isset($_GET["deletemessage"])) {
        if ($_COOKIE['user_id']){
            delete('messages', 'message_ID', $_GET['deletemessage']);
            $id = $_GET['id'];
            $success = "Post deleted successfully.";
        }
    }
?>
<?php
} catch(PDOException $e) {
    $error = "You are not logged in. Redirecting to log in page.";
}


?>

<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
  $id = $_GET['id'];
  echo "<script>setTimeout(function(){
    window.location.href='./message.php?id=$id';
    }, 250)</script>";
    exit;
  ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php
  if ($error === "You are not logged in. Redirecting to log in page."){
    echo $error;
?>
<?php
    echo "<script>setTimeout(function(){
        window.location.href='sing-in.php';
    }, 3000)</script>";
    exit;
?>
<?php } else {
    echo $error;
}
  ?>
    </div>

<?php } ?>
<div class="container">    

    <h3><b>Messages with <?php echo $receiver['name'] ?></b></h3>
<?php
    if ($sentMessages || $receivedMessages) {
?>
        <!-- all messages -->

        <?php
        $index = 0;
        foreach ($messages as $key => $value){?>
    <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ml-2">
                                <a href="user.php?id=<?php echo readSingle('users', 'user_ID', $messages[$index]['sender_ID'])[0]['user_ID'] ?>"><div class="h5 m-0"><?php 
                                if ($_COOKIE['user_id'] === $messages[$index]['sender_ID']){
                                    echo "You";
                                } else {
                                    echo $receiver['name'];
                                } ?></div></a>
                                    
                                </div>
                            </div>
                            <?php if ($_COOKIE['user_id']==$messages[$index]['sender_ID']){ ?>
                                <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" onclick="window.location='message.php?id=<?php echo $_GET['id']?>&deletemessage=<?php echo $messages[$index]['message_ID'] ?>'">Delete</a>
                                    </div>
                                </div>

                            </div>
                            <?php } ?>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> <?php echo time_elapsed_string($messages[$index]['timestamp']); ?></div>
                        <!-- <a class="card-link" href="#"> -->
                            <h5 class="card-title"><?php echo $messages[$index]['text'] ?></h5>
                        <!-- </a> -->
                    </div>
                </div>
                <br>
            <?php
            $index++;
        } ?>
        
<?php } else { ?>
    <blockquote>No messages found.</blockquote>
<?php
} ?>
    <!-- new message -->
    <div class="row">
        <div class="col-12">
                <div class="card gedf-card">
                    <div class="card-header">
                    <h5>Send a message</h5>
                    </div>
                    <div class="card-body">
                    <form method="post">
                        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                       <div class="form-group">
                          <label class="sr-only" for="message">Message</label>
                          <input type="text" class="form-control" id="#message" placeholder="Send message..."/>
                        </div>
                            
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="button" onclick="window.location = 'message.php?id=<?php echo $_GET['id']?>&sendmessage='
                                + encodeURI(document.getElementById('#message').value);" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>
</div>
