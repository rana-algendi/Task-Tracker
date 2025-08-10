<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->tasks()->with('category');

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by completion
        if ($request->completed === '1') {
            $query->whereNotNull('completed_at');
        } elseif ($request->completed === '0') {
            $query->whereNull('completed_at');
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('due_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('due_date', '<=', $request->end_date);
        }

        $tasks = $query->paginate(10);

        $categories = auth()->user()->categories->pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = auth()->user()->categories()->pluck('name', 'id');
        $task = new Task(); // pass empty model

        return view('tasks.create', compact('categories', 'task'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //dd($request->validated());

        $data = $request->validated();

        $data['user_id'] = auth()->id();

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task); // Optional: if using policies

        return view('tasks.show', [
            'task' => $task
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task); // Only if using policies

        $categories = auth()->user()->categories()->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'categories'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    public function markComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['completed_at' => now()]);
        return back()->with('success', 'Marked as complete.');
    }

    public function markIncomplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['completed_at' => null]);
        return back()->with('success', 'Marked as incomplete.');
    }
}