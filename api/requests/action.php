<?php

namespace requests;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['type'])) {
            echo 'Invalid request. Product type is missing.';
            exit();
        }
        switch ($data['type']) {
            case 'Book':
                $requestHandler = new \requests\products\BookProduct($connection, $corsHandler);
                break;
            case 'DVD':
                $requestHandler = new \requests\products\DVDProduct($connection, $corsHandler);
                break;
            case 'Furniture':
                $requestHandler = new \requests\products\FurnitureProduct($connection, $corsHandler);
                break;
            default:
                echo 'Invalid product type.';
                exit();
        }
        break;
    case 'DELETE':
        $requestHandler = new \requests\crud\DeleteRequestHandler();
        break;
    default:
        echo 'Invalid request method.';
        exit();
}
$requestHandler->handleRequest();
