<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonComment extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'lesson_comments';
    // Разрешение на запросы
    protected $guarded = false;
}
