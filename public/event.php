<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca->

<?php

require "../app/operations/eventsCrud.php";
require "../app/operations/postsCrud.php";
require "../app/operations/commentsCrud.php";
require "../app/operations/crud.php";
include "header.php";

$success = null;
$error = null;

try {
    if (isEventParticipant($_COOKIE['user_id'], $_GET['id']) || isEventManager($_COOKIE['user_id'], $_GET['id'])){
        $result = readSingleEvent($_GET['id']);
        $posts = readPostsOfEvent($_GET['id']);
        $groups = readGroupsOfEvent($_GET['id']);
        $participants = readParticipantsOfEvent($_GET['id']);
        $AllUsers = readAll('users');
    } else {
        throw new PDOException();
    }

    if (isset($_GET['add_participant'])){
        if ($_COOKIE['user_id'] === $result[0]['manager_ID']){
            $organization_id = readOrganizationIdOfEvent($_GET['id']);
            addParticipantToEvent($_GET['id'], $organization_id, $_GET['add_participant']);
            $participants = readParticipantsOfEvent($_GET['id']);
            $success = "Participant: " . readSingle('users', 'user_ID', $_GET['add_participant'])[0]['name'] . " was added successfully to the event.";
        } else {
            $error = "You cannot add participants if you're not the event manager.";
        }
    }

    if (isset($_GET['comment'])){
        if ($_COOKIE['user_id']){
            addCommentToPost($_GET['post'], escape(urldecode($_GET['comment'])), $_COOKIE['user_id']);
            $id = $_GET['id'];
            echo "<script>setTimeout(function(){
                window.location.href='./event.php?id=$id';
            }, 0)</script>";
        }
    }

    if (isset($_GET["createpost"])) {
        if ($_COOKIE['user_id']){
            $post_id = createPost($_GET['id'], escape(urldecode($_GET['post_title'])), escape(urldecode($_GET['post_text'])), $_COOKIE['user_id']);
            addPostToEvent($_GET['id'], $post_id);
            $id = $_GET['id'];
            $success = "Post created successfully.";
        }
    }

    if (isset($_GET["deletepost"])) {
        if ($_COOKIE['user_id']){
            deletePost('post_ID', $_GET['deletepost']);
            $id = $_GET['id'];
            $success = "Post deleted successfully.";
        }
    }

    if (isset($_GET["deletecomment"])) {
        if ($_COOKIE['user_id']){
            deleteComment($_GET['deletecomment']);
            $id = $_GET['id'];
            $success = "Comment deleted successfully.";
        }
    }

    if (isset($_GET["deleteparticipant"])) {
        if ($_COOKIE['user_id'] == $result[0]['manager_ID'])
        {
            deleteParticipant($_GET['deleteparticipant'], $_GET['id']);
            $id = $_GET['id'];
            $success = "Participant deleted successfully";
        }
    }
?>
<?php
} catch(PDOException $e) {
    $error = "You are not a participant of the event you're trying to view. Redirecting to events list.";
}


?>

<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
  $id = $_GET['id'];
  echo "<script>setTimeout(function(){
    window.location.href='./event.php?id=$id';
    }, 1000)</script>";
    exit;
  ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php
  if ($error === "You are not a participant of the event you're trying to view. Redirecting to events list."){
    echo $error;
?>
<?php
    echo "<script>setTimeout(function(){
        window.location.href='./events.php';
    }, 3000)</script>";
    exit;
?>
<?php } else {
    echo $error;
}
  ?>
</div>

<?php } ?>
<?php
    if ($result) {
        $result = $result[0];
?>
<div class="container">

    <div class="card text-center">
        <div class="card-header">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10">
                    <h3><b>Event: <?php echo $result['name'] ?></b></h3> 
                </div>
                <div class="col-1">
                    <medium><?php if ($result['status'] == 1){?>
                    <span class="badge badge-success badge-pill align-right">Active</span>
                    <?php } else { ?><span class="badge badge-danger badge-pill align-right">Archived</span> <?php } ?></medium>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text"><b>Location:</b><br>
                <?php echo $result['address'] ?>
            </p>
            <p class="card-text"><b>Date:</b><br>
                <?php echo $result['date'] ?>
            </p>
            
            <p class="card-text"><b>Price:</b><br>
                <?php echo $result['price'] ?>
            </p>
            <p class="card-text"><b>Expiration:</b><br>
                <?php echo $result['expiration_date'] ?>
            </p>

            <p class="card-text"><b>Associated Groups:</b><br>
                <?php if (sizeof($groups) > 0){
                    $index5 = 0;
                    foreach($groups as $key => $value){?>
                        <span class="btn btn-link" onclick="window.location='group.php?id=<?php echo $groups[$index5]['group_ID'] ?>';"><?php echo $groups[$index5]['name'] ?></span>
                    <?php 
                        $index2++;
                    }
                    } else {?>
                    None
                    <?php }
                ?>
            </p>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong">
                Show Event Participants
            </button>
        </div>
        <div class="card-footer text-muted">
        <h5><b>Event Managed by: <a href="user.php?id=<?php echo $result['manager_ID'] ?>"><?php 
            if ($_COOKIE['user_id'] === $result['manager_ID']){
                echo 'You';
            } else {
                echo readSingle('users', 'user_ID', $result['manager_ID'])[0]['name'];
            } 
        ?></a></b></h5>
        </div>
    </div>
    <hr>
    
    <!-- participants modal -->
<!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Event Participants</h5>
                <button type="button" class="close" data-dismiss="modal" data-target="#exampleModalLong" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                <?php $index2 = 0; foreach ($participants as $key => $value) {
                    if (!isEventParticipant($_COOKIE['user_id'], $result['event_ID']) && !isEventManager($_COOKIE['user_id'], $result['event_ID'])){
                        $index2++;
                        continue;
                    }
                    ?>
                    <li class="list-group-item list-group-item-action flex-column align-items-start" style='border-color:black;'>
                    <a href="user.php?id=<?php echo escape($participants[$index2]['user_ID'])?>">
                    <h5 class="mb-1"><?php 
                    if ($_COOKIE['user_id'] === $participants[$index2]['user_ID']){
                        echo "You";
                    } else {
                        echo $participants[$index2]['name'];
                    }
                     ?></h5></a>
                    <p class="mb-1">
                        <?php if (isEventManager($participants[$index2]['user_ID'], $_GET['id'])){
                                        echo "<b>Event Manager</b>";
                                } else {echo "Participant";
                                }?>
                        <?php if (isEventManager($_COOKIE['user_id'], $_GET['id']) && $participants[$index2]['user_ID'] != $result['manager_ID']) { ?>
                            <div class='btn btn-danger pull-right' onclick="window.location='event.php?id=<?php echo $_GET['id'] ?>&deleteparticipant=<?php echo $participants[$index2]['user_ID'] ?>'" ><i class="fa fa-trash" aria-hidden="true"></i></div>
                        <?php } ?>
                    </p>
                    </li>

                <?php $index2++;
            } ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php if ($_COOKIE['user_id'] === $result['manager_ID']){?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addParticipantModal">Add Participants</button>
                <?php } ?>
                        <!-- add participants -->
                        <div class="modal fade" id="addParticipantModal" tabindex="-1" role="dialog" aria-labelledby="addParticipantModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addParticipantModalTitle">Add Participants to Event: <?php echo $result['name'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" data-target="#addParticipantModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                <?php $index3 = 0; foreach ($AllUsers as $key => $value) {
                                    if (isInCurrentEvent($AllUsers[$index3]['user_ID'], $_GET['id'])){
                                        $index3++;
                                        continue;
                                    }
                                    ?>
                                    <li class="list-group-item list-group-item-action flex-column align-items-start" style='border-color:black;'>
                                    <a href="event.php?id=<?php echo $result['event_ID'] ?>&add_participant=<?php echo $AllUsers[$index3]['user_ID'] ?>">
                                    <h5 class="mb-1"><?php echo $AllUsers[$index3]['name'] ?></h5></a>
                                    </li>
                                <?php $index3++;} ?>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
            </div>
            </div>
        </div>
        </div>
    <!-- new posts -->
    <div class="row">
        <div class="col-12">
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make a Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                    <form method="post">
                        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">Post Title</label>
                                    <input type="text" class="form-control" id="#post_title" placeholder="Post title..."/>
                                    <hr>
                                    <label class="sr-only" for="message">Post</label>
                                    <textarea class="form-control" id="#post_text" rows="3" placeholder="What are you thinking?"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Upload image</label>
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="button" onclick="window.location = 'event.php?id=<?php echo $_GET['id']?>&post_title='
                                + encodeURI(document.getElementById('#post_title').value)
                                + '&post_text=' + encodeURI(document.getElementById('#post_text').value) + '&createpost=';" class="btn btn-primary">Post</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>
        <!-- all posts -->

        <?php
        $index = 0;
        foreach ($posts as $key => $value){?>
    <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                </div>
                                <div class="ml-2">
                                    <a href="user.php?id=<?php echo readSingle('users', 'user_ID', $posts[$index]['poster_ID'])[0]['user_ID'] ?>"><div class="h5 m-0"><?php 
                                        if ($_COOKIE['user_id'] === $posts[$index]['poster_ID']){
                                            echo "You";
                                        } else {
                                            echo readSingle('users', 'user_ID', $posts[$index]['poster_ID'])[0]['name'];
                                        }
                                    ?></div></a>
                                    <div class="h7 text-muted">
                                        <?php if (isEventManager($posts[$index]['poster_ID'], $_GET['id'])){
                                        echo "<b>Event Manager</b>";
                                    } else {echo "Participant";}?></div>
                                </div>
                            </div>
                            <?php if (isEventManager($_COOKIE['user_id'], $_GET['id']) || isPostOwner($posts[$index]['post_ID'], $_COOKIE['user_id'])){ ?>
                                <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" onclick="window.location='event.php?id=<?php echo $_GET['id']?>&deletepost=<?php echo $posts[$index]['post_ID'] ?>'">Delete</a>
                                    </div>
                                </div>

                            </div>
                            <?php } ?>

                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> <?php echo time_elapsed_string($posts[$index]['timestamp']); ?></div>
                        <!-- <a class="card-link" href="#"> -->
                            <h5 class="card-title"><?php echo $posts[$index]['title'] ?></h5>
                        <!-- </a> -->

                        <p class="card-text">
                                <?php echo $posts[$index]['text']; ?>
                        </p>
                    </div>
                    <section class="card-footer">
                        <a href="#" class="card-link" onclick="document.getElementById('#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['event_ID'] ?>').hidden = !document.getElementById('#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['event_ID'] ?>').hidden;"><i class="fa fa-comment"></i>
                        Comment
                        </button></a>
                   <div class="card-footer-comment-wrapper">
                       <div class="comment-form" hidden="true" id="#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['event_ID'] ?>">
                            <textarea class="form-control" id="#commentContent<?php echo $posts[$index]['post_ID'].'-'.$result['event_ID'] ?>" placeholder="write a comment..." rows="3"></textarea>
                            <br>
                            <button type="button" class="btn btn-primary pull-right" onclick="window.location = 'event.php?id=<?php echo $_GET['id']?>&comment=' + encodeURI(document.getElementById('#commentContent<?php echo $posts[$index]['post_ID'].'-'.$result['event_ID'] ?>').value) + '&post=<?php echo $posts[$index]['post_ID']?>';">Post Comment</button>
                            <div class="clearfix"></div>
                       </div>
                       <?php
                       $index4 = 0;
                       $comments = readPostComments($posts[$index]['post_ID']);
                       foreach ($comments as $key => $value ){?>
                        <hr>
                       <div class="comment">
                            <div class="media">
                              <div class="media-left">
                              <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/60/60" alt="">
                                </div>
                              </div>
                              <div class="media-body">
                                <a href="user.php?id=<?php echo $comments[$index4]['commenter_ID'] ?>" class="anchor-username"><h7 class="media-heading"><?php 
                                if ($_COOKIE['user_id'] === $comments[$index4]['commenter_ID']){
                                    echo "You";
                                } else {
                                    echo readSingle('users', 'user_ID', $comments[$index4]['commenter_ID'])[0]['name'];
                                }
                                ?></h7></a>
                                <div class="text-muted h7 mb-2"> <small><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string($comments[$index4]['timestamp']); ?></small></div>
                                <p class="card-text">
                                <?php echo $comments[$index4]['comment']; ?>
                                </p>
                              </div>
                              <div class="media-right">
                              <?php if (isEventManager($_COOKIE['user_id'], $_GET['id']) || $comments[$index4]['commenter_ID'] == $_COOKIE['user_id']){ ?>
                                <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" onclick="window.location='event.php?id=<?php echo $_GET['id']?>&deletecomment=<?php echo $comments[$index4]['post_comment_ID'] ?>'">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                              </div>
                            </div>
                       </div>
                            <?php $index4++;
                        }?>
                   </div>
               </section>
                </div>
            <?php
            $index++;
        } ?>
</div>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>