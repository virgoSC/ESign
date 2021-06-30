<?php

namespace ESign\District;

use ESign\Response\File\Components;
use ESign\UrlSet;
use ESign\Response\SignFlows\FlowOneStep as FlowOneStopResponse;

class FlowOneStep extends District
{
    public function createFlowOneStep(OneStepConfig $oneStepConfig): self
    {
        $this->setUrl(UrlSet::$set['flowOneStep']);

        $this->setMethod(self::$POST);

        $this->setResponse(FlowOneStopResponse::class);

        $this->setParameter($oneStepConfig->generate());

        return $this;
    }
}
