<?php

namespace ESign\Response\SignFlows;

use ESign\Response\Response;

class FlowOneStep extends Response
{
    private $flowId;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->flowId = $this->body['flowId'] ?? '';
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlowId()
    {
        return $this->flowId;
    }

}
