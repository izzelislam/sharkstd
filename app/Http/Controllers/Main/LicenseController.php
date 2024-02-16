<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\License\LicenseService;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $service;

    public function __construct(LicenseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data["licenses"] = $this->service->withOrderRaw('CHAR_LENGTH(describtion) ASC');
        return view("main.front-page.license.index", $data);
    }
}
