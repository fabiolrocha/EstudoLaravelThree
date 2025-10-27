<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 mb-4 flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('CREATE TASKS') }}
                </h2>
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-slate-600 text-white text-sm font-semibold shadow hover:bg-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    {{ __('BACK') }}
                </a>
            </div>
            <div class="bg-white/90 backdrop-blur overflow-hidden shadow-sm ring-1 ring-gray-200 rounded-xl">
                <div class="p-6">
                    <form action="{{route ('tasks.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label for="project_id" class="block text-sm font-medium text-slate-700">Project</label>
                                <select name="project_id" id="project_id" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status:</label>
                                <select name="status" id="status" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Selecione --</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div>
                                <label for="deadline" class="block text-sm font-medium text-slate-700 mb-2">Deadline:</label>
                                <input type="date" name="deadline" id="deadline" min="{{ date('Y-m-d') }}" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>