<?php
/**
 * Configuration for database connection
 *
 */
$host       = 'orc353.encs.concordia.ca';
$username   = 'orc353_2';
$password   = 'H8Y95r';
$dbname     = 'orc353_2';
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);