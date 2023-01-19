@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>Панель администратора</div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h1 class="display-5 mb-4">
                        Вы вошли в систему!
                    </h1>

                    <p>
                        <a href="{{ route('companies.index') }}" class="btn btn-primary">Компании</a>
                        <a href="{{ route('workers.index') }}" class="btn btn-primary">Сотрудники</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection