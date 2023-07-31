<?php

namespace requests\crud;

use requests\RequestHandler;

class CreateRequestHandler extends RequestHandler
{
    public function handleRequest()
    {
        $this->create();
        $this->connection->close();
    }
}
