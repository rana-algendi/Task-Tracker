@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Task Details</h1>

        <div class="bg-white rounded-lg shadow p-6 space-y-4 border">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Title</h2>
                <p class="text-gray-900">{{ $task->title }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Description</h2>
                <p class="text-gray-700">{{ $task->description ?: 'No description.' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Due Date</h2>
                <p class="text-gray-700">
                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('F j, Y') : 'None' }}
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Category</h2>
                <p class="text-gray-700">
                    {{ $task->category?->name ?? 'None' }}
                </p>
            </div>
            
            <div>
                @if ($task->recurs_until)
                    <p><strong>Until:</strong> {{ $task->recurs_until->format('Y-m-d') }}</p>
                @else
                    <p><strong>Until:</strong> No end date</p>
                @endif

            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Status</h2>
                <span
                    class="inline-block px-3 py-1 rounded-full text-sm font-medium
                    {{ $task->completed_at ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ $task->completed_at ? 'Completed' : 'Incomplete' }}
                </span>
            </div>

            <div class="pt-4 flex items-center justify-between">
                <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:underline">Edit Task</a>
                <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:underline">Back to List</a>
            </div>
        </div>
    </div>
@endsection
