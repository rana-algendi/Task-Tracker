@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <button type="submit"
                        class="ml-2 text-gray-600 hover:underline">
                    Update Category
                </button>
                <a href="{{ route('categories.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
