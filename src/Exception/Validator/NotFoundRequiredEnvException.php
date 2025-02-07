<?php

namespace LinkageCrm\CriticalAlertingBundle\Exception\Validator;

use Throwable;

class NotFoundRequiredEnvException extends \Exception
{
	public function __construct(string $envName = "", int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct("Not found required env variable: " . $envName, $code, $previous);
	}
}