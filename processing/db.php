<?php

    $host = 'localhost';
    $db_name = 'appre-projet-dwwm';
    $db_username = 'root';
    $db_password = '';

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . '; charset=utf8', $db_username, $db_password);

?>