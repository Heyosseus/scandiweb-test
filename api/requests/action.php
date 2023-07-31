<?php

namespace requests;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error_log.txt');


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

    protected function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['sku']) && isset($data['name']) && isset($data['price'])) {
            $sku = $data['sku'];
            $name = $data['name'];
            $price = $data['price'];

            $sql = "INSERT INTO `products` (`sku`, `name`, `price`) VALUES ('$sku', '$name', '$price');";

            $data = $this->connection->link->query($sql);

            return $data;
        }
    }

    protected function delete()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['action']) && $data['action'] === 'deleteProducts' && isset($data['productIds'])) {
            $productIds = $data['productIds'];
            $productIds = array_map('intval', $productIds);

            $productIdList = implode(',', $productIds);
            $sql = "DELETE FROM `products` WHERE `id` IN ($productIdList)";

            $data = $this->connection->link->query($sql);

            return $data;
        }
    }
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
switch ($requestMethod) {
    case 'POST':
        $requestHandler = new \requests\crud\CreateRequestHandler();
        break;
    case 'DELETE':
        $requestHandler = new \requests\crud\DeleteRequestHandler();
        break;
    default:
        echo 'Invalid request method.';
        exit();
}
$requestHandler->handleRequest();
