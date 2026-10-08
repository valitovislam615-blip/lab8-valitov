@extends('layouts.app')

@section('content')
<h1>{{ $title }}</h1>

<form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Название тренировки...">
    </div>
    <div class="col-auto">
        <select name="sort" class="form-select">
            <option value="title" @selected($sort === 'title')>По названию</option>
            <option value="duration_min" @selected($sort === 'duration_min')>По длительности</option>
            <option value="max_people" @selected($sort === 'max_people')>По кол-ву мест</option>
            <option value="starts_at" @selected($sort === 'starts_at')>По времени начала</option>
        </select>
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary">Найти</button>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>№</th>
            <th>Код</th>
            <th>Название</th>
            <th>Зал</th>
            <th>Время начала</th>
            <th>Длительность</th>
            <th>Мест</th>
            <th>Тип</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($trainings as $training)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('catalog.code', ['code' => $training['code']]) }}">{{ $training['code'] }}</a></td>
            <td><a href="{{ route('catalog.show', ['id' => $training['id']]) }}">{{ $training['title'] }}</a></td>
            <td><a href="{{ route('catalog.hall', $training['hall']) }}">{{ $training['hall'] }}</a></td>
            <td>{{ $training['starts_at'] }}</td>
            <td>{{ $training['duration_min'] }} мин.</td>
            <td>{{ $training['max_people'] }} чел.</td>
            <td>
                @if ($training['is_group'])
                    <span class="badge bg-primary">Групповая</span>
                @else
                    <span class="badge bg-info text-dark">Индивидуальная</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-muted">Тренировки не найдены.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection