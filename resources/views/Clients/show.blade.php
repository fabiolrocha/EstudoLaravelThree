<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
            {{ $client->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6 bg-white">
                    <div class="flex items-start space-x-6">
                        <div class="w-36 h-36 bg-gray-100 flex items-center justify-center rounded-lg overflow-hidden ring-1 ring-gray-200">
                            @if($client->hasMedia('logos'))
                            <img src="{{ $client->getFirstMediaUrl('logos') }}" alt="Logo do {{ $client->name }}" style="max-width: 200px; margin-top: 10px;">
                            @else
                            <p class="text-gray-400">Sem Logo</p>
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-semibold text-slate-900">{{ $client->name }}</h3>
                                    <p class="text-sm text-slate-500">{{ $client->contact_person }}</p>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('clients.edit', $client) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Editar</a>

                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-red-600 text-white text-sm font-medium shadow hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Excluir</button>
                                    </form>

                                    <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300">Voltar</a>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-slate-600">Email</h4>
                                    <p class="text-slate-800">{{ $client->email }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-slate-600">Telefone</h4>
                                    <p class="text-slate-800">{{ $client->phone}}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-slate-600">Endereço</h4>
                                    <p class="text-slate-800">{{ $client->address}}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-slate-600">Status</h4>
                                    <p class="text-slate-800">{{ $client->status}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>