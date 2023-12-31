<?php

namespace requests\crud;

use requests\RequestHandler;

class DeleteRequestHandler extends RequestHandler
{
    public function handleRequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['action']) && $data['action'] === 'deleteProducts' && isset($data['productIds'])) {
            $productIds = $data['productIds'];
            $productIds = array_map('intval', $productIds);

            $productIdList = implode(',', $productIds);
            $sql = "DELETE FROM `products` WHERE `id` IN ($productIdList)";

            $result = $this->connection->link->query($sql);

            if ($result) {
                echo 'Products deleted successfully.';
            } else {
                echo 'Error while deleting products.';
            }
        } else {
            echo 'Invalid request.';
        }

        $this->connection->close();
    }
}
