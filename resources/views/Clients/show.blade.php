<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $client->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start space-x-6">
                        <div class="w-36 h-36 bg-gray-100 flex items-center justify-center rounded-md overflow-hidden">
                            @if($client->hasMedia('logos'))
                            <img src="{{ $client->getFirstMediaUrl('logos') }}" alt="Logo do {{ $client->name }}" style="max-width: 200px; margin-top: 10px;">
                            @else
                            <p class="text-gray-400">Sem Logo</p>
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-semibold text-gray-900">{{ $client->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $client->contact_person }}</p>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('clients.edit', $client) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm">Editar</a>

                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md text-sm">Excluir</button>
                                    </form>

                                    <a href="{{ route('clients.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-200 text-gray-800 rounded-md text-sm">Voltar</a>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Email</h4>
                                    <p class="text-gray-800">{{ $client->email }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Telefone</h4>
                                    <p class="text-gray-800">{{ $client->phone}}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Endereço</h4>
                                    <p class="text-gray-800">{{ $client->address}}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Status</h4>
                                    <p class="text-gray-800">{{ $client->status}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>