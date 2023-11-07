<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpadateProjectRequest;
use App\Http\Requests\StoreProjectRequest;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(20);
        // $project = Post::orderByDesc()->paginate(12);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();    

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    
//COME COLLEGHIAMO PROJECTCONTROLLER E PROJECTREQUEST? 
//mi aspetto un ogetto di tipo StoreProjectRequest
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();
        $project->fill($data);
        $project->save();

        //gestisco l'immagine 
        if($request->hasFile('cover_image')) {
        $cover_image_path = Storage::put('uploads/projects/cover_image', $data['cover_image']);
        $project->cover_image = $cover_image_path; 
        }

        $project->save();

        //l'array è data e bisogna controllare che esista la chiave technologies
        if(Arr::exists($data, 'technologies')) {
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::orderBy('label')->get();

        $technology_ids = $project->technologies->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'technology_ids'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function update(UpadateProjectRequest $request, Project $project)
    {
        // Per fare slug? - Portarsi Str
        // $post->fill($data);
        // $post->slug = Str::slug($post->title);
        // $post->save();

        $data = $request->validated();
        $project->fill($data); 

        //gestisco l'immagine
        if ($request->hasFile('cover_image')) {
            if($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $cover_image_path = Storage::put('uploads/projects/cover_image', $data['cover_image']);
             $project->cover_image = $cover_image_path;
        }

        $project->save();

        //gestisco le tecnologie
        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index', $project);
    }

    // CESTINO
    public function trash() {
        $projects = Project::orderByDesc('id')->onlyTrashed()->paginate(10);
        return view('admin.projects.trash.index', compact('projects'));
    }

    public function forceDestroy(int $id) {

        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();

        if($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->forceDelete();

        return redirect()->route('admin.projects.trash.index');

    }

    public function restore(int $id) {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.trash.index');

    }
 }
