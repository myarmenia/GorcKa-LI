<?php
namespace App\Services\FCM;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FCMService
{

    public static function sendNotification($user, $title, $body)
    {
        $credentialsPath = storage_path(env('FIREBASE_CREDENTIALS'));
        // $credentialsPath = storage_path('app/public/fierbase/fierbase-credential.json');

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
        // dd($message);

        // Отправляем уведомление
        $firebase->send($message);
        // dd($message);
    }




}
