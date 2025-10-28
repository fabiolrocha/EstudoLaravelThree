<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $data = [
            'cards' => [],
            'recentTasks' => collect(),
            'recentProjects' => collect(),
        ];

        if ($user->hasRole('admin')) {
            $data['cards'] = [
                ['label' => 'Clients', 'value' => Client::count(), 'href' => route('clients.index')],
                ['label' => 'Projects', 'value' => Project::count(), 'href' => route('projects.index')],
                ['label' => 'Tasks', 'value' => Task::count(), 'href' => route('tasks.index')],
                ['label' => 'Users', 'value' => User::count(), 'href' => route('users.index')],
            ];

            $data['recentTasks'] = Task::with(['project.client', 'assignedUser'])
                ->latest()
                ->limit(5)
                ->get();

            $data['recentProjects'] = Project::with('client')
                ->latest()
                ->limit(5)
                ->get();
        } elseif ($user->hasRole('manager')) {
            $clientId = $user->clientManaged?->id;

            $projectsCount = Project::where('client_id', $clientId)->count();
            $tasksForClientCount = Task::whereHas('project', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })->count();
            $myTasksCount = Task::where('assigned_user_id', $user->id)->count();

            $data['cards'] = [
                ['label' => 'My Client Projects', 'value' => $projectsCount, 'href' => route('projects.index')],
                ['label' => 'Client Tasks', 'value' => $tasksForClientCount, 'href' => route('tasks.index')],
                ['label' => 'My Assigned Tasks', 'value' => $myTasksCount, 'href' => route('tasks.index')],
            ];

            $data['recentTasks'] = Task::with(['project.client', 'assignedUser'])
                ->whereHas('project', function ($q) use ($clientId) {
                    $q->where('client_id', $clientId);
                })
                ->latest()
                ->limit(5)
                ->get();

            $data['recentProjects'] = Project::with('client')
                ->where('client_id', $clientId)
                ->latest()
                ->limit(5)
                ->get();
        } else {
            $myTasksCount = Task::where('assigned_user_id', $user->id)->count();

            $data['cards'] = [
                ['label' => 'My Tasks', 'value' => $myTasksCount, 'href' => route('tasks.index')],
            ];

            $data['recentTasks'] = Task::with(['project.client', 'assignedUser'])
                ->where('assigned_user_id', $user->id)
                ->latest()
                ->limit(5)
                ->get();
        }

        return view('dashboard', $data);
    }
}
