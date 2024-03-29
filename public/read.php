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

require "../app/operations/crud.php";

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

if (isset($_GET['table'])) {
    try {
        $table = $_GET['table'];
        $result = readAll($table);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

if (isset($_POST["submit"])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        delete($_GET['table'], key($result[0]), $_POST["submit"]);
        $success = "User successfully deleted";
?>
    <script type="text/javascript">
        window.location = "<?php echo "/read.php?table=" . $_GET['table'] ?>";
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
        <div>
            <form method="post">
                <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                <div align="right">
                    <a class="create_new" href="create.php?table=<?php echo escape($table) ?>">Create new <?php echo escape($table) ?></a>
                </div>
                <hr>
                <table class="table_template center" >
                    <div>
                        <h1 class="center">Manage <?php echo $_GET['table'] ?></h1>
                    </div>
                    <thead>
                    <tr>
                        <?php foreach($result[0] as $key => $value){ 
                            if ($key == 'password'){
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
                    foreach ($result as $key => $value) { 
                        if ($key == 'password'){
                            $index++;
                            continue;
                        }
                        ?>
                        <tr>
                            <?php
                            foreach ($result[$index] as $key => $value) {
                                if ($key == 'password'){
                                    continue;
                                }
                                ?>
                                <td><?php echo $result[$index][$key]; ?></td>
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