<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

require "../app/operations/crud.php";

$result = readAll('bank_information');
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
            <th>bank_information_ID</th>
            <th>cardholder_name</th>
            <th>address</th>
            <th>card_number</th>
            <th>expiration_date</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["bank_information_ID"]); ?></td>
                <td><?php echo escape($row["cardholder_name"]); ?></td>
                <td><?php echo escape($row["address"]); ?></td>
                <td><?php echo escape($row["card_number"]); ?></td>
                <td><?php echo escape($row["expiration_date"]); ?></td>
                <td><a href="bank_information_update.php?id=<?php echo escape($row["bank_information_ID"]); ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>