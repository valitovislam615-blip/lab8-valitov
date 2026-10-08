@extends('layouts.app')

@section('content')
<h1>{{ $training['title'] }}</h1>

<dl class="row">
    <dt class="col-sm-3">ID тренировки</dt> <dd class="col-sm-9">{{ $training['id'] }}</dd>
    <dt class="col-sm-3">Код</dt> <dd class="col-sm-9">{{ $training['code'] }}</dd>
    <dt class="col-sm-3">Зал</dt> <dd class="col-sm-9">{{ $training['hall'] }}</dd>
    <dt class="col-sm-3">Время начала</dt> <dd class="col-sm-9">{{ $training['starts_at'] }}</dd>
    <dt class="col-sm-3">Длительность</dt> <dd class="col-sm-9">{{ $training['duration_min'] }} минут</dd>
    <dt class="col-sm-3">Макс. участников</dt> <dd class="col-sm-9">{{ $training['max_people'] }} чел.</dd>
    <dt class="col-sm-3">Формат</dt> <dd class="col-sm-9">{{ $training['is_group'] ? 'Групповая тренировка' : 'Индивидуальное занятие' }}</dd>
</dl>

<a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">&larr; Вернуться к списку</a>
@endsection