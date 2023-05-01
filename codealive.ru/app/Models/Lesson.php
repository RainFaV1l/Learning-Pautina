<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Lesson extends Model
{
    use HasFactory;

    //    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lessons';
    // Разрешение на запросы
    protected $guarded = false;

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function lessonFiles()
    {
        return $this->belongsToMany(LessonFile::class, 'lesson_files_bundles', 'lesson_id', 'file_id');
    }

    public function lessonVideos()
    {
        return $this->belongsToMany(LessonVideo::class, 'lesson_videos_bundles', 'lesson_id', 'video_id');
    }
}
