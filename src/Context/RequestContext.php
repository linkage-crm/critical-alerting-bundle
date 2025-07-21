<?php

namespace LinkageCrm\CriticalAlertingBundle\Context;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestContext
{
    private ?Request $request = null;

    public function __construct(
        RequestStack $requestStack
    ){
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getReferer(): ?string
    {
        return $this->request?->headers->get('referer');
    }
}