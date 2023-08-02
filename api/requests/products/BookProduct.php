<?php

namespace requests\products;

use requests\crud\CreateRequestHandler;
use models\Product;

class BookProduct extends CreateRequestHandler
{
    protected function getProductType()
    {
        return 'Book';
    }

    protected function getProductAttributes(array $data)
    {
        return [
            'weight' => $data['weight']
        ];
    }
    protected function createProductInstance()
    {
        return new Product();
    }
}
