<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca-->

<?php
/**
 * Configuration for database connection
 *
 */
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