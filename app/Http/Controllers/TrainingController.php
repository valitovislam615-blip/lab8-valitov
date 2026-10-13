<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Hall;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query = Training::with('hall');

        if ($search = $request->query('q')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query->latest(); // Сначала новые (согласно параметру SORT)

        return view('trainings.index', [
            'title' => 'Каталог тренировок фитнес-клуба',
            'trainings' => $query->paginate(6)->withQueryString(), // PER_PAGE = 6
        ]);
    }

    public function create()
    {
        return view('trainings.form', [
            'title' => 'Новая тренировка',
            'training' => new Training(),
            'halls' => Hall::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hall_id' => ['required', 'integer', 'exists:halls,id'],
            'title' => ['required', 'string', 'min:3', 'max:121'],
            'description' => ['nullable', 'string', 'max:500'],
            'starts_at' => ['required', 'date'],
            'duration_min' => ['required', 'integer', 'min:15', 'max:300'],
            'max_people' => ['required', 'integer', 'min:1', 'max:100'],
            'is_group' => ['boolean'],
        ]);

        $validated['is_group'] = $request->has('is_group');

        $training = Training::create($validated);
        return redirect()->route('trainings.index')
            ->with('status', "Добавлено: {$training->title}");
    }

    public function edit(Training $training)
    {
        return view('trainings.form', [
            'title' => 'Редактирование тренировки',
            'training' => $training,
            'halls' => Hall::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'hall_id' => ['required', 'integer', 'exists:halls,id'],
            'title' => ['required', 'string', 'min:3', 'max:121'],
            'description' => ['nullable', 'string', 'max:500'],
            'starts_at' => ['required', 'date'],
            'duration_min' => ['required', 'integer', 'min:15', 'max:300'],
            'max_people' => ['required', 'integer', 'min:1', 'max:100'],
            'is_group' => ['boolean'],
        ]);

        $validated['is_group'] = $request->has('is_group');

        $training->update($validated);
        return redirect()->route('trainings.index')
            ->with('status', 'Изменения сохранены.');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('trainings.index')
            ->with('status', "Удалено: {$training->title}");
    }
}