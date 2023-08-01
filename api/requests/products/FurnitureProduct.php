<?php

namespace requests\products;

use requests\crud\CreateRequestHandler;

class FurnitureProduct extends CreateRequestHandler
{
    protected function getProductType()
    {
        return 'Other';
    }

    protected function getProductAttributes(array $data)
    {
        $height = $data['height'];
        $width = $data['width'];
        $length = $data['length'];
        $dimensions = array('height' => $height, 'width' => $width, 'length' => $length);

        return [
            'dimensions' => json_encode($dimensions)
        ];
    }
}
