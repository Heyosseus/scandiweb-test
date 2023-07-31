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
