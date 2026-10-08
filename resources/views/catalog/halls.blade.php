@extends('layouts.app')

@section('content')
<h1>{{ $title }}</h1>

<div class="list-group col-md-6 mt-3">
    @forelse ($halls as $hall)
        <a href="{{ route('catalog.hall', $hall) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span>🏋️ {{ $hall }}</span>
            <span class="badge bg-primary rounded-pill">&rarr;</span>
        </a>
    @empty
        <div class="alert alert-info">Залы не найдены.</div>
    @endforelse
</div>

<div class="mt-4">
    <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary">&larr; Вернуться ко всем тренировкам</a>
</div>
@endsection