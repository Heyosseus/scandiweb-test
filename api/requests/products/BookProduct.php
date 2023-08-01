<?php

namespace requests\products;

use requests\crud\CreateRequestHandler;

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
}
