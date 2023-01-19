@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="d-flex">
                    <h1>Редактировать сотрудника</h1>

                    <div class="ms-auto">
                        <a class="btn btn-primary" href="{{ route('workers.index') }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('workers.update', $worker->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя сотрудника:</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $worker->name }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Номер телефона:</label>
                        <input type="text" class="form-control" name="phone_number" id="phone"
                            value="{{ $worker->phone_number }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="company_id">Компания:</label>
                        <select class="form-select" name="company_id" id="company_id">
                            @foreach ($companies as $company)
                                @if ($worker->company_id == $company->id)
                                    <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Изображение сотрудника:</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                IMask($('#phone')[0], {
                    mask: '+{7}-000-000-00-00',
                });
            });
        </script>
    </div>
@endsection
