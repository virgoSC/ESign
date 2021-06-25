<?php

namespace ESign\Response\File;

use ESign\Response\Response;

class FileUpload extends Response
{
    public function resolve(): Response
    {
        parent::resolve();

        if (($errCode = $this->body['errCode'] ?? false) OR $errCode === 0) {
            if ($this->body['msg'] ?? false == '成功') {
                $this->body = $this->body['msg'];
                return $this;
            }
        }

        $this->setError($this->getBody());
        return $this;
    }
}
