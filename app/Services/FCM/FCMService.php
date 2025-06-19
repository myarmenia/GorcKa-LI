<?php
namespace App\Services\FCM;
use Exception;
use Kreait\Firebase\Exception\Messaging\InvalidArgument;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Log;

class FCMService
{

    public static function sendNotification($user, $title, $body)
    {
        try {
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

            return true;

        } catch (NotFound $e) {
            // Firebase сообщил, что токен не существует — удаляем его
            Log::warning("FCM token not found. Deleting token for user ID {$user->id}");
            dd(1);
            return false;

        } catch (InvalidArgument $e) {
            Log::error("FCM InvalidArgument for user ID {$user->id}: " . $e->getMessage());
            dd(2);

            return false;

        } catch (Exception $e) {
            Log::error("FCM general error for user ID {$user->id}: " . $e->getMessage());
            dd(3);

            return false;
        }
    }




}
