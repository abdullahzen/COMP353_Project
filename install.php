<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca->

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
        $connection->exec("CREATE TRIGGER `make_group_manager_member_of_group`
        AFTER INSERT
        ON `orc353_2`.groups FOR EACH ROW
        BEGIN
        INSERT INTO group_members(group_ID, user_ID, admitted) VALUES (new.group_ID, new.manager_ID, TRUE);
        END");
        $connection->exec("CREATE TRIGGER `make_event_managers_participants_of_event`
        AFTER INSERT
        ON `orc353_2`.events FOR EACH ROW
        BEGIN
        INSERT INTO event_organization_participants(event_ID, organization_ID, user_ID) VALUES (new.event_ID, 1, new.manager_ID);
        END");
        $sql = file_get_contents("db/data.sql");
        $connection->exec($sql);
    } else {
        $sql = file_get_contents("db/data_server_notriggers.sql");
        $connection->exec($sql);
    }

    header("location: index.php");
    echo "Database and table users created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}