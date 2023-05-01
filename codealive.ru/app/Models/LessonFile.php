<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class LessonFile extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lesson_files';
    // Разрешение на запросы
    protected $guarded = false;

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_files_bundles', 'file_id', 'lesson_id');
    }

    // file_urls
    public function getFileUrlsAttribute()
    {
        return asset(Storage::url('app/' . $this->file_path));
    }
}
