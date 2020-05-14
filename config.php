<?php 

$host = 'localhost';
$db_name = 'pgx2_db';
$server_login = 'root';
$server_password = '123';
$charset = 'utf8';

$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset", $server_login, $server_password);