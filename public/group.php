<?php
require "../app/operations/groupsCrud.php";
require "../app/operations/postsCrud.php";
require "../app/operations/commentsCrud.php";
require "../app/operations/crud.php";
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
    $checkGroupMember = isGroupMember($_COOKIE['user_id'], $_GET['id']);
    if ($checkGroupMember === 'joined' || isGroupManager($_COOKIE['user_id'], $_GET['id'])){
        $result = readSingleGroup($_GET['id']);
        $posts = readPostsOfGroup($_GET['id']);
        $members = readGroupMembers($_GET['id']);
        $AllUsers = readAll('users');
    } else {
        throw new PDOException();
    }

    if (isset($_GET['add_member'])){
        if ($_COOKIE['user_id'] === $result[0]['manager_ID']){
            addMemberToGroup($_GET['id'],$_GET['add_member']);
            $members = readGroupMembers($_GET['id']);
            $success = "Member: " . readSingle('users', 'user_ID', $_GET['add_member'])[0]['name'] . " was added successfully to the group.";
        } else {
            $error = "You cannot add members if you're not the group manager.";
        }
    }

    if (isset($_GET['admit_member'])){
        if ($_COOKIE['user_id'] === $result[0]['manager_ID']){
            admitMemberToGroup($_GET['id'],$_GET['admit_member']);
            $members = readGroupMembers($_GET['id']);
            $success = "Member: " . readSingle('users', 'user_ID', $_GET['admit_member'])[0]['name'] . " was admitted successfully to the group.";
        } else {
            $error = "You cannot admit members if you're not the group manager.";
        }
    }

    if (isset($_GET['comment'])){
        if ($_COOKIE['user_id']){
            addCommentToPost($_GET['post'], escape(urldecode($_GET['comment'])), $_COOKIE['user_id']);
            $id = $_GET['id'];
            echo "<script>setTimeout(function(){
                window.location.href='./group.php?id=$id';
            }, 0)</script>";
        }
    }

    if (isset($_GET["createpost"])) {
        if ($_COOKIE['user_id']){
            $post_id = createPost($_GET['id'], escape(urldecode($_GET['post_title'])), escape(urldecode($_GET['post_text'])), $_COOKIE['user_id']);
            addPostToGroup($_GET['id'], $post_id);
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

    if (isset($_GET["deletemember"])) {
        if ($_COOKIE['user_id'] == $result[0]['manager_ID'])
        {
            deleteMember($_GET['deletemember'], $_GET['id']);
            $id = $_GET['id'];
            $success = "Member deleted successfully";
        }
    }
?>
<?php
} catch(PDOException $e) {
    $error = "You are not a member of the group you're trying to view. Redirecting to group list.";
}


?>

<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
  $id = $_GET['id'];
  echo "<script>setTimeout(function(){
    window.location.href='./group.php?id=$id';
    }, 1000)</script>";
    exit;
  ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php
  if ($error === "You are not a member of the group you're trying to view. Redirecting to group list."){
    echo $error;
?>
<?php
    echo "<script>setTimeout(function(){
        window.location.href='./groups.php';
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

    <h3><b>Group: <?php echo $result['name'] ?></b></h3>
    <h5><b>Group Manager: <a href="user.php?id=<?php echo $result['manager_ID'] ?>"><?php 
    if ($_COOKIE['user_id'] === $result['manager_ID']){
        echo "You";
    } else {
        echo readSingle('users', 'user_ID', $result['manager_ID'])[0]['name'];
    } ?></a></b></h5>
    <!-- members modal -->
    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-12">
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong">
        Show Members
        </button>
        </div>
    </div>

<!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Group Members</h5>
                <button type="button" class="close" data-dismiss="modal" data-target="#exampleModalLong" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                <?php $index2 = 0; foreach ($members as $key => $value) {
                    if ($members[$index2]['admitted'] != 1 && !isGroupManager($_COOKIE['user_id'], $result['group_ID'])){
                        $index2++;
                        continue;
                    }
                    ?>
                    <li class="list-group-item list-group-item-action flex-column align-items-start" style='border-color:black;'>
                    <a href="user.php?id=<?php echo escape($members[$index2]['user_ID'])?>">
                    <h5 class="mb-1"><?php 
                    if ($_COOKIE['user_id'] === $members[$index2]['user_ID']){
                        echo "You";
                    } else {
                        echo $members[$index2]['name'];
                    }
                    ?></h5></a>
                    <p class="mb-1">
                        <?php if (isGroupManager($members[$index2]['user_ID'], $_GET['id'])){
                                        echo "<b>Group Manager</b>";
                                } else {echo "Member";}?>
                        <?php if ($members[$index2]['admitted'] != 1){?>
                            <button type="button" class="btn btn-warning pull-right" onclick="window.location='group.php?id=<?php echo $_GET['id'] ?>&admit_member=<?php echo $members[$index2]['user_ID']?>'">Admit Member</button>
                        <?php } ?>
                        <?php if (isGroupManager($_COOKIE['user_id'], $_GET['id']) && $members[$index2]['user_ID'] != $result['manager_ID']) { ?>
                            <div class='btn btn-danger pull-right' onclick="window.location='group.php?id=<?php echo $_GET['id'] ?>&deletemember=<?php echo $members[$index2]['user_ID'] ?>'" ><i class="fa fa-trash" aria-hidden="true"></i></div>
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMemberModal">Add Members</button>
                <?php } ?>
                        <!-- add members -->
                        <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMemberModalTitle">Add Member to Group: <?php echo $result['name'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" data-target="#addMemberModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                <?php $index3 = 0; foreach ($AllUsers as $key => $value) {
                                    if (isInCurrentGroup($AllUsers[$index3]['user_ID'], $_GET['id'])){
                                        $index3++;
                                        continue;
                                    }
                                    ?>
                                    <li class="list-group-item list-group-item-action flex-column align-items-start" style='border-color:black;'>
                                    <a href="group.php?id=<?php echo $result['group_ID'] ?>&add_member=<?php echo $AllUsers[$index3]['user_ID'] ?>">
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
                                <button type="button" onclick="window.location = 'group.php?id=<?php echo $_GET['id']?>&post_title='
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
                                } ?></div></a>
                                    <div class="h7 text-muted">
                                        <?php if (isGroupManager($posts[$index]['poster_ID'], $_GET['id'])){
                                        echo "<b>Group Manager</b>";
                                    } else {echo "Member";}?></div>
                                </div>
                            </div>
                            <?php if (isGroupManager($_COOKIE['user_id'], $_GET['id']) || isPostOwner($posts[$index]['post_ID'], $_COOKIE['user_id'])){ ?>
                                <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" onclick="window.location='group.php?id=<?php echo $_GET['id']?>&deletepost=<?php echo $posts[$index]['post_ID'] ?>'">Delete</a>
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
                        <a href="#" class="card-link" onclick="document.getElementById('#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['group_ID'] ?>').hidden = !document.getElementById('#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['group_ID'] ?>').hidden;"><i class="fa fa-comment"></i>
                        Comment
                        </button></a>
                   <div class="card-footer-comment-wrapper">
                       <div class="comment-form" hidden="true" id="#commentBox<?php echo $posts[$index]['post_ID'].'-'.$result['group_ID'] ?>">
                            <textarea class="form-control" id="#commentContent<?php echo $posts[$index]['post_ID'].'-'.$result['group_ID'] ?>" placeholder="write a comment..." rows="3"></textarea>
                            <br>
                            <button type="button" class="btn btn-primary pull-right" onclick="window.location = 'group.php?id=<?php echo $_GET['id']?>&comment=' + encodeURI(document.getElementById('#commentContent<?php echo $posts[$index]['post_ID'].'-'.$result['group_ID'] ?>').value) + '&post=<?php echo $posts[$index]['post_ID']?>';">Post Comment</button>
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
                                } ?></h7></a>
                                <div class="text-muted h7 mb-2"> <small><i class="fa fa-clock-o"></i> <?php echo time_elapsed_string($comments[$index4]['timestamp']); ?></small></div>
                                <p class="card-text">
                                <?php echo $comments[$index4]['comment']; ?>
                                </p>
                              </div>
                              <div class="media-right">
                              <?php if (isGroupManager($_COOKIE['user_id'], $_GET['id']) || $comments[$index4]['commenter_ID'] == $_COOKIE['user_id']){ ?>
                                <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" onclick="window.location='group.php?id=<?php echo $_GET['id']?>&deletecomment=<?php echo $comments[$index4]['post_comment_ID'] ?>'">Delete</a>
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