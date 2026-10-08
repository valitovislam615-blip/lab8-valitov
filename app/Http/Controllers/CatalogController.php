<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private function trainings(): array
    {
        return [
            [
                'id' => 1,
                'code' => 'FTN-00001',
                'title' => 'CrossFit Intensive',
                'hall' => 'Зал атлетики',
                'starts_at' => '2026-10-10 10:00',
                'duration_min' => 60,
                'max_people' => 15,
                'is_group' => true,
            ],
            [
                'id' => 2,
                'code' => 'FTN-00002',
                'title' => 'Йога и Стретчинг',
                'hall' => 'Зал аэробных программ',
                'starts_at' => '2026-10-10 11:30',
                'duration_min' => 90,
                'max_people' => 12,
                'is_group' => true,
            ],
            [
                'id' => 3,
                'code' => 'FTN-00003',
                'title' => 'Персональная силовая',
                'hall' => 'Тренажёрный зал',
                'starts_at' => '2026-10-10 14:00',
                'duration_min' => 45,
                'max_people' => 1,
                'is_group' => false,
            ],
            [
                'id' => 4,
                'code' => 'GYM-00010',
                'title' => 'Кардио Spinning',
                'hall' => 'Зал аэробных программ',
                'starts_at' => '2026-10-10 16:00',
                'duration_min' => 50,
                'max_people' => 20,
                'is_group' => true,
            ],
            [
                'id' => 5,
                'code' => 'GYM-00012',
                'title' => 'Функциональный тренинг',
                'hall' => 'Зал атлетики',
                'starts_at' => '2026-10-10 18:00',
                'duration_min' => 60,
                'max_people' => 10,
                'is_group' => true,
            ],
            [
                'id' => 6,
                'code' => 'GYM-00015',
                'title' => 'Пилатес для начинающих',
                'hall' => 'Зал аэробных программ',
                'starts_at' => '2026-10-10 19:30',
                'duration_min' => 55,
                'max_people' => 15,
                'is_group' => true,
            ],
        ];
    }

    public function index(Request $request)
    {
        $trainings = collect($this->trainings());
        $search = $request->query('q');

        if ($search) {
            $trainings = $trainings->filter(fn ($t) => mb_stripos($t['title'], $search) !== false);
        }

        $sort = $request->query('sort', 'title');
        if (in_array($sort, ['title', 'duration_min', 'max_people', 'starts_at'])) {
            $trainings = $trainings->sortBy($sort);
        }

        return view('catalog.index', [
            'title'     => 'Каталог тренировок фитнес-клуба',
            'trainings' => $trainings,
            'search'    => $search,
            'sort'      => $sort,
        ]);
    }

    public function stats()
    {
        $trainings = collect($this->trainings());

        return view('catalog.stats', [
            'title'          => 'Статистика тренировок',
            'count'          => $trainings->count(),
            'avg_duration'   => $trainings->avg('duration_min'),
            'min_duration'   => $trainings->min('duration_min'),
            'max_duration'   => $trainings->max('duration_min'),
            'total_capacity' => $trainings->sum('max_people'),
        ]);
    }

    public function show(int $id)
    {
        $training = collect($this->trainings())->firstWhere('id', $id);
        abort_if(! $training, 404);

        return view('catalog.show', [
            'title'    => $training['title'],
            'training' => $training,
        ]);
    }

    public function byCode(string $code)
    {
        $training = collect($this->trainings())->firstWhere('code', $code);
        abort_if(! $training, 404);

        return view('catalog.show', [
            'title'    => $training['title'],
            'training' => $training,
        ]);
    }

    public function byHall(?string $hall = null)
    {
        $allTrainings = collect($this->trainings());

        if (! $hall) {
            $halls = $allTrainings->pluck('hall')->unique();
            return view('catalog.halls', [
                'title' => 'Список залов',
                'halls' => $halls,
            ]);
        }

        $trainings = $allTrainings->where('hall', $hall);

        return view('catalog.index', [
            'title'     => "Тренировки в зале: {$hall}",
            'trainings' => $trainings,
            'search'    => null,
            'sort'      => 'title',
        ]);
    }
}