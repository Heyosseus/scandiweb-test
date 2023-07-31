<?php
namespace requests;

class CreateRequestHandler extends RequestHandler
{
    public function handleRequest()
    {
        $this->create();
        $this->connection->close();
    }
}
