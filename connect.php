<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=typing_test', 'root', '');
    $connection->query('SET NAMES UTF8');
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

?>