<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('CLIENTS') }}
                </h2>
                <a href="{{ route('clients.create') }}" type="button" class="group inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow-md hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">
                    <svg class="h-4 w-4 opacity-90 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create
                </a>
            </div>
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Company Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Contact Person</th>
                                <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Address</th>
                                <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Phone</th>
                                <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-center text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($clients as $client)
                            <tr class="hover:bg-indigo-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->id }} </a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->name }} </a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->contact_person }} </a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->address }} </a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->phone }} </a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><a class="hover:text-indigo-700" href="{{route('clients.show', $client->id)}}"> {{ $client->email }} </a></td>
                                <td class="py-3 px-4 align-middle">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-600 text-white text-xs font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('clients.destroy', $client) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-red-600 text-white text-xs font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500"
                                                onclick="return confirm('Are you sure you want to delete this client?')">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Nenhum cliente encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</x-app-layout>