<?php

namespace LinkageCrm\CriticalAlertingBundle\Validator;

class EnvValidator
{
    private const REQUIRE_ENVS = ['CRITICAL_ALERTING_PROJECT_NAME', 'CRITICAL_ALERTING_TG_BOT_TOKEN', 'CRITICAL_ALERTING_TG_CHAT_ID'];

    public function validate(): bool
    {
        foreach (self::REQUIRE_ENVS as $envName) {
            if (!isset($_ENV[$envName])) {
                return false;
            }
        }

        return self::isAppEnvProd();
    }

    public function isAppEnvProd(): bool
    {
        return isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'prod';
    }
}