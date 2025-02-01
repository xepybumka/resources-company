<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\View\View;

class ResourceController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $title = 'Список ресуорсов';
        $resources = $this->getResources();

        return view('main.resource.index', [
            'title' => $title,
            'resources' => $resources,
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $title = 'Создание: Ресурс';
        return view('main.resource.create', [
            'title' => $title
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $title = 'Редактирование: Ресурс №' . $id;
        // TODO: Заменить на вывод из бд
        $resource = $this->getResource($id);
        return view('main.resource.edit', [
            'title' => $title,
            'resource' => $resource
        ]);
    }

    //TODO: Доработать, после появления базы данных

//    /**
//     * @param UpdateResourceRequest $request
//     * @param int $id
//     * @return RedirectResponse
//     * @throws Exception
//     */
//    public function update(UpdateResourceRequest $request, int $id)
//    {
//        $resource = $this->getResources($id);
//        $resource->name = (string)$request->name;
//        $resource->updated_at = new DateTime();
//        if (!$resource->save()) {
//            throw new Exception();
//        }
//        return redirect()->route('resource.list')->with('success', 'Ресурс ' . $resource->name . ' успешно обновлен!');
//    }

    // TODO: !Временное решение. Метод заменить на получение данных из БД.
    private function getResources(?int $id = null): array
    {
        $dbResources = [
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
        ];

        return $dbResources;
    }

    private function getResource(int $id): array
    {
        $dbResources = $this->getResources();
        $dbResourceId = array_search($id, array_column($dbResources, 'id'));
        return $dbResources[$dbResourceId];
    }
}
