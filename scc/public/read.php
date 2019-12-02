<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

require "../app/operations/crud.php";

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
?>
<?php
    include "header.php";
?>
<?php
    if (sizeof($result) > 0) {
?>
<table align="center">
    <thead>
        <tr>
            <?php foreach($result[0] as $key => $value){ ?>
                <th>
                    <?php echo $key; ?>
                </th>
            <?php } ?>
<!--            <th>bank_information_ID</th>-->
<!--            <th>cardholder_name</th>-->
<!--            <th>address</th>-->
<!--            <th>card_number</th>-->
<!--            <th>expiration_date</th>-->
            <th>Edit</th>
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
                <td><a href="update.php?table=<?php echo escape($table) ?>&key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]); ?>">Edit</a></td>
            </tr>
        <?
            $index++;
        }
        ?>
    </tbody>
</table>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>