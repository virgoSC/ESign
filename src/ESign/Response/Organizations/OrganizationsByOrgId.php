<?php

namespace ESign\Response\Organizations;

use ESign\Response\Response;

class OrganizationsByOrgId extends Response
{

    private $info;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->info = $this->body;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }
}
