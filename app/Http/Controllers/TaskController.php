<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Notifications\NewTaskNotification;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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


        $query = Task::query()->with(['project.client', 'assignedUser']);


        if ($user->hasRole ('manager')) {

            $query->whereHas('project', function ($projectQuery) use ($user) {

                $projectQuery->where('client_id', $user->clientManaged?->id);
            });
        } elseif ($user->hasRole('user')) {

            $query->where('assigned_user_id', $user->id);
        }

        $tasks = $query->paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assignableUsers = User::role(['admin', 'user'])->get();
        $projects = Project::all();
        return view('tasks.create', compact('projects', 'assignableUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_user_id' => ['nullable', 'exists:users,id'],
            'deadline' => 'required|date',
            'status' => 'required|string|max:50',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'assigned_user_id' => $request->input('assigned_user_id'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
            'project_id' => $request->input('project_id'),
        ]);

        $admin = User::role('admin')->first();

        if ($admin) {
            $admin->notify(new NewTaskNotification($task));
        }

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $assignableUsers = User::role(['admin', 'user'])->get();
        $projects = Project::all();
        return view('tasks.edit', compact('projects', 'task', 'assignableUsers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_user_id' => ['nullable', 'exists:users,id'],
            'description' => 'required|string',
            'deadline' => 'required|date',
            'status' => 'required|string|max:50',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'assigned_user_id' => $request->input('assigned_user_id'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
            'project_id' => $request->input('project_id'),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa deletada com sucesso!');
    }
}
