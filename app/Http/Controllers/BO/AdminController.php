<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Services\Wallet\WalletService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $service;
    protected $walletService;

    public function __construct(AdminService $service, WalletService $wallerService)
    {
        $this->service = $service;
        $this->walletService = $wallerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.admins.create");
        return view("bo.user.admin.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"]      = route("bo.admins.store");
        return view("bo.user.admin.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"             => "required", 
            "email"            => "required|email",
            "password"         => "required|confirmed",
            "status"           => "required",
        ]);
        $request["role"]       = "administrator";

        try {
            $model = $this->service->create($request->all());
            $walet_dada = [
                "admin_id" => $model->id,
                "amount"   => 0
            ];
            $this->walletService->create($walet_dada);
            
            return Utils::RedirectSuccess(route("bo.admins.index"), "Success create admin");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data["model"] = $this->service->find($id);
        return view("bo.user.admin.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.admins.update", $id);
        return view("bo.user.admin.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"             => "required", 
            "email"            => "required|email",
            "password"         => "nullable|confirmed",
            "status"           => "required",
        ]);

        try {
            $this->service->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.admins.index"), "Success update admin");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->service->delete($id);
            return Utils::BackSuccess("Success delete admin");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
