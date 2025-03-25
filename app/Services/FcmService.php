<?php
namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;



class FcmService
{

    public function sendNotification($user, $title, $body)
    {
        $credentialsPath = env('FIREBASE_CREDENTIALS');

        // Проверяем, что путь не пустой
        if (empty($credentialsPath)) {
            throw new \Exception('Firebase credentials path is not set.');
        }

        // Создаем объект Firebase с использованием файла учетных данных
        $firebase = (new Factory)
            ->withServiceAccount($credentialsPath)  // Используем путь из конфигурации
            ->createMessaging();

        // Проверяем, есть ли у пользователя токен FCM
        if (!$user->fcm_token) {
            return false;
        }

        // Формируем сообщение
        $message = CloudMessage::withTarget('token', $user->fcm_token)
            ->withNotification(Notification::create($title, $body));

        // Отправляем уведомление
        $firebase->send($message);
    }
}
