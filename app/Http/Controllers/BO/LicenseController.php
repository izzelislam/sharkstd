<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.licenses.create");
        return view("bo.license.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"] = route("bo.licenses.store");
        return view("bo.license.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->service->create($request->all());
            return Utils::RedirectSuccess(route("bo.licenses.index"), "Success create license");
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
        return view("bo.license.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.licenses.update", $id);
        return view("bo.license.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->service->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.licenses.index"), "Success update license");
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
            return Utils::BackSuccess("Success delete license");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
