<?php

namespace ESign\Response\File;

use ESign\Response\Response;

class Components extends Response
{
    public function resolve(): Response
    {
        parent::resolve();

        if (($code = $this->body['code'] ?? false) OR $code === 0) {
            if ($this->body['message'] ?? false == 'message') {
                $this->body = $this->body['message'];
                return $this;
            }
        }

        $this->setError($this->getBody());
        return $this;
    }
}
