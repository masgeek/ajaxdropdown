<?php

$servername = "localhost";
$username = "sammy";
$password = "sammy";
$db = 'judges';

// Create connection
$link = new mysqli($servername, $username, $password,$db);

// Check connection
if ($link->connect_error) {
die("Connection failed: " . $link->connect_error);
}
echo "Connected successfully";