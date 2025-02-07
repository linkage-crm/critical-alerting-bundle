<?php

namespace LinkageCrm\CriticalAlertingBundle\Notificator;

use LinkageCrm\CriticalAlertingBundle\Exception\Validator\NotFoundRequiredEnvException;
use LinkageCrm\CriticalAlertingBundle\Validator\EnvValidator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TelegramNotificator implements NotificatorInterface
{
    private const BASE_URL = 'https://api.telegram.org/bot';
	private const REQUIRE_ENVS = ['TELEGRAM_CRITICAL_ERRORS_BOT_TOKEN', 'TELEGRAM_CRITICAL_ERRORS_CHAT_ID'];

	public static function sendNotification(string $notification): array
    {
        if(!EnvValidator::isAppEnvProd()){
            return [];
        }

		try{
			EnvValidator::validate(self::REQUIRE_ENVS);

			return self::sendRequest('sendMessage', [
                'chat_id'    => $_ENV['TELEGRAM_CRITICAL_ERRORS_CHAT_ID'],
                'text'       => $notification,
                'parse_mode' => 'HTML',
            ]);
		}
		catch (NotFoundRequiredEnvException $e){
			return ['code' => $e->getCode(), 'success' => false, 'message' => $e->getMessage()];
		}
    }

    private static function sendRequest(string $action, array $requestData): array
    {
        $botToken = $_ENV['TELEGRAM_CRITICAL_ERRORS_BOT_TOKEN'];

        $httpClient = HttpClient::create();
        $url = self::BASE_URL."$botToken/$action";

        try{
            $response = $httpClient->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestData,
            ]);

            $content = $response->getContent(false);
            return json_decode($content, true);
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            return ['code' => $e->getCode(), 'success' => false, 'message' => $e->getMessage()];
        }
    }
}