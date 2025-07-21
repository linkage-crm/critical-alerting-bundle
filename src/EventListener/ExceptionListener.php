<?php

namespace LinkageCrm\CriticalAlertingBundle\EventListener;

use LinkageCrm\CriticalAlertingBundle\Context\RequestContext;
use LinkageCrm\CriticalAlertingBundle\Entity\TelegramNotification;
use LinkageCrm\CriticalAlertingBundle\Notificator\TelegramNotificator;
use LinkageCrm\CriticalAlertingBundle\Validator\EnvValidator;
use LinkageCrm\CriticalAlertingBundle\Validator\ExceptionValidator;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function __construct(
        private EnvValidator       $envValidator,
        private ExceptionValidator $exceptionValidator,
        private RequestContext     $requestContext,
    ){}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if(!$this->envValidator->validate() || !$this->exceptionValidator->validate($exception)) {
            return ;
        }

        $this->sendTelegramNotification($exception);
    }

    private function sendTelegramNotification(\Throwable $exception): void
    {
        $message = TelegramNotification::createFromThrowable($exception, $this->requestContext);
        TelegramNotificator::sendNotification($message);
    }
}