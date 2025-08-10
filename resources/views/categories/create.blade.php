 @if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- --------------------- --}}
{{-- <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}">
@error('name')
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror --}}


@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Category</h1>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form to create a category --}}
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Category Name</label>
                <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded"
                    value="{{ old('name') }}" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="mr-4 text-gray-600 hover:underline ">
                    Save
                </button>
                
                <a href="{{ route('categories.index') }}" class="mr-4 text-gray-600 hover:underline">Cancel</a>

            </div>
        </form>
    </div>
@endsection
