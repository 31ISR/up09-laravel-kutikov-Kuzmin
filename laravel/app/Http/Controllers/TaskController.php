<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = $user->tasks()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function store()
    {
        // валидируйте
        // title - обязательное, строка, максимум 255 символов
        // description - необязательное, строка
        // status - обязательное, присутствует в enum 'pending','in_progress', 'done
        // priority - обязательное, присутствует в enum 'low, medium, high'
        // due_date - необязательное, дата, допустимое значение - сегодня и позже
        // category_id - необязательное, существует id в таблице категорий
    }

    public function create()
    {
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
