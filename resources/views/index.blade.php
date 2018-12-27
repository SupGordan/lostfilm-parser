@extends('layouts.main')
@section('content')

    <div class="container">
        <div style="text-align: center;">
            <h3>
                {{ $title }}
            </h3>
        </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Дата выхода</th>
                        <th scope="col">Фильм</th>
                        <th scope="col">Серия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($films as $film)
                <tr>
                    <td>{{ $film->release_date }}</td>
                    <td>{{ $film->film_name }}</td>
                    <td><a href="{{ $film->url }}">{{ $film->series_name }}</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">{{ $films->links() }}</div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
