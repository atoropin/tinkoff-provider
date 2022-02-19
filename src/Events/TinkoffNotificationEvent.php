<?php

namespace TinkoffProvider\Events;

class TinkoffNotificationEvent
{
    protected array $requestPayload;

    public function __construct(array $requestPayload)
    {
        $this->requestPayload = $requestPayload;
    }

    public function getRequestPayload()
    {
        return $this->requestPayload;
    }
}
