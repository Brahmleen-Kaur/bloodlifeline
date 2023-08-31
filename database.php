<?php

define('host', 'localhost');
define('user', 'fortunorth_blooduser');
define('password', '_(WLZF@K+-]9');
define('database', 'fortunorth_blood');

$conn = new mysqli(host, user, password, database);


if ($conn->connect_errno) {
    die("connection error" . $conn->connect_errno . '  ' . $conn->connect_error);
}
?>