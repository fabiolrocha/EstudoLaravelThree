<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('EDIT COMPANIES') }}
                </h2>
                <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-slate-600 text-white text-sm font-semibold shadow hover:bg-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    {{ __('BACK') }}
                </a>
            </div>
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6">
                    <form action="{{route ('clients.update', $client)}}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Company Name:</label>
                                <input type="text" name="name" id="name" required value="{{ $client->name }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="contact_user_id" class="block text-sm font-medium text-slate-700 mb-2">Manager:</label>
                                <select name="contact_user_id" id="contact_user_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Nenhum --</option>
                                    @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}"
                                        {{-- Lógica crucial: Verifica o valor antigo OU o valor atual --}}
                                        @if(old('contact_user_id', $client->contact_user_id) == $manager->id) 
                                        selected
                                        @endif
                                        >
                                        {{ $manager->name }} ({{ $manager->email }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">E-Mail:</label>
                                <input type="email" name="email" id="email" required value="{{ $client->email }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-slate-700 mb-2">Address:</label>
                                <input type="text" name="address" id="address" required value="{{ $client->address }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>