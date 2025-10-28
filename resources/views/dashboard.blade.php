<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6 text-slate-900">
                    <h3 class="text-xl font-semibold">
                        {{ __('Welcome back,') }} {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-slate-600 mt-1">
                        {{ __('Here is your current overview based on your role.') }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse(($cards ?? []) as $card)
                    <a href="{{ $card['href'] ?? '#' }}" class="block bg-white/90 backdrop-blur p-6 overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl hover:shadow-md transition">
                        <h4 class="text-sm font-medium text-slate-500 uppercase tracking-wider">{{ __($card['label']) }}</h4>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $card['value'] }}</p>
                    </a>
                @empty
                    <div class="col-span-full text-slate-500">{{ __('No data to display.') }}</div>
                @endforelse
            </div>

            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6 text-slate-900">
                    <h3 class="text-xl font-semibold">{{ __('Recent Tasks') }}</h3>
                    <div class="mt-4 divide-y divide-gray-200">
                        @forelse(($recentTasks ?? []) as $task)
                            <div class="py-4 flex items-start justify-between">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $task->title }}</p>
                                    <p class="text-sm text-slate-600">
                                        {{ __('Project:') }} {{ $task->project->name ?? '-' }}
                                        <span class="mx-2">•</span>
                                        {{ __('Client:') }} {{ $task->project->client->name ?? '-' }}
                                        <span class="mx-2">•</span>
                                        {{ __('Assigned to:') }} {{ $task->assignedUser->name ?? __('Unassigned') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-slate-500">{{ optional($task->created_at)->diffForHumans() }}</p>
                                    <p class="text-xs text-slate-500">{{ __('Status:') }} {{ $task->status }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500">{{ __('No recent tasks found.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            @role('admin|manager')
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6 text-slate-900">
                    <h3 class="text-xl font-semibold">{{ __('Recent Projects') }}</h3>
                    <div class="mt-4 divide-y divide-gray-200">
                        @forelse(($recentProjects ?? []) as $project)
                            <div class="py-4 flex items-start justify-between">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $project->name }}</p>
                                    <p class="text-sm text-slate-600">
                                        {{ __('Client:') }} {{ $project->client->name ?? '-' }}
                                        @if($project->deadline)
                                            <span class="mx-2">•</span>
                                            {{ __('Deadline:') }} {{ \Illuminate\Support\Carbon::parse($project->deadline)->format('d/m/Y') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-slate-500">{{ optional($project->created_at)->diffForHumans() }}</p>
                                    <p class="text-xs text-slate-500">{{ __('Status:') }} {{ $project->status }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500">{{ __('No recent projects found.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
</x-app-layout>
