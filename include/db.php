<?php
    
    $DB_HOST = "localhost";
    $DB_USER = "shihab";
    $DB_PASS = "shihab";
    $DB_NAME = "cms";
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=cms', 'shihab', 'shihab');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>