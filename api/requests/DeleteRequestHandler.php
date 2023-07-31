<?php

namespace requests;

class DeleteRequestHandler extends RequestHandler
{
    public function handleRequest()
    {
        $this->delete();
        $this->connection->close();
    }
}
