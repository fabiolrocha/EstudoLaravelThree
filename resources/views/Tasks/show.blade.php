<x-app-layout>
	<x-slot name="header">
		<h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
			{{ $task->title ?? 'Task' }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
				<div class="p-6 bg-white">
					<div class="flex items-start justify-between">
						<div class="flex-1 pr-6">
							<h3 class="text-2xl font-semibold text-slate-900">{{ $task->title }}</h3>
							<p class="text-sm text-slate-500 mt-2">{{ $task->description ?? '—' }}</p>

							<div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
								<div>
									<h4 class="text-sm font-medium text-slate-600">Projeto</h4>
									@if($task->project)
										<p class="text-slate-800"><a href="{{ route('projects.show', $task->project) }}" class="text-indigo-600 hover:text-indigo-700">{{ $task->project->name }}</a></p>
									@else
										<p class="text-slate-800">—</p>
									@endif
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Prazo</h4>
									<p class="text-slate-800">{{ $task->deadline ? \Illuminate\Support\Carbon::parse($task->deadline)->format('d/m/Y') : '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Status</h4>
									<p class="text-slate-800">{{ $task->status ?? '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Criado em</h4>
									<p class="text-slate-800">{{ $task->created_at ? \Illuminate\Support\Carbon::parse($task->created_at)->format('d/m/Y H:i') : '—' }}</p>
								</div>
							</div>
						</div>

						<div class="w-48 flex-shrink-0">
							<div class="space-y-2">
								<a href="{{ route('tasks.edit', $task) }}" class="block text-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Editar</a>

								<form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="w-full px-4 py-2 rounded-md bg-red-600 text-white text-sm font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Excluir</button>
								</form>

								<a href="{{ route('tasks.index') }}" class="block text-center px-4 py-2 rounded-md bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300">Voltar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
