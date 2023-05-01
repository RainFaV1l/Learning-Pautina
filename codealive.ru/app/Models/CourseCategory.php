<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'course_categories';
    // Разрешение на запросы
    protected $guarded = false;

    public function courses() {
        return $this->hasMany(Course::class);
    }

}
