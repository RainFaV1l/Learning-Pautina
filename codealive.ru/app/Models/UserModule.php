<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModule extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'user_modules';
    // Разрешение на запросы
    protected $guarded = false;

    public function status()
    {
        return $this->belongsTo(UserModulesStatus::class, 'status_id', 'id');
    }
}
