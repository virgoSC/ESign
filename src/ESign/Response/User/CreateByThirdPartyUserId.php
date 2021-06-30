<?php

namespace ESign\Response\User;

use ESign\Response\Response;

class CreateByThirdPartyUserId extends Response
{
    private $accountId;

    public function resolve(): Response
    {
        parent::resolve();
        if ($this->isSuccess()) {
            $this->accountId = $this->body['accountId'] ?? false;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }
}
