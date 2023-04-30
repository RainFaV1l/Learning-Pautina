<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonModule extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lesson_modules';
    // Разрешение на запросы
    protected $guarded = false;

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}
