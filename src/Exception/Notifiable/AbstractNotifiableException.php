<?php

namespace LinkageCrm\CriticalAlertingBundle\Exception\Notifiable;

abstract class AbstractNotifiableException extends \Exception
{
	public function __construct($message = "", $code = 0, $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->notify();
	}
	
	abstract protected function notify():void;
}