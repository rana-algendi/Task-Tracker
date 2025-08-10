@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">My Categories</h1>

        {{-- Flash success message --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

       {{-- Create button --}}
        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="ml-2 text-gray-600 hover:underline"> Create New Category</a>
        </div>

        {{-- Category table --}}
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $category->name }}</td>
                        <td class="py-2 px-4 text-right space-x-2">
                            <a href="{{ route('categories.edit', $category) }}"
                                class="text-indigo-600 hover:underline">Edit</a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="py-4 px-4 text-center text-gray-500">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
@endsection
