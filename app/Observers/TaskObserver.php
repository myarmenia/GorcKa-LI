<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Str;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function creating(Task $task): void
    {
        // Автоопределение locale, если не установлено
        if (empty($task->locale)) {
            $task->locale = self::detectLocaleSmart($task->title);
        }

        // Автоматическая генерация slug
        if (empty($task->slug)) {
            $task->slug = self::generateUniqueSlug($task->title, $task->locale);
        }
    }


    public function updating(Task $task): void
    {
        // Если изменился title или locale — пересоздаем slug
        if ($task->isDirty('title') || $task->isDirty('locale')) {
            $task->slug = self::generateUniqueSlug($task->title, $task->locale);
        }
    }

    private static function generateUniqueSlug(string $title, string $locale): string
    {
        $slug = self::transliterateToSlug($title);
        $original = $slug;
        $count = 1;

        while (Task::where('slug', $slug)->where('locale', $locale)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }

    private static function transliterateToSlug(string $title): string
    {
        $translit = [
            // Armenian
            'ա' => 'a',
            'բ' => 'b',
            'գ' => 'g',
            'դ' => 'd',
            'ե' => 'e',
            'զ' => 'z',
            'է' => 'e',
            'ը' => 'y',
            'թ' => 't',
            'ժ' => 'zh',
            'ի' => 'i',
            'լ' => 'l',
            'խ' => 'kh',
            'ծ' => 'ts',
            'կ' => 'k',
            'հ' => 'h',
            'ձ' => 'dz',
            'ղ' => 'gh',
            'ճ' => 'ch',
            'մ' => 'm',
            'յ' => 'y',
            'ն' => 'n',
            'շ' => 'sh',
            'ո' => 'o',
            'չ' => 'ch',
            'պ' => 'p',
            'ջ' => 'j',
            'ռ' => 'r',
            'ս' => 's',
            'վ' => 'v',
            'տ' => 't',
            'ր' => 'r',
            'ց' => 'ts',
            'ու' => 'u',
            'և' => 'yev',
            'օ' => 'o',
            'ֆ' => 'f',

            // Russian
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        ];

        $title = mb_strtolower($title);

        // Специальная обработка 'ո'
        $title = preg_replace_callback('/\bո/u', function ($match) {
            return 'vo';
        }, $title); // Это если хочешь сохранять 'vo' в начале слова

        // Чтобы более корректно, сделаем замену по словам:
        $words = explode(' ', $title);
        foreach ($words as &$word) {
            if (mb_substr($word, 0, 1) === 'ո') {
                // если слово начинается с 'ո', заменить первый символ на 'vo'
                $word = 'vo' . mb_substr($word, 1);
            }
            // остальное 'ո' внутри слова остаётся 'o' — мы уже заменили на 'o' выше
        }
        $title = implode(' ', $words);

        // Заменяем остальные символы армянские
        $title = strtr($title, $translit);

        return Str::slug($title);
    }

    private static function detectLocaleSmart(string $text): string
    {
        // 1. Unicode (буквы реального алфавита)
        $locale = self::detectLocaleFromUnicode($text);
        if ($locale !== 'en') {
            return $locale;
        }

        // 2. Транслитерация (по паттернам)
        return self::detectLocaleFromTranslit($text);
    }

    private static function detectLocaleFromUnicode(string $text): string
    {
        if (preg_match('/[\x{0530}-\x{058F}]/u', $text)) {
            return 'hy';
        }

        if (preg_match('/[\x{0400}-\x{04FF}]/u', $text)) {
            return 'ru';
        }

        return 'en';
    }

    private static function detectLocaleFromTranslit(string $text): string
    {
        $text = strtolower($text);

        // Армянская транслитерация (латиницей)
        $armenianPatterns = ['ts', 'gh', 'kh', 'sh', 'dz', 'avor', 'ogh', 'yan', 'tun', 'arutyun', 'barev', 'yi'];
        foreach ($armenianPatterns as $pattern) {
            if (str_contains($text, $pattern)) {
                return 'hy';
            }
        }

        // Русская транслитерация (латиницей)
        $russianPatterns = ['sh', 'zh', 'ch', 'ya', 'yo', 'yu', 'ov', 'ski', 'nik', 'razrabot', 'privet'];
        foreach ($russianPatterns as $pattern) {
            if (str_contains($text, $pattern)) {
                return 'ru';
            }
        }

        return 'en';
    }

    /**
     * Остальные события (не используются пока)
     */
    public function updated(Task $task): void
    {
    }
    public function deleted(Task $task): void
    {
    }
    public function restored(Task $task): void
    {
    }
    public function forceDeleted(Task $task): void
    {
    }
}
