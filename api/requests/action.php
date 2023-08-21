<?php

namespace requests;
error_reporting(E_ALL);
require_once "../config/autoloader.php";

use database\db;
use cors\CorsHandler;

$corsHandler = new CorsHandler();
$corsHandler->handleCors();

abstract class RequestHandler
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new DB();
    }

    abstract public function handleRequest();
}

function createRequestHandler(string $requestType, $connection, $corsHandler)
{
    switch ($requestType) {
        case 'Book':
            return new \requests\products\BookProduct($connection, $corsHandler);
        case 'DVD':
            return new \requests\products\DVDProduct($connection,   $corsHandler);
        case 'Furniture':
            return new \requests\products\FurnitureProduct($connection, $corsHandler);
        default:
            echo 'Invalid product type.';
            exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['type'])) {
        echo 'Invalid request. Product type is missing.';
        exit();
    }   

    $requestHandler = createRequestHandler($data['type'], $connection, $corsHandler);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $requestHandler = new \requests\crud\DeleteRequestHandler();
} else {
    echo 'Invalid request method.';
    exit();
}

$requestHandler->handleRequest();