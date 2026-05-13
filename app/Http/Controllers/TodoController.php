<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('user')->latest()->paginate(10);
        return view('todos.index', compact('todos'));
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        Todo::create($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function edit(Todo $todo)
    {
        // Hanya pemilik tugas yang bisa mengedit
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus tugas ini.');
        }

        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }
}
