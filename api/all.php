<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error_log.txt');

include "db.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}

$res = array('error' => false);

$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($conn->connect_error) {
    $error = array('error' => true, 'message' => 'Failed to connect to the database');
    echo json_encode($error);
    exit();
}


$query = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($query);


if (!$result) {
    $error = array('error' => true, 'message' => 'Failed to fetch products from the database');
    echo json_encode($error);
    exit();
}


$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


$conn->close();


echo json_encode($data);
