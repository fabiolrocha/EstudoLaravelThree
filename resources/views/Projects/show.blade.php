<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ $project->name ?? 'Project' }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<div class="flex items-start justify-between">
						<div class="flex-1 pr-6">
							<h3 class="text-2xl font-semibold text-gray-900">{{ $project->name ?? '—' }}</h3>
							<p class="text-sm text-gray-500 mt-2">{{ $project->description ?? '—' }}</p>

							<div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
								<div>
									<h4 class="text-sm font-medium text-gray-600">Cliente</h4>
									<p class="text-gray-800">{{ $project->client->name ?? ($project->client_id ? 'ID: '.$project->client_id : '—') }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-gray-600">Prazo</h4>
									<p class="text-gray-800">{{ $project->deadline ? \Illuminate\Support\Carbon::parse($project->deadline)->format('d/m/Y') : '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-gray-600">Status</h4>
									<p class="text-gray-800">{{ $project->status ?? '—' }}</p>
								</div>

								<div>
									<h4 class="text-sm font-medium text-gray-600">Criado em</h4>
									<p class="text-gray-800">{{ $project->created_at ? \Illuminate\Support\Carbon::parse($project->created_at)->format('d/m/Y H:i') : '—' }}</p>
								</div>
							</div>

							<div class="mt-6">
								<h4 class="text-sm font-medium text-gray-600">Tarefas</h4>
								@if(isset($project->tasks) && count($project->tasks))
									<ul class="mt-2 divide-y divide-gray-100 border rounded-md">
										@foreach($project->tasks as $task)
											<li class="px-4 py-3 flex items-center justify-between">
												<div>
													<div class="text-gray-900">{{ $task->description }}</div>
													<div class="text-sm text-gray-500">Prazo: {{ $task->deadline ? \Illuminate\Support\Carbon::parse($task->deadline)->format('d/m/Y') : '—' }} — {{ $task->status ?? '—' }}</div>
												</div>
												<div>
													<a href="#" class="text-blue-600 text-sm">Ver</a>
												</div>
											</li>
										@endforeach
									</ul>
								@else
									<p class="text-gray-500 mt-2">Nenhuma tarefa encontrada.</p>
								@endif
							</div>
						</div>

						<div class="w-48 flex-shrink-0">
							<div class="space-y-2">
								<a href="{{ route('projects.edit', $project) }}" class="block w-full text-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm">Editar</a>

								<form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="w-full px-3 py-2 bg-red-600 text-white rounded-md text-sm">Excluir</button>
								</form>

								<a href="{{ route('projects.index') }}" class="block w-full text-center px-3 py-2 bg-gray-200 text-gray-800 rounded-md text-sm">Voltar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>