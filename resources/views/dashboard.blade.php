@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <x-dashboard-card title="Tasks Completed Today" :value="$completedToday" color="green" />
            <x-dashboard-card title="Overdue Tasks" :value="$overdue" color="red" />
            <x-dashboard-card title="Tasks Due Today" :value="$dueToday" color="yellow" />
            <x-dashboard-card title="Total Tasks" :value="$totalTasks" color="blue" />
            <x-dashboard-card title="Completed Tasks" :value="$completedTotal" color="emerald" />
            <x-dashboard-card title="Incomplete Tasks" :value="$incompleteTotal" color="orange" />
        </div>

        {{-- Upcoming Tasks --}}
        <div>
            <h2 class="text-2xl font-semibold mb-4">Upcoming Tasks (Today & Tomorrow)</h2>

            @if ($upcomingTasks->isEmpty())
                <p class="text-gray-600">No upcoming tasks due today or tomorrow.</p>
            @else
                <ul class="space-y-3">
                    @foreach ($upcomingTasks as $task)
                        <li class="p-4 bg-white border rounded shadow-sm flex justify-between items-center">
                            <div>
                                <p class="font-medium text-lg">{{ $task->title }}</p>

                                <p class="text-sm text-gray-600 flex items-center">
                                    Due: {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}

                                    {{-- Badge for "Today" or "Tomorrow" --}}
                                    @php
                                        $dueDate = \Carbon\Carbon::parse($task->due_date);
                                        $today = \Carbon\Carbon::today();
                                        $tomorrow = \Carbon\Carbon::tomorrow();
                                    @endphp

                                    @if ($dueDate->isSameDay($today))
                                        <span
                                            class="ml-2 text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Today</span>
                                    @elseif ($dueDate->isSameDay($tomorrow))
                                        <span
                                            class="ml-2 text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Tomorrow</span>
                                    @endif

                                    @if ($task->category)
                                        <span class="ml-4 text-gray-500 text-xs">| Category:
                                            {{ $task->category->name }}</span>
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('tasks.show', $task) }}"
                                class="text-blue-600 hover:underline text-sm">View</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
