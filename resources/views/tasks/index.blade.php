@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create Task
            </a>
        </div>

        {{-- Flash Success Message --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-4">
            {{-- Category --}}
            <select name="category_id" class="border-gray-300 rounded px-3 py-2">
                <option value="">All Categories</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            {{-- Start Date --}}
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="border-gray-300 rounded px-3 py-2" placeholder="Start Date">

            {{-- End Date --}}
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="border-gray-300 rounded px-3 py-2" placeholder="End Date">

            {{-- Completion Status --}}
            <select name="completed" class="border-gray-300 rounded px-3 py-2">
                <option value="">All</option>
                <option value="1" {{ request('completed') === '1' ? 'selected' : '' }}>Completed</option>
                <option value="0" {{ request('completed') === '0' ? 'selected' : '' }}>Incomplete</option>
            </select>

            {{-- Filter + Reset --}}
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
                <a href="{{ route('tasks.index') }}" class="text-gray-600 underline px-2 py-2">Reset</a>
            </div>
        </form>

        {{-- Task List --}}
        <div class="space-y-4">
            @forelse ($tasks as $task)
                <div
                    class="p-4 border rounded shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center bg-white">
                    <div class="mb-2 md:mb-0">
                        <h2 class="text-lg font-semibold {{ $task->completed_at ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </h2>
                        <p class="text-sm text-gray-600">{{ $task->description }}</p>
                        <p class="text-sm mt-1 text-gray-500">
                            <strong>Due:</strong>
                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '—' }} |
                            <strong>Category:</strong> {{ $task->category->name ?? '—' }} |
                            <strong>Status:</strong>
                            <span class="{{ $task->completed_at ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ $task->completed_at ? '✔ Completed' : '⏳ Incomplete' }}
                            </span>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        {{-- Toggle Completion --}}
                        <form method="POST"
                            action="{{ $task->completed_at ? route('tasks.incomplete', $task) : route('tasks.complete', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="text-sm {{ $task->completed_at ? 'text-yellow-600' : 'text-green-600' }} hover:underline">
                                {{ $task->completed_at ? 'Mark Incomplete' : 'Mark Complete' }}
                            </button>
                        </form>

                        {{-- Show --}}
                        <a href="{{ route('tasks.show', $task) }}" class="text-sm text-indigo-600 hover:underline">Show</a>

                        {{-- Edit --}}
                        <a href="{{ route('tasks.edit', $task) }}" class="text-sm text-blue-600 hover:underline">Edit</a>

                        {{-- Delete --}}
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No tasks found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $tasks->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
