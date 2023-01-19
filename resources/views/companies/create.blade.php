@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="d-flex">
                    <h1>Добавить компанию</h1>

                    <div class="ms-auto">
                        <a class="btn btn-primary" href="{{ route('companies.index') }}">Назад</a>
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

        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Эл. почта:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="info@opt6.ru"
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название компании:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="ООО ОПТ6"
                            value="{{ old('name') }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="address" class="form-label">Адрес компании:</label>
                        <input type="text" class="form-control" name="address" id="address"
                            placeholder="г. Москва, 2-й Южнопортовый проезд, 10 стр. 96" value="{{ old('address') }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="about_company" class="form-label">О компании:</label>
                        <textarea class="form-control" rows="5" name="about_company" id="about_company"
                            placeholder="Самая лучшая компания :)" value="{{ old('about_company') }}"></textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Логотип компании:</label>
                        <input class="form-control" type="file" id="formFile" name="logo">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Добавить компанию</button>
                </div>
            </div>
        </form>
    </div>
@endsection
