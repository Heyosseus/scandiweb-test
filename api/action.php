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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['sku']) && isset($data['name']) && isset($data['price'])) {
            $sku = $data['sku'];
            $name = $data['name'];
            $price = $data['price'];

            $sql = "INSERT INTO `products` (`sku`,`name`, `price`) VALUES ('$sku','$name', '$price');";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo "Error: Invalid data format.";
        }
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (existing code)

    // Implement the delete functionality
    if (isset($data['action']) && $data['action'] === 'deleteProducts' && isset($data['productIds'])) {
        $productIds = $data['productIds'];
        $productIds = array_map('intval', $productIds); 

        $productIdList = implode(',', $productIds);
        $sql = "DELETE FROM `products` WHERE `id` IN ($productIdList)";

        if (mysqli_query($conn, $sql)) {
            echo count($productIds) . " records deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
