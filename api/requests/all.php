<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error_log.txt');

require_once "../database/db.php";
require_once "../cors/CorsHandler.php";

$corsHandler = new CorsHandler();
$corsHandler->handleCors();

class RetrieveData
{
    public $response = array('error' => false);
    public $action = '';
    private $connection;

    public function __construct($action)
    {
        $this->action = $action;
        $this->connection = new DB();
    }

    public function retrieve()
    {
        if ($this->action === 'getProducts') {
            $this->response = $this->getProducts();
            echo json_encode($this->response);
        } else {
            echo 'Invalid action.';
        }

        $this->connection->close();
        return $this->response;
    }

    public function getProducts()
    {
        $query = "SELECT * FROM products ORDER BY id DESC";
        $result = $this->connection->query($query);

        if (!$result) {
            $error = array('error' => true, 'message' => 'Failed to fetch products from the database: ' . $this->connection->error);
            return $error;
        }

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}

$action = 'getProducts';
$dataRetriever = new RetrieveData($action);
$response = $dataRetriever->retrieve();
