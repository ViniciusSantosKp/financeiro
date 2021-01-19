<?php
session_start();
$base = 'http://localhost/Financeiro/';
$dbName;
$dbHost;
$dbUser;
$dbPass;

$pdo = new PDO("mysql:dbname=".$dbName.";host=".$dbHost, $dbUser, $dbPass);