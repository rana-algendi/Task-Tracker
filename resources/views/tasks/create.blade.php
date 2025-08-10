@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Task</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Pass $submitText --}}
        @include('tasks.form', [
            'submitText' => 'Create Task',
            'task' => $task ?? null,
            'categories' => $categories,
        ])
        </form>
    </div>
    
   

   


@endsection
