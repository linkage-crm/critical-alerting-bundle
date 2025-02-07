<?php

namespace LinkageCrm\CriticalAlertingBundle\Notificator;

interface NotificatorInterface
{
	public static function sendNotification(string $notification): array;
}