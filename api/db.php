<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "rati";
    $dbpass = "";
    $db = "test";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

    return $conn;
}
$conn = OpenCon();
