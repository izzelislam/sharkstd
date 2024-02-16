<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.customers.create");
        return view("bo.user.customer.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"]      = route("bo.customers.store");
        return view("bo.user.customer.form", $data);
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
            "address"          => "nullable",
            "postal_code"      => "nullable"
        ]);

        try {
            $this->service->create($request->all());
            return Utils::RedirectSuccess(route("bo.customers.index"), "Success create customer");
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
        return view("bo.user.customer.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.customers.update", $id);
        return view("bo.user.customer.form", $data);
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
            "address"          => "nullable",
            "postal_code"      => "nullable"
        ]);

        try {
            $this->service->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.customers.index"), "Success update customer");
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
            return Utils::BackSuccess("Success delete customer");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
