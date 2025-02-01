<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Стартовые данные для наполнения БД
     */
    public function run(): void
    {
        DB::table('resource')->insert([
            [
                'id' => 1,
                'name' => 'Счет №5',
                'denomination' => 1000,
                'resource_type' => 'Рубль',
                'additional_data' => json_encode([]),
                'resource_storage_name' => 'ЕвроВорБанк',
                'resource_storage_address' => 'Какой-то адрес ЕвроВорБанка',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Счет №3',
                'denomination' => 5,
                'resource_type' => 'Доллар',
                'additional_data' => json_encode([]),
                'resource_storage_name' => 'ВнешТоргБанк',
                'resource_storage_address' => 'Какой-то адрес ВнешТоргБанка',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Касса (валюта)',
                'denomination' => 100,
                'resource_type' => 'Рубль',
                'additional_data' => json_encode([]),
                'resource_storage_name' => 'Касса',
                'resource_storage_address' => 'Локальный кассовый аппарат (валюта)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Касса (талоны)',
                'denomination' => 3000,
                'resource_type' => 'Талон',
                'additional_data' => json_encode([]),
                'resource_storage_name' => 'Касса (талоны)',
                'resource_storage_address' => 'Локальный кассовый аппарат (талоны)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Торговое здание по адресу Бассейная-6, год постройки 1970',
                'denomination' => 1,
                'resource_type' => 'Здание',
                'additional_data' => json_encode([
                    'start_price' => 30000,
                    'price_left' => 5000,
                    'assessed_value' => 5000,
                    'inventory_number' => 7,
                ]),
                'resource_storage_name' => 'Реестр торговых зданий',
                'resource_storage_address' => 'Бассейная-6, год постройки 1970',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Гвоздь',
                'denomination' => 100,
                'resource_type' => 'Материалы (кг)',
                'additional_data' => json_encode([
                    'production_date' => '2000-01-01',
                    'start_price' => 1000,
                    'price_left' => 100,
                    'actual_price' => 2000
                ]),
                'resource_storage_name' => 'Склад материлов',
                'resource_storage_address' => 'Какой-то адрес склада материлов',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
