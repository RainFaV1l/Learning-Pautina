<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CourseUser extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'course_users';
    // Разрешение на запросы
    protected $guarded = false;

    // Проверка отправил ли заявку пользователь
    static function checkSubscribe($course_id) {
        return CourseUser::query()->where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course_id)->count();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(CourseUsersStatus::class, 'course_users_status_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    static function formatLessonsCount($count, $nullCount = false, $modules = false) {
        if($modules) {
            $result = match (true) {
                $count == 0 => 'модулей',
                $count == 1 => 'модуль',
                $count < 5 => 'модуля',
                $count <= 100 => 'модулей',
            };
        } else {
            $result = match (true) {
                $count == 0 => 'уроков',
                $count == 1 => 'урок',
                $count < 5 => 'урока',
                $count <= 100 => 'уроков',
            };
        }
        if($nullCount) :
            return $result;
        else :
            return $count . ' ' . $result;
        endif;
    }
}
