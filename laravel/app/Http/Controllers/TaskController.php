<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $tasks = $user->tasks()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title"       => "required|string|max:255",
            "description" => "nullable|string",
            "status"      => "required|in:pending,in_progress,done",
            "priority"    => "required|in:low,medium,high",
            "due_date"    => "nullable|date|after_or_equal:now",
            "category_id" => "nullable|exists:categories,id"
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана!');
    }

    public function edit(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->get();
        
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->validate([
            "title"       => "required|string|max:255",
            "description" => "nullable|string",
            "status"      => "required|in:pending,in_progress,done",
            "priority"    => "required|in:low,medium,high",
            "due_date"    => "nullable|date|after_or_equal:now",
            "category_id" => "nullable|exists:categories,id"
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Задача updated!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача удалена');
    }
}