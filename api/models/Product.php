<?php

namespace models;

use database\DB;

class Product
{
    protected $connection;

    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attributes = [];

    public function __construct()
    {
        $this->connection = new DB();
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setAttribute($attributeName, $attributeValue)
    {
        $this->attributes[$attributeName] = $attributeValue;
    }

    public function save()
    {
        $sql = "INSERT INTO `products` (`sku`, `name`, `price`, `type`, ";
        $values = "VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', ";

        foreach ($this->attributes as $attributeName => $attributeValue) {
            $sql .= "`$attributeName`, ";
            $values .= "'$attributeValue', ";
        }

        $sql = rtrim($sql, ', ') . ') ';
        $values = rtrim($values, ', ') . ');';

        $sql .= $values;

        $this->connection->link->query($sql);
    }

    public function closeConnection()
    {
        $this->connection->close();
    }
}
