<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('TASKS') }}
                </h2>
                
                <a href="{{ route('tasks.create') }}" type="button" class="group inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow-md hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">
                    <svg class="h-4 w-4 opacity-90 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create
                </a>
                
            </div>

            <div class="bg-white/90 backdrop-blur shadow-sm ring-1 ring-gray-200 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Projeto</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Encarregado</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Prazo</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($tasks as $task)
                            <tr class="hover:bg-indigo-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></div>
                                    <div class="text-sm text-slate-500"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ Str::limit($task->description, 60) }}</a></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->project->name}}</a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->assignedUser?->name ?? 'N/A'}}</a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->deadline }}</a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800"><a class="hover:text-indigo-700" href="{{ route('tasks.show', $task->id) }}">{{ $task->status }}</a></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-600 text-white text-xs font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 mr-2">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir esta tarefa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-red-600 text-white text-xs font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Nenhuma tarefa encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>