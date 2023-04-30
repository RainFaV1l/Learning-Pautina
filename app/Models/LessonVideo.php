<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonVideo extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lesson_videos';
    // Разрешение на запросы
    protected $guarded = false;

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_files_bundles', 'video_id', 'lesson_id');
    }
}
