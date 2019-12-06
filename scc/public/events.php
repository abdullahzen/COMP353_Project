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
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

if (isset($_POST["submit"])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        delete($_GET['table'], key($result[0]), $_POST["submit"]);
        $success = "User successfully deleted";
?>
    
<?php
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php
    include "header.php";
//    var_dump($result);
?>
<?php
    if (sizeof($result) > 0) {
?>
<form method="post">
    <input name="csrf" type="hidden" value="<?php echo ($_SESSION['csrf']); ?>">
    <a href="create.php?table=<?php echo ($table) ?>">Create new entry for <?php echo ($table) ?></a>
    <table align="right">
        <thead>
            <tr>
                <?php foreach($result[0] as $key => $value){ ?>
                    <th>
                        <?php echo $key; ?>
                    </th>
                <?php } ?>
                <?php
                if($_COOKIE['current_role'] === 'admin' || $_COOKIE['current_role'] === 'manager') {
                    echo "
                        <th>Edit</th>
                        <th>Delete</th>
                    ";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($result as $key => $value) { ?>
                <tr>
                    <?php
                        foreach ($result[$index] as $key => $value) {
                    ?>
                            <td><?php echo $result[$index][$key]; ?></td>
                    <?php
                        }
                    ?>
                    <?php
                        if($_COOKIE['current_role'] === 'admin' || $_COOKIE['current_role'] === 'manager') {
                    ?>
                            <td><a href="update.php?table=events&key=<?php echo (key($result[$index])) ?>&id=<?php echo ($result[$index][key($result[$index])]); ?>">Edit</a></td>
                            <td><button type="submit" name="submit" value=\"<?php echo ($result[$index][key($result[$index])]); ?>\">Delete</button></td>
                    <?php
                        }
                    ?>
                </tr>
            <?php
                $index++;
            }
            ?>
        </tbody>
    </table>
</form>
<?php } else { ?>
    <div align="center">
        <blockquote>No events found.</blockquote>
    </div>
<?php
} ?>