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
        $resources = Resource::all();
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
        $resource = Resource::find($id);
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
}
