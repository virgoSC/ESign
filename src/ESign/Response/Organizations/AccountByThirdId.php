<?php

namespace ESign\Response\Organizations;

use ESign\Response\Response;

class AccountByThirdId extends Response
{

    private $orgId;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->orgId = $this->body['orgId'];
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrgId()
    {
        return $this->orgId;
    }
}
