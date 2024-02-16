<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Feature\FeatureService;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    protected $service;

    public function __construct(FeatureService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.features.create");
        return view("bo.feature.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"] = route("bo.features.store");
        return view("bo.feature.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->service->create($request->all());
            return Utils::RedirectSuccess(route("bo.features.index"), "Success create blog-category");
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
        return view("bo.feature.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.features.update", $id);
        return view("bo.feature.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name" => "required"]);
        try {
            $this->service->update($id, $request->all());
            return Utils::RedirectSuccess(route("bo.features.index"), "Success update blog-category");
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
            return Utils::BackSuccess("Success delete blog-category");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
