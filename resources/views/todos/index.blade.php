@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')

<div style="text-align:center; margin-bottom:2rem;">
    <h1 class="page-title">Daftar Tugas</h1>
    <p class="page-subtitle">Semua tugas yang telah dibuat oleh pengguna</p>
</div>

@if($todos->isEmpty())
    <div class="card" style="text-align:center; padding:3rem;">
        <div style="font-size:3rem; margin-bottom:1rem;">📋</div>
        <p style="color:var(--muted); font-size:1.1rem;">Belum ada tugas. Jadilah yang pertama menambahkan!</p>
        @auth
        <a href="{{ route('todos.create') }}" class="btn btn-primary" style="margin-top:1.5rem;">+ Tambah Tugas</a>
        @endauth
    </div>
@else
    <div style="display:flex; flex-direction:column; gap:0.75rem;">
        @foreach($todos as $todo)
        <div class="card" style="display:flex; align-items:center; gap:1.5rem; padding:1.2rem 1.5rem;">

            {{-- Status dot --}}
            <div style="width:10px; height:10px; border-radius:50%; flex-shrink:0;
                background: {{ $todo->status === 'completed' ? 'var(--accent2)' : ($todo->status === 'in_progress' ? '#40a0f0' : '#f0c040') }}">
            </div>

            {{-- Info --}}
            <div style="flex:1; min-width:0;">
                <a href="{{ route('todos.show', $todo) }}"
                   style="font-weight:700; font-size:1.05rem; color:var(--text); text-decoration:none;
                          {{ $todo->status === 'completed' ? 'text-decoration:line-through; opacity:0.6;' : '' }}">
                    {{ $todo->title }}
                </a>
                <div style="display:flex; gap:0.75rem; align-items:center; margin-top:0.25rem; flex-wrap:wrap;">
                    <span class="badge badge-{{ $todo->status }}">{{ $todo->status_label }}</span>
                    <span style="font-size:0.8rem; color:var(--muted);">oleh {{ $todo->user->name }}</span>
                    @if($todo->due_date)
                    <span style="font-size:0.8rem; color:var(--muted);">
                        📅 {{ $todo->due_date->format('d M Y') }}
                    </span>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex; gap:0.5rem; flex-shrink:0;">
                <a href="{{ route('todos.show', $todo) }}" class="btn btn-secondary btn-sm">Lihat</a>
                @auth
                    @if(Auth::id() === $todo->user_id)
                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    @endif
                @endauth
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top:2rem;">
        {{ $todos->links() }}
    </div>
@endif

@endsection
