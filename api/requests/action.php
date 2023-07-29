<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error_log.txt');

require_once "../database/db.php";
require_once "../cors/CorsHandler.php";

$corsHandler = new CorsHandler();
$corsHandler->handleCors();

class RequestHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = new DB();
    }

    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod) {
            case 'POST':
                $this->handlePostRequest();
                break;
            default:
                echo 'Invalid request method.';
                break;
        }

        $this->connection->close();
    }

    private function handlePostRequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['sku']) && isset($data['name']) && isset($data['price'])) {
            $sku = $data['sku'];
            $name = $data['name'];
            $price = $data['price'];

            $sql = "INSERT INTO `products` (`sku`, `name`, `price`) VALUES ('$sku', '$name', '$price');";

            if ($this->connection->link->query($sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->connection->link->error;
            }
        } else if (isset($data['action']) && $data['action'] === 'deleteProducts' && isset($data['productIds'])) {
            $productIds = $data['productIds'];
            $productIds = array_map('intval', $productIds);

            $productIdList = implode(',', $productIds);
            $sql = "DELETE FROM `products` WHERE `id` IN ($productIdList)";

            if ($this->connection->link->query($sql)) {
                echo count($productIds) . " records deleted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->connection->link->error;
            }
        } else {
            echo "Error: Invalid data format.";
        }
    }
}

$requestHandler = new RequestHandler();
$requestHandler->handleRequest();
