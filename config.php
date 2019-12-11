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
/**
 * Configuration for database connection
 *
 */
// default env is local 
// choosing server will disable DB triggers and hence diasble some functionality that depend on it.
$env        = 'local';
if ($env == 'server'){
    $host = 'orc353.encs.concordia.ca';
} else {
    $host = 'localhost';
}
$username   = 'orc353_2';
$password   = 'H8Y95r';
$dbname     = 'orc353_2';
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ERRMODE_WARNING
);