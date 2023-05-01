<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Header extends Model
{
    use HasFactory;

    static function isActiveRoute($value) {
        if(Route::currentRouteName() === $value) {
            return 'active';
        }
    }
}
