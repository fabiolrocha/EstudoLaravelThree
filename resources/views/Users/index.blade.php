<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('USERS') }}
                </h2>
                <a href="{{ route('users.create') }}" type="button" class="group inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow-md hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">
                    <svg class="h-4 w-4 opacity-90 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create
                </a>
            </div>
                <div class="bg-white/90 backdrop-blur shadow-sm ring-1 ring-gray-200 rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">ID</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">Nome</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">Email</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">Phone</th>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">Cargo</th>
                                <th class="px-6 py-3 text-right text-[11px] font-semibold text-slate-600 uppercase tracking-wider" scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                            <tr class="hover:bg-indigo-50/50 transition-colors">
                                <th class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><a class="hover:text-indigo-700" scope="row">{{ $user->id }}</th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $user->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $user->getRoleNames()->first() ?? 'Funcionario' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-600 text-white text-xs font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 mr-2">Editar</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir este projeto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-red-600 text-white text-xs font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Nenhum usuário cadastrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>