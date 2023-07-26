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

$sku = $_POST['sku'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'addProducts') {
    if ($sku === '' || $name === '' || $price === '') {
        $res['error'] = true;
        $res['message'] = "Incomplete data provided";
    } else {
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO `products`(`id`, `sku`, `name`, `price`) VALUES (NULL, ?, ?, ?)");
        $stmt->bind_param('sss', $sku, $name, $price);

        // Execute the prepared statement
        if ($stmt->execute()) {
            $res['error'] = false;
            $res['message'] = "Item Added Successfully";
        } else {
            $res['error'] = true;
            $res['message'] = "Something Went Wrong";

            // Log SQL error for debugging
            error_log($stmt->error);
        }
        $stmt->close();
    }
}


// Log the response data for debugging
error_log(json_encode($res));

header('Content-Type: application/json');
echo json_encode($res);
