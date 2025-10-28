<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    if (!$user) {
         abort(403);
    }

    $query = Project::query()->with('client.contactUser'); 

    if ($user->hasRole('manager')) { 
        $query->where('client_id', $user->clientManaged?->id);


    } elseif ($user->hasRole('user')) { 
        $query->whereHas('tasks', function ($taskQuery) use ($user) {
            $taskQuery->where('assigned_user_id', $user->id); 
        });
    }

    $projects = $query->paginate(15);

    return view('projects.index', compact('projects'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('projects.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date|after_or_equal:today',
            'status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'client_id' => 'required|exists:clients,id',
        ]);

        Project::create([

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
            'client_id' => $request->input('client_id'),
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Projeto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $clients = Client::all();
        return view('projects.edit', compact('project', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date|after_or_equal:today',
            'status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'client_id' => 'required|exists:clients,id',
        ]);

        $project->update([

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
            'client_id' => $request->input('client_id'),
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Projeto editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Projeto deletado com sucesso!');
    }
}
