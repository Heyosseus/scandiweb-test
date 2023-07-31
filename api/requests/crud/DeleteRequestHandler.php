<?php

namespace requests\crud;

use requests\RequestHandler;

class DeleteRequestHandler extends RequestHandler
{
    public function handleRequest()
    {
        $this->delete();
        $this->connection->close();
    }
}
