@extends('layouts.main_layout')

@section('breadcrumbs', $title)

@section('content')
    <h1>{{$title}}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ошибка!</strong>
            С некоторыми полями возникли проблемы.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="#">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">Наименование ресурса</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{$resource->name}}" name="name" placeholder="Наименование ресурса">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="denomination">Номинал/количество</label>
            <input type="number" class="form-control @error('denomination') is-invalid @enderror" id="denomination"
                   value="{{$resource->denomination}}" name="denomination" placeholder="123">
            @error('denomination')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="resource_type">Тип ресурса</label>
            <input type="text" class="form-control @error('resource_type') is-invalid @enderror" id="resource_type"
                   value="{{$resource->resource_type}}" name="resource_type" placeholder="Тип ресурса">
            @error('resource_type')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="additional_data">Тип ресурса</label>
            <input type="text" class="form-control @error('additional_data') is-invalid @enderror" id="additional_data"
                   value="{{$resource->additional_data}}" name="additional_data" placeholder="Дополнительные параметры для ресурса">
            @error('additional_data')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="resource_storage_name">Тип ресурса</label>
            <input type="text" class="form-control @error('resource_storage_name') is-invalid @enderror" id="resource_storage_name"
                   value="{{$resource->resource_storage_name}}" name="resource_storage_name" placeholder="Наименование хранения ресурса">
            @error('resource_storage_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="resource_storage_address">Тип ресурса</label>
            <input type="text" class="form-control @error('resource_storage_address') is-invalid @enderror" id="resource_storage_address"
                   value="{{$resource->resource_storage_address}}" name="resource_storage_address" placeholder="Адрес хранения ресурса">
            @error('resource_storage_address')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="mb-3">
            <button class="btn btn-success btn-submit">Обновить</button>
        </div>
    </form>
@endsection
