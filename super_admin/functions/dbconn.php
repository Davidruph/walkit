<?php

// $server = "localhost";  //server host
// $username = "ujcjwhfeokxbh";  //Username of server
// $password = "#i@|d4}sj3(1";  //Server password
// $dbname = "dbjqx4xsyvob6y";  //Name of the database

$server = "localhost";  //server host
$username = "root";  //Username of server
$password = "";  //Server password
$dbname = "walkit_app";  //Name of the database

//   $conn = mysqli_connect("localhost", "ujcjwhfeokxbh", "#i@|d4}sj3(1", "dbjqx4xsyvob6y");
$conn = mysqli_connect("localhost", "root", "", "walkit_app");

try {
  $connection = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
