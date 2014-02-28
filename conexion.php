<?php
require("config.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DATABASE);
if ($mysqli->connect_errno) {
    echo "Error al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->query("SET NAMES 'utf8'");
?>