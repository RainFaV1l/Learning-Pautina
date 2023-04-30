<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupModule extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'group_modules';
    // Разрешение на запросы
    protected $guarded = false;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class,'group_id', 'id');
    }

    public function userModule(): BelongsTo
    {
        return $this->belongsTo(UserModule::class, 'module_id', 'id');
    }
}
