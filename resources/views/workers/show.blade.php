@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="d-flex">
                    <h1>
                        <span class="text-muted">Страница сотрудника</span> {{ $worker->name }}
                    </h1>

                    <div class="ms-auto">
                        <a class="btn btn-primary" href="{{ route('workers.index') }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                <img class="img-thumbnail" width="100%" src="{{ Storage::url("/images/workers/$worker->image") }}"
                    alt="{{ $worker->name }}">
            </div>

            <div class="col-md-8">
                <p>
                    <strong>Имя сотрудника:</strong>
                    {{ $worker->name }}
                </p>


                <p>
                    <strong>Номер телефона:</strong>
                    {{ $worker->phone_number }}
                </p>


                <p>
                    <strong>Компания:</strong>
                    <a href="{{ route('companies.show', $worker->company->id) }}">
                        {{ $worker->company->name }}
                </p>
            </div>
        </div>

    </div>
    </div>
@endsection
