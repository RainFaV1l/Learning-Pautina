<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonVideosBundle extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lesson_videos_bundles';
    // Разрешение на запросы
    protected $guarded = false;

    public function video()
    {
        return $this->belongsTo(LessonVideo::class, 'video_id', 'id');
    }
}
