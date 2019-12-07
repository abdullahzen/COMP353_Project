<?php

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("db/schema.sql");
    $connection->exec($sql);
    if ($env == 'local'){
        $connection->exec("CREATE TRIGGER `events_validity_date`
        BEFORE INSERT
        ON events FOR EACH ROW
        BEGIN
        SET new.expiration_date = DATE_ADD(new.date, INTERVAL 7 YEAR);
        END");
        $connection->exec("CREATE TRIGGER `make_user_participant_by_default`
        AFTER INSERT
        ON users FOR EACH ROW
        BEGIN
        INSERT INTO user_roles(user_ID, role_ID) VALUES (new.user_ID, 4);
        END");
        $sql = file_get_contents("db/data.sql");
        $connection->exec($sql);
    } else {
        $sql = file_get_contents("db/data_server_notriggers.sql");
        $connection->exec($sql);
    }
    
    

    echo "Database and table users created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}