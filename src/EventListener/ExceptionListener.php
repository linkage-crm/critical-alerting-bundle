<?php

namespace LinkageCrm\CriticalAlertingBundle\EventListener;

use LinkageCrm\CriticalAlertingBundle\Exception\Notificiable\AbstractNotifiableException;
use LinkageCrm\CriticalAlertingBundle\Entity\TelegramNotification;
use LinkageCrm\CriticalAlertingBundle\Notificator\TelegramNotificator;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
		
		if(self::isExceptionNotifiable($exception)) {
			return ;
		}
		
		$this->sendTelegramNotification($exception);
    }
	
	private function sendTelegramNotification(\Throwable $exception): void
	{
		$message = TelegramNotification::createFromThrowable($exception);
		TelegramNotificator::sendNotification($message);
	}
	
	private static function isExceptionNotifiable(\Throwable $exception): bool
	{
		return $exception instanceof AbstractNotifiableException;
	}
}