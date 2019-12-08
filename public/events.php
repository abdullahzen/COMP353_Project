<?php

require "../app/operations/eventsCrud.php";

$success = null;

try {
    switch($_COOKIE['current_role']) {
        case 'admin':
            $result = readAllEvents();
            break;
        case 'manager':
            $result = readManagedEvents();
            break;
        case 'controller':
            $result = readAllEvents();
            break;
        case 'participant':
            $result = readParticipatingEvents();
            break;
    }
//    var_dump($result);
?>
<script type="text/javascript">
    window.location = "
    <?php
        if ($_COOKIE['current_role'] === 'admin' || $_COOKIE['current_role'] === 'manager') {
            echo "/read.php?table=" . $_GET['table'];
        }
        if ($_COOKIE['current_role'] === 'participant') {
            echo "/events.php";
        }
        ?>";
</script>
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
    include "header.php";
?>
<?php
    if (sizeof($result) > 0) {
?>
       <div class="content">
            <form method="post">
                <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                <div align="right">
                    <a class="create_new" href="create.php?table=<?php echo escape($table) ?>">Add a new Event</a>
                </div>
                <table class="table_template center" >
                    <div>
                        <h1 class="center">Manage Events</h1>
                    </div>
                    <thead>
                    <tr>
                        <?php foreach($result[0] as $key => $value){ 
                            if ($key === 'event_ID'){
                                continue;
                            }
                            ?>
                            
                            <th>
                                <?php echo $key; ?>
                            </th>
                        <?php } ?>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $index = 0;
                    foreach ($result as $key => $value) { ?>
                        <tr>
                            <?php
                            foreach ($result[$index] as $key => $value) {
                                if ($key === 'event_ID'){
                                    $event_ID = $value;
                                    continue;
                                }
                                ?>
                                <?php if ($key === 'name'){?>

                                    <td><a href="event.php?id=<?php echo escape($event_ID)?>"><?php echo $result[$index][$key]; ?></a></td>
                                <?php 
                                } else {?>
                                <td><?php echo $result[$index][$key]; ?></td>
                                <?php } ?>
                                <?php
                            }
                            ?>
                            <td><a class="edit_button" href="update.php?table=<?php echo escape($table) ?>
                            &key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]); ?>">Edit</a></td>
                            <td><button type="submit" name="submit" value="<?php echo escape($result[$index][key($result[$index])]); ?>">Delete</button></td>
                        </tr>
                        <?php
                        $index++;
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>


<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>