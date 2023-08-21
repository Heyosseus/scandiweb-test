<?php

namespace requests\all;

require_once "../config/autoloader.php";
use cors\CorsHandler;
use database\DB;
$corsHandler = new CorsHandler();
$corsHandler->handleCors();

$action = 'getProducts';
$dataRetriever = new RetrieveData($action);
$response = $dataRetriever->retrieve();

class RetrieveData
{
    public $response = array('error' => false);
    public $action = '';
    protected $connection;

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

        $data = $this->connection->fetchAll($result);

        return $data;
    }
}
