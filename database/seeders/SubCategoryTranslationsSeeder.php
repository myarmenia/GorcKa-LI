<?php

namespace Database\Seeders;

use App\Models\SubCategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sub_category_id' => 1,
                'lang' => 'am',
                'name' => 'Համակարգչային օգնություն'
            ],
            [
                'sub_category_id' => 1,
                'lang' => 'ru',
                'name' => 'Компьютерная помощь'
            ],
            [
                'sub_category_id' => 1,
                'lang' => 'en',
                'name' => 'Computer help'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'am',
                'name' => 'Ծրագրային ապահովման մշակում'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'ru',
                'name' => 'Разработка программного обеспечения'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'en',
                'name' => 'Software development'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'am',
                'name' => 'CMS կայքեր'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Сайты CMS'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'en',
                'name' => 'CMS Sites'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'am',
                'name' => 'Ադմինիստրատիվ աշխատանք'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Административная работа'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'en',
                'name' => 'Administrative work'
            ],
            [
                'sub_category_id' => 5,
                'lang' => 'am',
                'name' => 'Կայքերի ստեղծում'
            ],
            [
                'sub_category_id' => 5,
                'lang' => 'ru',
                'name' => 'Создание сайтов'
            ],
            [
                'sub_category_id' => 5,
                'lang' => 'en',
                'name' => 'Website creation'
            ],
            [
                'sub_category_id' => 6,
                'lang' => 'am',
                'name' => 'Քարթրիջների լիցքավորում'
            ],
            [
                'sub_category_id' => 6,
                'lang' => 'ru',
                'name' => 'Заправка картриджей'
            ],
            [
                'sub_category_id' => 6,
                'lang' => 'en',
                'name' => 'Refilling cartridges'
            ],
            [
                'sub_category_id' => 7,
                'lang' => 'am',
                'name' => 'Բջջային հավելվածի ստեղծում'
            ],
            [
                'sub_category_id' => 7,
                'lang' => 'ru',
                'name' => 'Создание мобильного приложения'
            ],
            [
                'sub_category_id' => 7,
                'lang' => 'en',
                'name' => 'Creating a mobile app'
            ],
            [
                'sub_category_id' => 8,
                'lang' => 'am',
                'name' => 'Խաղերի ստեղծում'
            ],
            [
                'sub_category_id' => 8,
                'lang' => 'ru',
                'name' => 'Создание игр'
            ],
            [
                'sub_category_id' => 8,
                'lang' => 'en',
                'name' => 'Creating games'
            ],
            [
                'sub_category_id' => 9,
                'lang' => 'am',
                'name' => 'Անվտանգության համակարգեր և մուտքի վերահսկում'
            ],
            [
                'sub_category_id' => 9,
                'lang' => 'ru',
                'name' => 'Системы безопасности и контроля доступа'
            ],
            [
                'sub_category_id' => 9,
                'lang' => 'en',
                'name' => 'Security and access control systems'
            ],
            [
                'sub_category_id' => 10,
                'lang' => 'am',
                'name' => 'Անվադողերի սպասարկում'
            ],
            [
                'sub_category_id' => 10,
                'lang' => 'ru',
                'name' => 'Шиномонтаж'
            ],
            [
                'sub_category_id' => 10,
                'lang' => 'en',
                'name' => 'Tire maintenance'
            ],
            [
                'sub_category_id' => 11,
                'lang' => 'am',
                'name' => 'Թափքի վերանորոգում'
            ],
            [
                'sub_category_id' => 11,
                'lang' => 'ru',
                'name' => 'Ремонт кузова'
            ],
            [
                'sub_category_id' => 11,
                'lang' => 'en',
                'name' => 'Body repair'
            ],
            [
                'sub_category_id' => 12,
                'lang' => 'am',
                'name' => 'Ախտորոշում'
            ],
            [
                'sub_category_id' => 12,
                'lang' => 'ru',
                'name' => 'Диагностика'
            ],
            [
                'sub_category_id' => 12,
                'lang' => 'en',
                'name' => 'Diagnostics'
            ],
            [
                'sub_category_id' => 13,
                'lang' => 'am',
                'name' => 'Ապակու փոխարինում'
            ],
            [
                'sub_category_id' => 13,
                'lang' => 'ru',
                'name' => 'Замена стекла'
            ],
            [
                'sub_category_id' => 13,
                'lang' => 'en',
                'name' => 'Glass replacement'
            ],
            [
                'sub_category_id' => 14,
                'lang' => 'am',
                'name' => 'Մեքենայի կախոցներ'
            ],
            [
                'sub_category_id' => 14,
                'lang' => 'ru',
                'name' => 'Автомобильные подвески'
            ],
            [
                'sub_category_id' => 14,
                'lang' => 'en',
                'name' => 'Car suspensions'
            ],
            [
                'sub_category_id' => 15,
                'lang' => 'am',
                'name' => 'Ղեկ'
            ],
            [
                'sub_category_id' => 15,
                'lang' => 'ru',
                'name' => 'Рулевое колесо'
            ],
            [
                'sub_category_id' => 15,
                'lang' => 'en',
                'name' => 'Rudder'
            ],
            [
                'sub_category_id' => 16,
                'lang' => 'am',
                'name' => 'Անիվների հավասարեցում'
            ],
            [
                'sub_category_id' => 16,
                'lang' => 'ru',
                'name' => 'Выравнивание колес'
            ],
            [
                'sub_category_id' => 16,
                'lang' => 'en',
                'name' => 'Wheel alignment'
            ],
            [
                'sub_category_id' => 17,
                'lang' => 'am',
                'name' => 'Արգելակային համակարգ'
            ],
            [
                'sub_category_id' => 17,
                'lang' => 'ru',
                'name' => 'Тормозная система'
            ],
            [
                'sub_category_id' => 17,
                'lang' => 'en',
                'name' => 'The braking system'
            ],
            [
                'sub_category_id' => 18,
                'lang' => 'am',
                'name' => 'Բեռնատարների վերանորոգում'
            ],
            [
                'sub_category_id' => 18,
                'lang' => 'ru',
                'name' => 'Ремонт грузовиков'
            ],
            [
                'sub_category_id' => 18,
                'lang' => 'en',
                'name' => 'Truck repairs'
            ],
            [
                'sub_category_id' => 19,
                'lang' => 'am',
                'name' => 'Մեքենայի լվացում և խնամք'
            ],
            [
                'sub_category_id' => 19,
                'lang' => 'ru',
                'name' => 'Мойка и уход за автомобилем'
            ],
            [
                'sub_category_id' => 19,
                'lang' => 'en',
                'name' => 'Car washing and maintenance'
            ],
            [
                'sub_category_id' => 20,
                'lang' => 'am',
                'name' => 'Շարժիչի կապիտալ վերանորոգում'
            ],
            [
                'sub_category_id' => 20,
                'lang' => 'ru',
                'name' => 'Капитальный ремонт двигателя'
            ],
            [
                'sub_category_id' => 20,
                'lang' => 'en',
                'name' => 'Engine overhaul'
            ],
            [
                'sub_category_id' => 21,
                'lang' => 'am',
                'name' => 'Տեխնիկական սպասարկում'
            ],
            [
                'sub_category_id' => 21,
                'lang' => 'ru',
                'name' => 'Техническое обслуживание'
            ],
            [
                'sub_category_id' => 21,
                'lang' => 'en',
                'name' => 'Technical maintenance'
            ],
            [
                'sub_category_id' => 22,
                'lang' => 'am',
                'name' => 'Թյունինգ'
            ],
            [
                'sub_category_id' => 22,
                'lang' => 'ru',
                'name' => 'Настройка'
            ],
            [
                'sub_category_id' => 22,
                'lang' => 'en',
                'name' => 'Customization'
            ],
            [
                'sub_category_id' => 23,
                'lang' => 'am',
                'name' => 'Էլեկտրասարքավորումներ'
            ],
            [
                'sub_category_id' => 23,
                'lang' => 'ru',
                'name' => 'Электрооборудование'
            ],
            [
                'sub_category_id' => 23,
                'lang' => 'en',
                'name' => 'Electrical equipment'
            ],
            [
                'sub_category_id' => 24,
                'lang' => 'am',
                'name' => 'Ներկում'
            ],
            [
                'sub_category_id' => 24,
                'lang' => 'ru',
                'name' => 'Покраска'
            ],
            [
                'sub_category_id' => 24,
                'lang' => 'en',
                'name' => 'Painting'
            ],
            [
                'sub_category_id' => 25,
                'lang' => 'am',
                'name' => 'Բեռնափոխադրումներ'
            ],
            [
                'sub_category_id' => 25,
                'lang' => 'ru',
                'name' => 'Грузоперевозки'
            ],
            [
                'sub_category_id' => 25,
                'lang' => 'en',
                'name' => 'Cargo transportation'
            ],
            [
                'sub_category_id' => 26,
                'lang' => 'am',
                'name' => 'Շինանյութի տեղափոխում'
            ],
            [
                'sub_category_id' => 26,
                'lang' => 'ru',
                'name' => 'Транспортировка строительных материалов'
            ],
            [
                'sub_category_id' => 26,
                'lang' => 'en',
                'name' => 'Transportation of building materials'
            ],
            [
                'sub_category_id' => 27,
                'lang' => 'am',
                'name' => 'Բեռնիչի ծառայություններ'
            ],
            [
                'sub_category_id' => 27,
                'lang' => 'ru',
                'name' => 'Услуги погрузчика'
            ],
            [
                'sub_category_id' => 27,
                'lang' => 'en',
                'name' => 'Loader services'
            ],
            [
                'sub_category_id' => 28,
                'lang' => 'am',
                'name' => 'Աղբի հեռացում'
            ],
            [
                'sub_category_id' => 28,
                'lang' => 'ru',
                'name' => 'Вывоз мусора'
            ],
            [
                'sub_category_id' => 28,
                'lang' => 'en',
                'name' => 'Garbage collection'
            ],
            [
                'sub_category_id' => 29,
                'lang' => 'am',
                'name' => 'Միջքաղաքային տրանսպորտ'
            ],
            [
                'sub_category_id' => 29,
                'lang' => 'ru',
                'name' => 'Междугородний транспорт'
            ],
            [
                'sub_category_id' => 29,
                'lang' => 'en',
                'name' => 'Intercity transport'
            ],
            [
                'sub_category_id' => 30,
                'lang' => 'am',
                'name' => 'Ապրանքների տեղափոխում'
            ],
            [
                'sub_category_id' => 30,
                'lang' => 'ru',
                'name' => 'Перевозка товаров'
            ],
            [
                'sub_category_id' => 30,
                'lang' => 'en',
                'name' => 'Transportation of goods'
            ],
            [
                'sub_category_id' => 31,
                'lang' => 'am',
                'name' => 'Առաքիչ'
            ],
            [
                'sub_category_id' => 31,
                'lang' => 'ru',
                'name' => 'Курьер'
            ],
            [
                'sub_category_id' => 31,
                'lang' => 'en',
                'name' => 'Courier'
            ],
            [
                'sub_category_id' => 32,
                'lang' => 'am',
                'name' => 'Առաքիչ իր ավտոմեքենայով'
            ],
            [
                'sub_category_id' => 32,
                'lang' => 'ru',
                'name' => 'Курьер на своей машине'
            ],
            [
                'sub_category_id' => 32,
                'lang' => 'en',
                'name' => 'The courier in his car'
            ],
            [
                'sub_category_id' => 33,
                'lang' => 'am',
                'name' => 'Մանիպուլյատորների ծառայություններ'
            ],
            [
                'sub_category_id' => 33,
                'lang' => 'ru',
                'name' => 'Услуги манипуляторов'
            ],
            [
                'sub_category_id' => 33,
                'lang' => 'en',
                'name' => 'Manipulator services'
            ],
            [
                'sub_category_id' => 34,
                'lang' => 'am',
                'name' => 'Չափազանց մեծ բեռների տեղափոխում'
            ],
            [
                'sub_category_id' => 34,
                'lang' => 'ru',
                'name' => 'Перевозка негабаритных грузов'
            ],
            [
                'sub_category_id' => 34,
                'lang' => 'en',
                'name' => 'Transportation of oversized cargo'
            ],
            [
                'sub_category_id' => 35,
                'lang' => 'am',
                'name' => 'Ապրանքների տեղափոխում սառնարանով '
            ],
            [
                'sub_category_id' => 35,
                'lang' => 'ru',
                'name' => 'Транспортировка продуктов с помощью холодильника'
            ],
            [
                'sub_category_id' => 35,
                'lang' => 'en',
                'name' => 'Transporting food using a refrigerator'
            ],
            [
                'sub_category_id' => 36,
                'lang' => 'am',
                'name' => 'Քարշակ մեքենաներ'
            ],
            [
                'sub_category_id' => 36,
                'lang' => 'ru',
                'name' => 'Эвакуатор'
            ],
            [
                'sub_category_id' => 36,
                'lang' => 'en',
                'name' => 'Tow trucks'
            ],
            [
                'sub_category_id' => 37,
                'lang' => 'am',
                'name' => 'Կենդանիների միջքաղաքային տեղափոխում'
            ],
            [
                'sub_category_id' => 37,
                'lang' => 'ru',
                'name' => 'Перевозка животных на большие расстояния'
            ],
            [
                'sub_category_id' => 37,
                'lang' => 'en',
                'name' => 'Transportation of animals over long distances'
            ],
            [
                'sub_category_id' => 38,
                'lang' => 'am',
                'name' => 'Միջքաղաքային տեղափոխում'
            ],
            [
                'sub_category_id' => 38,
                'lang' => 'ru',
                'name' => 'Переезд на большие расстояния'
            ],
            [
                'sub_category_id' => 38,
                'lang' => 'en',
                'name' => 'Long-distance travel'
            ],
            [
                'sub_category_id' => 39,
                'lang' => 'am',
                'name' => 'Կենդանիների մազերի խնամք'
            ],
            [
                'sub_category_id' => 39,
                'lang' => 'ru',
                'name' => 'Уход за шерстью домашних животных'
            ],
            [
                'sub_category_id' => 39,
                'lang' => 'en',
                'name' => 'Pet Hair Care'
            ],
            [
                'sub_category_id' => 40,
                'lang' => 'am',
                'name' => 'Ընտանի կենդանու գերբացահայտում'
            ],
            [
                'sub_category_id' => 40,
                'lang' => 'ru',
                'name' => 'Передержка домашнего животного'
            ],
            [
                'sub_category_id' => 40,
                'lang' => 'en',
                'name' => 'Overexposure of a pet'
            ],
            [
                'sub_category_id' => 41,
                'lang' => 'am',
                'name' => 'Տոհմաբանության կազմում'
            ],
            [
                'sub_category_id' => 41,
                'lang' => 'ru',
                'name' => 'Составление генеалогии'
            ],
            [
                'sub_category_id' => 41,
                'lang' => 'en',
                'name' => 'Genealogy compilation'
            ],
            [
                'sub_category_id' => 42,
                'lang' => 'am',
                'name' => 'Վարժեցում'
            ],
            [
                'sub_category_id' => 42,
                'lang' => 'ru',
                'name' => 'Тренировка'
            ],
            [
                'sub_category_id' => 42,
                'lang' => 'en',
                'name' => 'Workout'
            ],
            [
                'sub_category_id' => 43,
                'lang' => 'am',
                'name' => 'հարդարում'
            ],
            [
                'sub_category_id' => 43,
                'lang' => 'ru',
                'name' => 'Груминг'
            ],
            [
                'sub_category_id' => 43,
                'lang' => 'en',
                'name' => 'Grooming'
            ],
            [
                'sub_category_id' => 44,
                'lang' => 'am',
                'name' => 'Սալիկի աշխատանքներ'
            ],
            [
                'sub_category_id' => 44,
                'lang' => 'ru',
                'name' => 'Плиточные работы'
            ],
            [
                'sub_category_id' => 44,
                'lang' => 'en',
                'name' => 'Tile work'
            ],
            [
                'sub_category_id' => 45,
                'lang' => 'am',
                'name' => 'Շենքի նախագծում'
            ],
            [
                'sub_category_id' => 45,
                'lang' => 'ru',
                'name' => 'Проектирование здания'
            ],
            [
                'sub_category_id' => 45,
                'lang' => 'en',
                'name' => 'Building design'
            ],
            [
                'sub_category_id' => 46,
                'lang' => 'am',
                'name' => 'Վարագույրների տեղադրում'
            ],
            [
                'sub_category_id' => 46,
                'lang' => 'ru',
                'name' => 'Установка штор'
            ],
            [
                'sub_category_id' => 46,
                'lang' => 'en',
                'name' => 'Installing curtains'
            ],
            [
                'sub_category_id' => 47,
                'lang' => 'am',
                'name' => 'Պատերի տեղադրում գիպսաստվարաթղթով'
            ],
            [
                'sub_category_id' => 47,
                'lang' => 'ru',
                'name' => 'Установка стен из гипсокартона'
            ],
            [
                'sub_category_id' => 47,
                'lang' => 'en',
                'name' => 'Installation of plasterboard walls'
            ],
            [
                'sub_category_id' => 48,
                'lang' => 'am',
                'name' => 'Գրասենյակի վերանորոգում'
            ],
            [
                'sub_category_id' => 48,
                'lang' => 'ru',
                'name' => 'Ремонт офиса'
            ],
            [
                'sub_category_id' => 48,
                'lang' => 'en',
                'name' => 'Office renovation'
            ],
            [
                'sub_category_id' => 49,
                'lang' => 'am',
                'name' => 'Տանիքապատում'
            ],
            [
                'sub_category_id' => 49,
                'lang' => 'ru',
                'name' => 'Кровля'
            ],
            [
                'sub_category_id' => 49,
                'lang' => 'en',
                'name' => 'Roof'
            ],
            [
                'sub_category_id' => 50,
                'lang' => 'am',
                'name' => 'Տների վերանորոգում'
            ],
            [
                'sub_category_id' => 50,
                'lang' => 'ru',
                'name' => 'Ремонт дома'
            ],
            [
                'sub_category_id' => 50,
                'lang' => 'en',
                'name' => 'Home renovation'
            ],
            [
                'sub_category_id' => 51,
                'lang' => 'am',
                'name' => 'Պաստառ և ներկման աշխատանքներ'
            ],
            [
                'sub_category_id' => 51,
                'lang' => 'ru',
                'name' => 'Обои и покраска'
            ],
            [
                'sub_category_id' => 51,
                'lang' => 'en',
                'name' => 'Wallpaper and painting'
            ],
            [
                'sub_category_id' => 52,
                'lang' => 'am',
                'name' => 'Պատշգամբի վերանորոգում'
            ],
            [
                'sub_category_id' => 52,
                'lang' => 'ru',
                'name' => 'Ремонт балкона'
            ],
            [
                'sub_category_id' => 52,
                'lang' => 'en',
                'name' => 'Balcony renovation'
            ],
            [
                'sub_category_id' => 53,
                'lang' => 'am',
                'name' => 'Ձգվող առաստաղ'
            ],
            [
                'sub_category_id' => 53,
                'lang' => 'ru',
                'name' => 'Натяжной потолок'
            ],
            [
                'sub_category_id' => 53,
                'lang' => 'en',
                'name' => 'Stretch ceiling'
            ],
            [
                'sub_category_id' => 54,
                'lang' => 'am',
                'name' => 'Ապամոնտաժում'
            ],
            [
                'sub_category_id' => 54,
                'lang' => 'ru',
                'name' => 'Демонтаж'
            ],
            [
                'sub_category_id' => 54,
                'lang' => 'en',
                'name' => 'Disassembly'
            ],
            [
                'sub_category_id' => 55,
                'lang' => 'am',
                'name' => 'Օդափոխում'
            ],
            [
                'sub_category_id' => 55,
                'lang' => 'ru',
                'name' => 'Вентиляция'
            ],
            [
                'sub_category_id' => 55,
                'lang' => 'en',
                'name' => 'Ventilation'
            ],
            [
                'sub_category_id' => 56,
                'lang' => 'am',
                'name' => 'Պատի նկարչություն'
            ],
            [
                'sub_category_id' => 56,
                'lang' => 'ru',
                'name' => 'Настенная роспись'
            ],
            [
                'sub_category_id' => 56,
                'lang' => 'en',
                'name' => 'Wall painting'
            ],
            [
                'sub_category_id' => 57,
                'lang' => 'am',
                'name' => 'Աստիճանների տեղադրում'
            ],
            [
                'sub_category_id' => 57,
                'lang' => 'ru',
                'name' => 'Установка лестницы'
            ],
            [
                'sub_category_id' => 57,
                'lang' => 'en',
                'name' => 'Installing stairs'
            ],
            [
                'sub_category_id' => 58,
                'lang' => 'am',
                'name' => 'Աստիճանների տեղադրում'
            ],
            [
                'sub_category_id' => 58,
                'lang' => 'ru',
                'name' => 'Установка лестницы'
            ],
            [
                'sub_category_id' => 58,
                'lang' => 'en',
                'name' => 'Installing stairs'
            ],
            [
                'sub_category_id' => 59,
                'lang' => 'am',
                'name' => 'Մայթաքարերի տեղադրում'
            ],
            [
                'sub_category_id' => 59,
                'lang' => 'ru',
                'name' => 'Установка тротуарной плитки'
            ],
            [
                'sub_category_id' => 59,
                'lang' => 'en',
                'name' => 'Installation of paving slabs'
            ],
            [
                'sub_category_id' => 60,
                'lang' => 'am',
                'name' => 'Բետոնի աշխատանքներ'
            ],
            [
                'sub_category_id' => 60,
                'lang' => 'ru',
                'name' => 'Бетонные работы'
            ],
            [
                'sub_category_id' => 60,
                'lang' => 'en',
                'name' => 'Concrete works'
            ],
            [
                'sub_category_id' => 61,
                'lang' => 'am',
                'name' => 'Աշխատեք բարձրության վրա'
            ],
            [
                'sub_category_id' => 61,
                'lang' => 'ru',
                'name' => 'Работа на высоте'
            ],
            [
                'sub_category_id' => 61,
                'lang' => 'en',
                'name' => 'Working at height'
            ],
            [
                'sub_category_id' => 62,
                'lang' => 'am',
                'name' => 'Լոգարանների վերականգնում և էմալապատում'
            ],
            [
                'sub_category_id' => 62,
                'lang' => 'ru',
                'name' => 'Реставрация и эмалирование ванных комнат'
            ],
            [
                'sub_category_id' => 62,
                'lang' => 'en',
                'name' => 'Restoration and enameling of bathrooms '
            ],
            [
                'sub_category_id' => 63,
                'lang' => 'am',
                'name' => 'Մետաղական կոնստրուկցիաների ապամոնտաժում'
            ],
            [
                'sub_category_id' => 63,
                'lang' => 'ru',
                'name' => 'Демонтаж металлических конструкций'
            ],
            [
                'sub_category_id' => 63,
                'lang' => 'en',
                'name' => 'Dismantling of metal structures'
            ],
            [
                'sub_category_id' => 64,
                'lang' => 'am',
                'name' => 'Ալեհավաքի կարգավորումներ'
            ],
            [
                'sub_category_id' => 64,
                'lang' => 'ru',
                'name' => 'Настройки антенны'
            ],
            [
                'sub_category_id' => 64,
                'lang' => 'en',
                'name' => 'Antenna Settings'
            ],
            [
                'sub_category_id' => 65,
                'lang' => 'am',
                'name' => 'Խճանկարային սալիկների դասավորությունը'
            ],
            [
                'sub_category_id' => 65,
                'lang' => 'ru',
                'name' => 'Укладка мозаичной плитки'
            ],
            [
                'sub_category_id' => 65,
                'lang' => 'en',
                'name' => 'Laying mosaic tiles'
            ],
            [
                'sub_category_id' => 66,
                'lang' => 'am',
                'name' => 'Ախտահանման ծառայություններ'
            ],
            [
                'sub_category_id' => 66,
                'lang' => 'ru',
                'name' => 'Услуги дезинфекции'
            ],
            [
                'sub_category_id' => 66,
                'lang' => 'en',
                'name' => 'Disinfection services'
            ],
            [
                'sub_category_id' => 67,
                'lang' => 'am',
                'name' => 'Տարածքի ախտահանում'
            ],
            [
                'sub_category_id' => 67,
                'lang' => 'ru',
                'name' => 'Дезинфекция территории'
            ],
            [
                'sub_category_id' => 67,
                'lang' => 'en',
                'name' => 'Disinfection of the territory'
            ],
            [
                'sub_category_id' => 68,
                'lang' => 'am',
                'name' => 'Ազատվել բորբոսից և սնկից'
            ],
            [
                'sub_category_id' => 68,
                'lang' => 'ru',
                'name' => 'Избавиться от плесени и грибка'
            ],
            [
                'sub_category_id' => 68,
                'lang' => 'en',
                'name' => 'Get rid of mold and mildew'
            ],
            [
                'sub_category_id' => 69,
                'lang' => 'am',
                'name' => 'Ուտիճների ոչնչացում'
            ],
            [
                'sub_category_id' => 69,
                'lang' => 'ru',
                'name' => 'Уничтожение тараканов'
            ],
            [
                'sub_category_id' => 69,
                'lang' => 'en',
                'name' => 'Cockroach eradication'
            ],
            [
                'sub_category_id' => 70,
                'lang' => 'am',
                'name' => 'Կրծողների ոչնչացում'
            ],
            [
                'sub_category_id' => 70,
                'lang' => 'ru',
                'name' => 'Уничтожение грызунов'
            ],
            [
                'sub_category_id' => 70,
                'lang' => 'en',
                'name' => 'Rodent extermination'
            ],
            [
                'sub_category_id' => 71,
                'lang' => 'am',
                'name' => 'Ախտահանում համաճարակի պայմաններում'
            ],
            [
                'sub_category_id' => 71,
                'lang' => 'ru',
                'name' => 'Дезинфекция в условиях пандемии'
            ],
            [
                'sub_category_id' => 71,
                'lang' => 'en',
                'name' => 'Disinfection in a pandemic'
            ],
            [
                'sub_category_id' => 72,
                'lang' => 'am',
                'name' => 'Ամենօրյա մաքրում'
            ],
            [
                'sub_category_id' => 72,
                'lang' => 'ru',
                'name' => 'Ежедневная уборка'
            ],
            [
                'sub_category_id' => 72,
                'lang' => 'en',
                'name' => 'Daily cleaning service'
            ],
            [
                'sub_category_id' => 73,
                'lang' => 'am',
                'name' => 'Պարբերական մաքրում'
            ],
            [
                'sub_category_id' => 73,
                'lang' => 'ru',
                'name' => 'Периодическая уборка'
            ],
            [
                'sub_category_id' => 73,
                'lang' => 'en',
                'name' => 'Periodic cleaning'
            ],
            [
                'sub_category_id' => 74,
                'lang' => 'am',
                'name' => 'Գարնանային մաքրում'
            ],
            [
                'sub_category_id' => 74,
                'lang' => 'ru',
                'name' => 'Генеральная уборка'
            ],
            [
                'sub_category_id' => 74,
                'lang' => 'en',
                'name' => 'eneral cleaning'
            ],
            [
                'sub_category_id' => 75,
                'lang' => 'am',
                'name' => 'Հատուկ մաքրում'
            ],
            [
                'sub_category_id' => 75,
                'lang' => 'ru',
                'name' => 'Специальная уборка'
            ],
            [
                'sub_category_id' => 75,
                'lang' => 'en',
                'name' => 'Special cleaning'
            ],

            [
                'sub_category_id' => 76,
                'lang' => 'am',
                'name' => 'Ֆինանսական հաշվառում'
            ],
            [
                'sub_category_id' => 76,
                'lang' => 'ru',
                'name' => 'Финансовый учет'
            ],
            [
                'sub_category_id' => 76,
                'lang' => 'en',
                'name' => 'Financial accounting'
            ],
            [
                'sub_category_id' => 77,
                'lang' => 'am',
                'name' => 'Կառավարչական, հարկային, դրամարկղային հաշվառում'
            ],
            [
                'sub_category_id' => 77,
                'lang' => 'ru',
                'name' => 'Управленческий, налоговый, кассовый учет'
            ],
            [
                'sub_category_id' => 77,
                'lang' => 'en',
                'name' => 'Management, tax, and cash accounting'
            ],
            [
                'sub_category_id' => 78,
                'lang' => 'am',
                'name' => 'Հարկեր ֆիզիկական անձանցից'
            ],
            [
                'sub_category_id' => 78,
                'lang' => 'ru',
                'name' => 'Налоги с физических лиц'
            ],
            [
                'sub_category_id' => 78,
                'lang' => 'en',
                'name' => 'Taxes on individuals'
            ],
            [
                'sub_category_id' => 79,
                'lang' => 'am',
                'name' => 'Հողի հարկ'
            ],
            [
                'sub_category_id' => 79,
                'lang' => 'ru',
                'name' => 'Земельный налог'
            ],
            [
                'sub_category_id' => 79,
                'lang' => 'en',
                'name' => 'Land tax'
            ],
            [
                'sub_category_id' => 80,
                'lang' => 'am',
                'name' => 'Գովազդի հարկ'
            ],
            [
                'sub_category_id' => 80,
                'lang' => 'ru',
                'name' => 'Налог на рекламу'
            ],
            [
                'sub_category_id' => 80,
                'lang' => 'en',
                'name' => 'Advertising tax'
            ],
            [
                'sub_category_id' => 81,
                'lang' => 'am',
                'name' => 'Ֆինանսական հաշվետվություններ'
            ],
            [
                'sub_category_id' => 81,
                'lang' => 'ru',
                'name' => 'Финансовая отчетность'
            ],
            [
                'sub_category_id' => 81,
                'lang' => 'en',
                'name' => 'Financial statements'
            ],
            [
                'sub_category_id' => 82,
                'lang' => 'am',
                'name' => 'Հարկային հաշվետվություններ'
            ],
            [
                'sub_category_id' => 82,
                'lang' => 'ru',
                'name' => 'Налоговая отчетность'
            ],
            [
                'sub_category_id' => 82,
                'lang' => 'en',
                'name' => 'Tax reporting'
            ],
            [
                'sub_category_id' => 83,
                'lang' => 'am',
                'name' => 'Աուդիտ և վերահսկողություն'
            ],
            [
                'sub_category_id' => 83,
                'lang' => 'ru',
                'name' => 'Аудит и контроль'
            ],
            [
                'sub_category_id' => 83,
                'lang' => 'en',
                'name' => 'Audit and control'
            ],
            [
                'sub_category_id' => 84,
                'lang' => 'am',
                'name' => 'Հարկային պլանավորում'
            ],
            [
                'sub_category_id' => 84,
                'lang' => 'ru',
                'name' => 'Налоговое планирование'
            ],
            [
                'sub_category_id' => 84,
                'lang' => 'en',
                'name' => 'Tax planning'
            ],
            [
                'sub_category_id' => 10,
                'lang' => 'am',
                'name' => 'Հաշվապահական խորհրդատվություն'
            ],
            [
                'sub_category_id' => 85,
                'lang' => 'ru',
                'name' => 'Бухгалтерский консалтинг'
            ],
            [
                'sub_category_id' => 85,
                'lang' => 'en',
                'name' => 'Accounting consulting'
            ],
            [
                'sub_category_id' => 86,
                'lang' => 'am',
                'name' => 'Բիզնես-պլանների կազմում ՝ հաշվի առնելով հարկային ասպեկտները'
            ],
            [
                'sub_category_id' => 86,
                'lang' => 'ru',
                'name' => 'Составление бизнес-планов с учетом налоговых аспектов'
            ],
            [
                'sub_category_id' => 86,
                'lang' => 'en',
                'name' => 'Preparation of business plans taking into account tax aspects'
            ],
            [
                'sub_category_id' => 87,
                'lang' => 'am',
                'name' => 'Լոգոներ և կորպորատիվ ինքնություն'
            ],
            [
                'sub_category_id' => 87,
                'lang' => 'ru',
                'name' => 'Логотипы и фирменный стиль'
            ],
            [
                'sub_category_id' => 87,
                'lang' => 'en',
                'name' => 'Logos and corporate identity'
            ],
            [
                'sub_category_id' => 88,
                'lang' => 'am',
                'name' => 'Տպագրական դիզայն'
            ],
            [
                'sub_category_id' => 88,
                'lang' => 'ru',
                'name' => 'Полиграфический дизайн'
            ],
            [
                'sub_category_id' => 88,
                'lang' => 'en',
                'name' => 'Printing design'
            ],
            [
                'sub_category_id' => 89,
                'lang' => 'am',
                'name' => 'Կոմիքսներ և անիմացիաներ'
            ],
            [
                'sub_category_id' => 89,
                'lang' => 'ru',
                'name' => 'Комиксы и анимация'
            ],
            [
                'sub_category_id' => 89,
                'lang' => 'en',
                'name' => 'Comics and animation'
            ],
            [
                'sub_category_id' => 90,
                'lang' => 'am',
                'name' => 'Դիզայն ՝ ինտերֆեյսերի'
            ],
            [
                'sub_category_id' => 90,
                'lang' => 'ru',
                'name' => 'Дизайн интерфейсов'
            ],
            [
                'sub_category_id' => 90,
                'lang' => 'en',
                'name' => 'Interface design'
            ],
            [
                'sub_category_id' => 91,
                'lang' => 'am',
                'name' => 'Օգտագործողի փորձ'
            ],
            [
                'sub_category_id' => 91,
                'lang' => 'ru',
                'name' => 'Пользовательский опыт'
            ],
            [
                'sub_category_id' => 91,
                'lang' => 'en',
                'name' => 'User experience'
            ],
            [
                'sub_category_id' => 92,
                'lang' => 'am',
                'name' => 'Պատասխանատու և շարժական դիզայն'
            ],
            [
                'sub_category_id' => 92,
                'lang' => 'ru',
                'name' => 'Адаптивный и мобильный дизайн'
            ],
            [
                'sub_category_id' => 92,
                'lang' => 'en',
                'name' => 'Adaptive and mobile design'
            ],
            [
                'sub_category_id' => 93,
                'lang' => 'am',
                'name' => 'Դիզայն ՝ սպառողական ապրանքների'
            ],
            [
                'sub_category_id' => 93,
                'lang' => 'ru',
                'name' => 'Дизайн потребительских товаров'
            ],
            [
                'sub_category_id' => 93,
                'lang' => 'en',
                'name' => 'Consumer product design'
            ],
            [
                'sub_category_id' => 94,
                'lang' => 'am',
                'name' => 'Արդյունաբերական դիզայն'
            ],
            [
                'sub_category_id' => 94,
                'lang' => 'ru',
                'name' => 'Индустриальный дизайн'
            ],
            [
                'sub_category_id' => 94,
                'lang' => 'en',
                'name' => 'Industrial design'
            ],
            [
                'sub_category_id' => 95,
                'lang' => 'am',
                'name' => 'Բնակելի տարածքների նախագծում'
            ],
            [
                'sub_category_id' => 95,
                'lang' => 'ru',
                'name' => 'Дизайн жилых помещений'
            ],
            [
                'sub_category_id' => 95,
                'lang' => 'en',
                'name' => 'Residential design'
            ],
            [
                'sub_category_id' => 96,
                'lang' => 'am',
                'name' => 'Կոմերցիոն ինտերիեր'
            ],
            [
                'sub_category_id' => 96,
                'lang' => 'ru',
                'name' => 'Коммерческий интерьер'
            ],
            [
                'sub_category_id' => 96,
                'lang' => 'en',
                'name' => 'Commercial interior'
            ],
            [
                'sub_category_id' => 97,
                'lang' => 'am',
                'name' => 'Նորաձեւություն եւ տեքստիլ դիզայն'
            ],
            [
                'sub_category_id' => 97,
                'lang' => 'ru',
                'name' => 'Мода и текстильный дизайн'
            ],
            [
                'sub_category_id' => 97,
                'lang' => 'en',
                'name' => 'Fashion and textile design'
            ],
            [
                'sub_category_id' => 98,
                'lang' => 'am',
                'name' => 'Հագուստի դիզայն'
            ],
            [
                'sub_category_id' => 98,
                'lang' => 'ru',
                'name' => 'Дизайн одежды'
            ],
            [
                'sub_category_id' => 98,
                'lang' => 'en',
                'name' => 'Fashion design'
            ],
            [
                'sub_category_id' => 99,
                'lang' => 'am',
                'name' => 'Գովազդային արշավներ'
            ],
            [
                'sub_category_id' => 99,
                'lang' => 'ru',
                'name' => 'Рекламные кампании'
            ],
            [
                'sub_category_id' => 99,
                'lang' => 'en',
                'name' => 'Advertising campaigns'
            ],
            [
                'sub_category_id' => 100,
                'lang' => 'am',
                'name' => 'Սոցիալական ցանցեր'
            ],
            [
                'sub_category_id' => 100,
                'lang' => 'ru',
                'name' => 'Социальные сети'
            ],
            [
                'sub_category_id' => 100,
                'lang' => 'en',
                'name' => 'Social network'
            ],
            [
                'sub_category_id' => 101,
                'lang' => 'am',
                'name' => '2D և 3D անիմացիաների ստեղծում'
            ],
            [
                'sub_category_id' => 101,
                'lang' => 'ru',
                'name' => 'Создание 2D и 3D анимации'
            ],
            [
                'sub_category_id' => 101,
                'lang' => 'en',
                'name' => 'Creating 2D and 3D animations'
            ],
            [
                'sub_category_id' => 102,
                'lang' => 'am',
                'name' => 'Անիմացիոն հոլովակներ գովազդի եւ շնորհանդեսներ'
            ],
            [
                'sub_category_id' => 102,
                'lang' => 'ru',
                'name' => 'Анимационные ролики для рекламы и презентаций'
            ],
            [
                'sub_category_id' => 102,
                'lang' => 'en',
                'name' => 'Animated videos for advertising and presentations'
            ],
            [
                'sub_category_id' => 103,
                'lang' => 'am',
                'name' => 'Վիդեո մոնտաժ'
            ],
            [
                'sub_category_id' => 103,
                'lang' => 'ru',
                'name' => 'Видеомонтаж'
            ],
            [
                'sub_category_id' => 103,
                'lang' => 'en',
                'name' => 'Video Editing'
            ],

        ];

        foreach ($data as $item) {
            SubCategoryTranslation::updateOrCreate(['sub_category_id' => $item['sub_category_id'], 'name' => $item['name']], $item);
        }

    }
}
