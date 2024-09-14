<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Branch\BranchWithChildrenResource;
use App\Http\Resources\Section\SectionResource;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Section::all();
        $sections = SectionResource::collection($data)->resolve();

        return inertia('Branch/create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Branch::query()->firstOrCreate($data);

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $branch = BranchWithChildrenResource::make($branch)->resolve();
        return inertia('Branch/show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $data = Section::all();
        $sections = SectionResource::collection($data)->resolve();
        $branch = BranchResource::make($branch)->resolve();

        return inertia('Branch/edit', compact('branch', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect(route('sections.index'));
    }


    public function themeCreate(Branch $branch)
    {
        $branch = BranchResource::make($branch)->resolve();
        return inertia('Theme/create', compact('branch'));
    }
}
