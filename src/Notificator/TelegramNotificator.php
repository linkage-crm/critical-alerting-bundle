<?php

namespace LinkageCrm\CriticalAlertingBundle\Notificator;

use Symfony\Component\HttpClient\HttpClient;

class TelegramNotificator implements NotificatorInterface
{
    private const BASE_URL = 'https://api.telegram.org/bot';

    public static function sendNotification(string $notification): array
    {
        return self::sendRequest('sendMessage', [
            'chat_id'    => $_ENV['CRITICAL_ALERTING_TG_CHAT_ID'],
            'text'       => $notification,
            'parse_mode' => 'HTML',
        ]);
    }

    private static function sendRequest(string $action, array $requestData): array
    {
        $botToken = $_ENV['CRITICAL_ALERTING_TG_BOT_TOKEN'];

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
        } catch (\Throwable $e) {
            return ['code' => $e->getCode(), 'success' => false, 'message' => $e->getMessage()];
        }
    }
}