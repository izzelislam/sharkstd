<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Blog\BlogService;
use App\Services\BlogCategory\BlogCategoryService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $service;
    protected $categoryService;

    public function __construct(BlogService $service, BlogCategoryService $blogCategory)
    {
        $this->service = $service;
        $this->categoryService = $blogCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.blogs.create");
        return view("bo.blog.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"]      = route("bo.blogs.store");
        $data["categories"] = Utils::SelectFormatter($this->categoryService->all());
        return view("bo.blog.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"            => "required", 
            "blog_category_id" => "required|exists:blog_categories,id",
            "image_cover_"     => "required|mimes:png,jpg,png|max:2000",
            "content"          => "required"
        ]);

        try {
            $request["content"] = clean($request->content);
            $this->service->createData($request);
            return Utils::RedirectSuccess(route("bo.blogs.index"), "Success create blog");
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
        return view("bo.blog.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["model"] = $this->service->find($id);
        $data["categories"] = Utils::SelectFormatter($this->categoryService->all());
        $data["route"] = route("bo.blogs.update", $id);
        return view("bo.blog.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title"            => "required", 
            "blog_category_id" => "required|exists:blog_categories,id",
            "image_cover_"     => "nullable|mimes:png,jpg,png|max:2000",
            "content"          => "required"
        ]);

        try {
            $request["content"] = clean($request->content);
            $this->service->updateData($id, $request);
            return Utils::RedirectSuccess(route("bo.blogs.index"), "Success update blog");
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
            return Utils::BackSuccess("Success delete blog");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
