@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $title }}</h1>

    @if(session('status'))
        <div class="alert alert-success mt-3">{{ session('status') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center my-3">
        <form action="{{ route('trainings.index') }}" method="GET" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Поиск по названию..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit">Найти</button>
        </form>
        <a href="{{ route('trainings.create') }}" class="btn btn-primary">Добавить тренировку</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Зал</th>
                <th>Дата и время</th>
                <th>Длительность</th>
                <th>Мест</th>
                <th>Группа</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trainings as $training)
                <tr>
                    <td>{{ $training->id }}</td>
                    <td>{{ $training->title }}</td>
                    <td>{{ $training->hall->name ?? '—' }}</td>
                    <td>{{ $training->starts_at?->format('d.m.Y H:i') }}</td>
                    <td>{{ $training->duration_min }} мин</td>
                    <td>{{ $training->max_people }}</td>
                    <td>{{ $training->is_group ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('trainings.edit', $training) }}" class="btn btn-sm btn-warning">Изм.</a>
                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить эту тренировку?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Уд.</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Тренировки не найдены</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trainings->links() }}
    </div>
</div>
@endsection