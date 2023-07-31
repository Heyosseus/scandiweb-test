<?php

namespace requests\crud;

use requests\RequestHandler;

class CreateRequestHandler extends RequestHandler
{
    public function handleRequest()
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

        $this->connection->close();
    }
}
