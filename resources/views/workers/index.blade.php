@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Список всех сотрудников</h2>
                </div>
                <br>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('workers.create') }}">Добавить нового сотрудника</a>
                </div>
                <br>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th>Имя сотрудника</th>
                    <th>Эл. почта</th>
                    <th>Номер телефона</th>
                    <th>Компания</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                    <tr>
                        <td><a href="{{ route('workers.show', $worker->id) }}">{{ $worker->name }}</a></td>
                        <td>{{ $worker->email }}</td>
                        <td>{{ $worker->phone_number }}</td>
                        <td><a href="{{ route('companies.show', $worker->company->id) }}">{{ $worker->company->name }}</a>
                        </td>
                        <td class="text-nowrap text-end" style="width: 10px;">
                            <a class="btn btn-primary" href="{{ route('workers.edit', $worker->id) }}">Редактировать</a>
                            <form class="d-inline-block" action="{{ route('workers.destroy', $worker->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/ru.json'
                    }
                });
            });
        </script>
    </div>
@endsection
