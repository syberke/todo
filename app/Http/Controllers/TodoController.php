<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query();

    
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        
        if ($request->status === 'completed') {
            $query->where('is_completed', true);
        }

        if ($request->status === 'pending') {
            $query->where('is_completed', false);
        }

        $todos = $query->latest()->get();

        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Todo::create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update(Todo $todo)
    {
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}