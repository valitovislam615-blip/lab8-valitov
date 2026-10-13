<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id', 'title', 'starts_at', 'duration_min', 'max_people', 'is_group'
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'is_group' => 'boolean',
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}