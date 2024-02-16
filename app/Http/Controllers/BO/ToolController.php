<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Tool\ToolService;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    protected $service;

    public function __construct(ToolService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.tools.create");
        return view("bo.tool.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"] = route("bo.tools.store");
        return view("bo.tool.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name" => "required", "image_" => "required|mimes:jpg,png,jpeg|max:1000"]);
        try {
            $this->service->create($request);
            return Utils::RedirectSuccess(route("bo.tools.index"), "Success create tool-product");
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
        return view("bo.tool.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["route"] = route("bo.tools.update", $id);
        return view("bo.tool.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name" => "required", "image_" => "nullable|mimes:png,jpg,jpeg|max:1000"]);
        try {
            $this->service->updateData($id, $request);
            return Utils::RedirectSuccess(route("bo.tools.index"), "Success update tool-product");
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
            return Utils::BackSuccess("Success delete tool-product");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
