<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Services\Profile\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

}
