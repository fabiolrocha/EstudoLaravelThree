<x-app-layout>
	<x-slot name="header">
		<h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
			{{ $project->name ?? 'Project' }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
				<div class="p-6 bg-white">
					<div class="flex items-start justify-between">
						<div class="flex-1 pr-6">
							<h3 class="text-2xl font-semibold text-slate-900">{{ $project->name ?? '—' }}</h3>
							<p class="text-sm text-slate-500 mt-2">{{ $project->description ?? '—' }}</p>

							<div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
								<div>
									<h4 class="text-sm font-medium text-slate-600">Cliente</h4>
									<p class="text-slate-800">{{ $project->client->name ?? ($project->client_id ? 'ID: '.$project->client_id : '—') }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Prazo</h4>
									<p class="text-slate-800">{{ $project->deadline ? \Illuminate\Support\Carbon::parse($project->deadline)->format('d/m/Y') : '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Status</h4>
									<p class="text-slate-800">{{ $project->status ?? '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-slate-600">Criado em</h4>
									<p class="text-slate-800">{{ $project->created_at ? \Illuminate\Support\Carbon::parse($project->created_at)->format('d/m/Y H:i') : '—' }}</p>
								</div>
							</div>

							<div class="mt-6">
								<h4 class="text-sm font-medium text-slate-600">Tarefas</h4>
								@if(isset($project->tasks) && count($project->tasks))
									<ul class="mt-2 divide-y divide-gray-100 border rounded-md">
										@foreach($project->tasks as $task)
											<li class="px-4 py-3 flex items-center justify-between">
												<div>
													<div class="text-slate-900">{{ $task->description }}</div>
													<div class="text-sm text-slate-500">Prazo: {{ $task->deadline ? \Illuminate\Support\Carbon::parse($task->deadline)->format('d/m/Y') : '—' }} — {{ $task->status ?? '—' }}</div>
												</div>
												<div>
													<a href="#" class="text-indigo-600 hover:text-indigo-700 text-sm">Ver</a>
												</div>
											</li>
										@endforeach
									</ul>
								@else
									<p class="text-slate-500 mt-2">Nenhuma tarefa encontrada.</p>
								@endif
							</div>
						</div>

						<div class="w-48 flex-shrink-0">
							<div class="space-y-2">
								<a href="{{ route('projects.edit', $project) }}" class="block w-full text-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Editar</a>

								<form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="w-full px-4 py-2 rounded-md bg-red-600 text-white text-sm font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Excluir</button>
								</form>

								<a href="{{ route('projects.index') }}" class="block w-full text-center px-4 py-2 rounded-md bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300">Voltar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>