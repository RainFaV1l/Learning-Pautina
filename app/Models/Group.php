<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    //    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'groups';
    // Разрешение на запросы
    protected $guarded = false;

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class, 'course_id', 'id');
    }

    public function courseUsers()
    {
        return $this->hasMany(CourseUser::class, 'course_id', 'id');
    }
}
