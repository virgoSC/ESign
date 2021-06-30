<?php

namespace ESign\Response\Organizations;

use ESign\Response\Response;

class Seals extends Response
{

    private $seals;

    private $total;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->seals = $this->body['seals'];
            $this->total = $this->body['total'];
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeals()
    {
        return $this->seals;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

}
