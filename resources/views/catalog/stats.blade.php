@extends('layouts.app')

@section('content')
<h1>{{ $title }}</h1>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Всего тренировок</h5>
                <p class="card-text fs-3">{{ $count }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Средняя длительность</h5>
                <p class="card-text fs-3">{{ number_format($avg_duration, 1) }} мин</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Мин / Макс длительность</h5>
                <p class="card-text fs-3">{{ $min_duration }} / {{ $max_duration }} мин</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Общая вместимость</h5>
                <p class="card-text fs-3">{{ $total_capacity }} мест</p>
            </div>
        </div>
    </div>
</div>
@endsection