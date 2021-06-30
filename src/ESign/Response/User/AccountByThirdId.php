<?php

namespace ESign\Response\User;

use ESign\Response\Response;

class AccountByThirdId extends Response
{

    public function resolve(): Response
    {
        parent::resolve();

        return $this;
    }
}
