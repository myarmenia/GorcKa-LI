<?php
namespace App\Services\Chat;

use App\Events\Chat\MessageDeleted;
use App\Events\ChatIndicatorEvent;
use App\Events\MessageSent;
use App\Interfaces\Chat\ChatInterface;
use App\Interfaces\Chat\MessageInterface;
use App\Interfaces\Chat\RoomInterface;
use App\Models\Task;
use App\Services\FileUploadService;
use Throwable;


class MessagesService
{

    public function __construct(
            protected MessageInterface $messageRepository,
            protected RoomInterface $roomRepository

        )
    {
    }

    public function getRoomMessages($roomId)
    {
        return $this->messageRepository->getRoomMessages($roomId);

    }

    public function storeMessage($data)
    {
        try{

            $data->user_id = $this->roomRepository->getInterlocutorId($data->room_id);

            $messageData = $data->toArray();
            $files = $messageData['files'] ?? [];
            unset($messageData['files']);


            $message = $this->messageRepository->store($messageData);

            if (!empty($files)) {
                $files = $this->uploadMessageFiles($files, $message->room_id);

                $message->files()->createMany($files);
            }

            event(new MessageSent($message));   /// chat




            return $message;
        } catch (Throwable $e) {
                return false;
        }

    }

    public function readMessages(int $roomId, int $userId){
        
        $read = $this->messageRepository->readMessages($roomId, $userId);
        $allUnread = $this->messageRepository->getAllUnreadMessagesCount($userId);

        event(new ChatIndicatorEvent($allUnread, $userId));

        return $read;

    }


    public function uploadMessageFiles(array $files, int $roomId): array
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            $path = FileUploadService::upload($file, "chat_files/$roomId");
            $uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'ext' => $file->getClientOriginalExtension()
            ];
        }

        return $uploadedFiles;

    }


    public function deleteMessages($id){

        $message = $this->messageRepository->getById($id);

        event(new MessageDeleted($message));   /// deleted message

        $deleted = $this->messageRepository->delete($id);

        return $deleted;

    }



}
