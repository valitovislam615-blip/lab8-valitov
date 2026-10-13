<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')
                  ->constrained()
                  ->restrictOnDelete(); // Связь с залами с учетом ON_DELETE = restrict
            $table->string('title', 121); // Основное поле (STR_LEN = 121)
            $table->dateTime('starts_at'); // Дата и время начала тренировки
            $table->integer('duration_min'); // Длительность в минутах
            $table->integer('max_people'); // Максимальное количество участников
            $table->boolean('is_group')->default(false); // Групповая ли тренировка
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};