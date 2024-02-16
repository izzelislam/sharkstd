<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboarController extends Controller
{
    public function index()
    {
        try {
            // dd(auth()->guard("admin")->check());
            return view("bo.dashboard.index");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
