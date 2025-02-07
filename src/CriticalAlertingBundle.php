<?php

namespace LinkageCrm\CriticalAlertingBundle;

use LinkageCrm\CriticalAlertingBundle\DependencyInjection\LinkageCrmCriticalAlertingExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CriticalAlertingBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?LinkageCrmCriticalAlertingExtension
    {
        return new LinkageCrmCriticalAlertingExtension();
    }
}