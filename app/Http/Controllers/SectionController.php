<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Section::with('branches')->get();
        $sections = SectionWithBranchesResource::collection($data)->resolve();
        return inertia('Section/index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Section/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Section::query()->firstOrCreate($data);

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $section = SectionResource::make($section)->resolve();
        return inertia('Section/edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Section $section)
    {
        $data = $request->validated();

        $section->update($data);

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect(route('sections.index'));
    }

    public function sectionBranches(Section $section)
    {
        return BranchResource::collection($section->branches)->resolve();
    }
}
