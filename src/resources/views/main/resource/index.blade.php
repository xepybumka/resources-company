@extends('layouts.main_layout')

{{--@section('breadcrumbs', $title)--}}
@section('breadcrumbs', 'Главная')

@section('content')
{{--    <h1>{{$title}}</h1>--}}
    <h1>Ресурсы компании</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
    @endif

    <div class="col-6 mb-2">
{{--        <a class="btn bg-gradient-dark mb-0" href="{{ route('resource.create') }}">--}}
        <a class="btn bg-gradient-dark mb-0" href="#">
            <i class="material-icons text-sm">add</i>
            Добавить
        </a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Номинал</th>
            <th>Тип Ресурса</th>
            <th>Наименование хранения ресурса</th>
            <th>Адрес хранения ресурса</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td class="w-5">{{$item['id']}}</td>
                <td class="w-20 text-wrap">{{$item['name']}}</td>
                <td class="w-20 text-wrap">{{$item['denomination']}}</td>
                <td class="w-10 text-wrap">{{$item['resource_type']}}</td>
                <td class="w-20 text-wrap">{{$item['resource_storage_name']}}</td>
                <td class="w-20 text-wrap">{{$item['resource_storage_address']}}</td>
                <td class="w-5">
                    <div class="btn-group">
                        <form method="get" action="#">
                            @csrf
                            <button type="submit" class="btn btn-facebook"><i class="far fa-eye">show</i></button>
                        </form>
                        <form method="get" action="#">
                            @csrf
                            <button type="submit" class="btn btn-info"><i class="fas fa-edit">edit</i></button>
                        </form>
                        <form method="post" action="#">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt">delete</i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    {{$items->links('core.vendor.pagination.bootstrap-5')}}--}}
@endsection

