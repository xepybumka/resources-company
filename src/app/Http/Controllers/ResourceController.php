<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(): View
    {
        $title = 'Предметы';
//        $items = DB::table(TableNameEnum::Item->value)->paginate(10);
        $items = [
            [
                'id' => 1,
                'name' => 'Счет №5',
                'denomination' => 1000,
                'resource_type' => 'Рубль',
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
                'resource_storage_name' => 'Касса (талоны)',
                'resource_storage_address' => 'Локальный кассовый аппарат (талоны)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return view('main.resource.index', [
            'title' => $title,
            'items' => $items,
        ]);
    }
}
