<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    //    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'birthday_date',
        'last_auth_date',
        'tel',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Связь пользователя с ролью
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    // Вывод информации
    static function getInfo($id)
    {
        return User::select('surname', 'name', 'patronymic', 'email', 'birthday_date', 'tel', 'profile_photo_path')->find($id);
    }

    // Вывод ФИО
    static function getFIO()
    {
        $surname = Auth::user()->surname;
        $name = Auth::user()->name;
        $patronymic = Auth::user()->patronymic;
        //        '.' . mb_substr($patronymic, 0, 1, 'UTF-8') .
        //        . ' ' . mb_substr($surname, 0, 1, 'UTF-8') . '.'
        return mb_strimwidth($name, 0, 10, '...') . ' ' . mb_strimwidth($surname, 0, 1) . '.' . mb_strimwidth($patronymic, 0, 1);
    }

    // Вывод полного ФИО
    static function getFioByValue($surname, $name, $patronymic)
    {
        return $surname . ' ' . $name . ' ' . $patronymic;
    }

    // Вывод сокращенного ФИО
    static function getFioShort($surname, $name, $patronymic)
    {
        return $surname . ' ' . mb_strimwidth($name, 0, 1)  . '.' . mb_strimwidth($patronymic, 0, 1) . '.';
    }

    // Аватарка пользователя
    public function getUserUrlAttribute()
    {
        return asset(Storage::url('app/' . $this->profile_photo_path));
    }

    // Связь пользователя с курсом М : М
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id', 'course_id');
    }

    public function courseUser()
    {
        return $this->hasMany(CourseUser::class, 'user_id');
    }

    static function userFind($id)
    {
        return User::find($id);
    }

}
