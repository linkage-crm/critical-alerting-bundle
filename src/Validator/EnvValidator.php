<?php

namespace LinkageCrm\CriticalAlertingBundle\Validator;

use LinkageCrm\CriticalAlertingBundle\Exception\Validator\NotFoundRequiredEnvException;

class EnvValidator
{
    /**
     * @throws NotFoundRequiredEnvException
     */
    public static function validate(array $requireEnvs): void
    {
        foreach ($requireEnvs as $envName) {
            if (!isset($_ENV[$envName])) {
                throw new NotFoundRequiredEnvException($envName);
            }
        }
    }

    public static function isAppEnvProd(): bool
    {
        return isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'prod';
    }
}