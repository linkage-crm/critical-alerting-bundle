<?php

namespace LinkageCrm\CriticalAlertingBundle\Exception\Notificiable;

use LinkageCrm\CriticalAlertingBundle\Entity\TelegramNotification;
use LinkageCrm\CriticalAlertingBundle\Notificator\TelegramNotificator;

class TelegramNotifiableException extends AbstractNotifiableException
{
	protected function notify(): void
	{
		$notification = TelegramNotification::createFromThrowable($this);
		TelegramNotificator::sendNotification($notification);
	}
}