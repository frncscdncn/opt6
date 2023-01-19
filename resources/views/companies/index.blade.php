@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Список всех компаний</h2>
                </div>
                <br>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('companies.create') }}">Добавить новую компанию</a>
                </div>
                <br>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Название компании</th>
                        <th>Эл. почта</th>
                        <th>Кол-во сотрудников</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></td>
                            <td>{{ $company->email }}</td>
                            <td>{{ count($company->workers) }}</td>
                            <td class="text-nowrap text-end" style="width: 10px;">
                                <a class="btn btn-primary"
                                    href="{{ route('companies.edit', $company->id) }}">Редактировать</a>
                                <form class="d-inline-block" action="{{ route('companies.destroy', $company->id) }}"
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
        </div>

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
