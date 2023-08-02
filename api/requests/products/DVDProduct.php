<?php

namespace requests\products;

use requests\crud\CreateRequestHandler;
use models\Product;

class DVDProduct extends CreateRequestHandler
{
    protected function getProductType()
    {
        return 'DVD';
    }

    protected function getProductAttributes(array $data)
    {
        return [
            'size' => $data['size']
        ];
    }
    protected function createProductInstance()
    {
        return new Product();
    }
}
