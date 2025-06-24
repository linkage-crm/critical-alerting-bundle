<?php

namespace LinkageCrm\CriticalAlertingBundle\Validator;

use LinkageCrm\CriticalAlertingBundle\Exception\Notifiable\AbstractNotifiableException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionValidator
{
    public function validate(\Throwable $e): bool
    {
        return !($e instanceof AbstractNotifiableException)
            && !($e instanceof NotFoundHttpException);
    }
}