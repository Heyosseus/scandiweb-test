<?php

namespace requests\crud;

use requests\RequestHandler;

abstract class CreateRequestHandler extends RequestHandler
{
    abstract protected function getProductType();

    abstract protected function getProductAttributes(array $data);

    public function handleRequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['sku']) && isset($data['name']) && isset($data['price'])) {
            $sku = $data['sku'];
            $name = $data['name'];
            $price = $data['price'];
            $type = $this->getProductType();

            $productAttributes = $this->getProductAttributes($data);

            $sql = "INSERT INTO `products` (`sku`, `name`, `price`, `type`, ";
            $values = "VALUES ('$sku', '$name', '$price', '$type', ";

            foreach ($productAttributes as $attributeName => $attributeValue) {
                $sql .= "`$attributeName`, ";
                $values .= "'$attributeValue', ";
            }

            $sql = rtrim($sql, ', ') . ') ';
            $values = rtrim($values, ', ') . ');';

            $sql .= $values;

            $this->connection->link->query($sql);
        }

        $this->connection->close();
    }
}
