<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;
    //    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'courses';
    // Разрешение на запросы
    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(CourseLevel::class, 'course_level_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id')->orderBy('lesson_number');
    }

    public function courseUsers()
    {
        return $this->hasMany(CourseUser::class, 'course_id', 'id');
    }

    // icon_url
    public function getIconUrlAttribute()
    {
        return asset(Storage::url('app/' . $this->course_icon_path));
    }

    // banner_url
//    public function getBannerUrlAttribute()
//    {
//        return asset(Storage::url('app/' . $this->course_banner_path));
//    }

    public function users()
    {
//        return $this->belongsToMany(User::class,'course_users', 'course_id', 'user_id');
        return $this->belongsToMany(User::class,'course_users', 'course_id', 'user_id');
    }

}
