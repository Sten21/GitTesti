<?php
$db_host = 'localhost';
$db_name = 'matkakulkulaskuri';
$db_username = 'Pete';
$db_password = 'dGU2[IR_w-XkGFEh';

$dsn =  "mysql:host=$db_host;dbname=$db_name";

//$db_connection = new PDO($dsn, $db_username, $db_password);

try {
    $db_connection = new PDO($dsn, $db_username, $db_password);
}   catch (Exception $fail) {
    echo "there was a failure - " . $fail->getmessage();
}
?>