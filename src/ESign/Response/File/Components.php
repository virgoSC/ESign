<?php

namespace ESign\Response\File;

use ESign\Response\Response;

class Components extends Response
{
    public function resolve(): Response
    {
        parent::resolve();

        return $this;
    }
}
