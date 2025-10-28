<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('CREATE USERS') }}
                </h2>
                <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-slate-600 text-white text-sm font-semibold shadow hover:bg-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    {{ __('BACK') }}
                </a>
            </div>
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6">
                    <form action="{{route ('users.store')}}" method="POST" enctype="multiparti/form-data" class="space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Name:</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">E-Mail:</label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password:</label>
                                <input type="password" name="password" id="password" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Confirm password:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="Phone" class="block text-sm font-medium text-slate-700 mb-2">Phone:</label>
                                <input type="tel" name="phone" id="phone" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $roleName)
                                <label for="role_{{ $roleName }}" class="flex items-center">
                                    <input id="role_{{ $roleName }}" type="checkbox" name="roles[]" value="{{ $roleName }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">{{ ucfirst($roleName) }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Create
                            </button>
                        </div>
                        @if ($errors->any())
                        <div style="color: red; margin-bottom: 1rem;">
                            <strong>Oops! Algo deu errado.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>