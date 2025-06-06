<?php
namespace App\Services\User;


use App\Helpers\Helper;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Services\FileUploadService;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function __construct(protected UserInterface $userRepository)
    {
    }

    public function update($dataDto)
    {

        $user = Auth::user();
        $authId = $user->id;


        if($dataDto->avatar){

            $file  = $dataDto->avatar;
            $path = FileUploadService::upload($file, "user_avatar/$authId");

            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $dataDto->avatar = $path;
        }

        if($dataDto->remove_avatar){

            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

        }


        if (!empty($dataDto->work_images)) {
            foreach ($dataDto->work_images as $imageFile) {
                $path = FileUploadService::upload($imageFile, "user_work_images/$authId");

                $user->files()->create([
                    'name' => $imageFile->getClientOriginalName(),
                    'path' => $path,
                    'ext' => $imageFile->getClientOriginalExtension()
                ]);
            }
        }

        $this->socialMedia($dataDto, $user);
        $userData = $dataDto->toArray();




        return $this->userRepository->update($authId, $userData);

    }


    protected function socialMedia($dataDto, $user)
    {
        $socials = collect($dataDto->socials?->toArray() ?? [])->filter()->all();


        $user->social_medias()->delete();

        $prefixes = Helper::socialMedias();

        foreach ($socials as $type => $value) {

            // if (!$value || !array_key_exists($type, $prefixes)) {
            //     continue;
            // }
            if (
                !$value ||
                !array_key_exists($type, $prefixes) ||
                empty($prefixes[$type]['link'])
            ) {
                continue;
            }

            $prefix = $prefixes[$type]['link']; // Пример: https://www.facebook.com/
            $host = parse_url($prefix, PHP_URL_HOST); // Получаем: www.facebook.com

            // Удаляем схему, www и домен — оставляем только "хвост"
            $value = preg_replace(
                '#^(https?:\/\/)?(www\.)?' . preg_quote(str_replace('www.', '', $host), '#') . '\/?#i',
                '',
                $value
            );

            // Добавляем корректный префикс
            $value = rtrim($prefix, '/') . '/' . ltrim($value, '/');

            $user->social_medias()->updateOrCreate(
                ['type' => $type],
                ['link' => $value]
            );
        }

    }


    public function getUser()
    {

        return $this->userRepository->getItemByIdWithRel(Auth::id(), ['social_medias:user_id,type,link', 'files:id,filable_id,path,name']);

    }
}
