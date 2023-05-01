<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModulesStatus extends Model
{
    use HasFactory;
//    use SoftDeletes;

    // Ручное связывание модели с таблицой
    protected $table = 'user_modules_statuses';
    // Разрешение на запросы
    protected $guarded = false;

    public function groupModules(): HasMany
    {
        return $this->hasMany(UserModule::class, 'module_id', 'id');
    }
}
