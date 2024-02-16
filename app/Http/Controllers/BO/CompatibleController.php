<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Compatible\CompatibleService;
use Illuminate\Http\Request;

class CompatibleController extends Controller
{
    protected $service;

    public function __construct(CompatibleService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.compatibles.create");
        return view("bo.compatible.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"] = route("bo.compatibles.store");
        return view("bo.compatible.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->service->create($request->all());
            return Utils::RedirectSuccess(route("bo.compatibles.index"), "Success create data");
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
        return view("bo.compatible.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.blog-categories.update", $id);
        return view("bo.compatible.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name" => "required"]);

        try {
            $this->service->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.compatibles.index"), "Success update data");
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
            return Utils::BackSuccess("Success delete data");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
