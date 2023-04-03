<?php
$path = $_SERVER['DOCUMENT_ROOT'];

$servername = 'localhost';
$username = 'root';
$password = '';
$myDB = 'test';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo 'connected';
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
