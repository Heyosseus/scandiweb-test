<?php

namespace requests\products;

use requests\crud\CreateRequestHandler;

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
}
