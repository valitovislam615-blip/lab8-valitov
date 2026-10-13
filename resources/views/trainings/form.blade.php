@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $training->exists ? route('trainings.update', $training) : route('trainings.store') }}" method="POST">
        @csrf
        @if($training->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="hall_id" class="form-label">Зал</label>
            <select name="hall_id" id="hall_id" class="form-control" required>
                <option value="">Выберите зал</option>
                @foreach($halls as $hall)
                    <option value="{{ $hall->id }}" {{ old('hall_id', $training->hall_id) == $hall->id ? 'selected' : '' }}>
                        {{ $hall->name }} (площадь: {{ $hall->area }} м²)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Название тренировки</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $training->title) }}" required maxlength="121">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $training->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="starts_at" class="form-label">Дата и время начала</label>
            <input type="datetime-local" name="starts_at" id="starts_at" class="form-control" value="{{ old('starts_at', $training->starts_at?->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="duration_min" class="form-label">Длительность (мин)</label>
            <input type="number" name="duration_min" id="duration_min" class="form-control" value="{{ old('duration_min', $training->duration_min) }}" required>
        </div>

        <div class="mb-3">
            <label for="max_people" class="form-label">Максимум человек</label>
            <input type="number" name="max_people" id="max_people" class="form-control" value="{{ old('max_people', $training->max_people) }}" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_group" id="is_group" class="form-check-input" value="1" {{ old('is_group', $training->is_group) ? 'checked' : '' }}>
            <label for="is_group" class="form-check-label">Групповая тренировка</label>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection