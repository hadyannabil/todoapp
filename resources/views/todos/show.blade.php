@extends('layouts.app')

@section('title', $todo->title)

@section('content')

<div style="margin-bottom:1.5rem;">
    <a href="{{ route('todos.index') }}" style="color:var(--muted); text-decoration:none; font-size:0.875rem; display:inline-flex; align-items:center; gap:0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="card glow">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <h1 style="font-size:1.7rem; font-weight:800; margin-bottom:0.5rem;">{{ $todo->title }}</h1>
            <span class="badge badge-{{ $todo->status }}">{{ $todo->status_label }}</span>
        </div>

        @auth
            @if(Auth::id() === $todo->user_id)
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('todos.edit', $todo) }}" class="btn btn-secondary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit
                </a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        @endauth
    </div>

    <hr>

    @if($todo->description)
    <div style="margin-bottom:1.5rem;">
        <label>Deskripsi</label>
        <p style="color:var(--text); line-height:1.8; margin-top:0.5rem; font-size:0.95rem;">{{ $todo->description }}</p>
    </div>
    @endif

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap:1rem; margin-top:1.5rem;">
        <div style="background:var(--surface2); border-radius:10px; padding:1rem; border:1px solid var(--border);">
            <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Dibuat oleh
            </div>
            <div style="font-weight:600; font-size:0.95rem;">{{ $todo->user->name }}</div>
        </div>

        @if($todo->due_date)
        <div style="background:var(--surface2); border-radius:10px; padding:1rem; border:1px solid var(--border);">
            <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Tenggat Waktu
            </div>
            <div style="font-weight:600; font-size:0.95rem;">{{ $todo->due_date->format('d M Y') }}</div>
        </div>
        @endif

        <div style="background:var(--surface2); border-radius:10px; padding:1rem; border:1px solid var(--border);">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Dibuat pada</div>
            <div style="font-weight:600; font-size:0.95rem;">{{ $todo->created_at->format('d M Y, H:i') }}</div>
        </div>

        <div style="background:var(--surface2); border-radius:10px; padding:1rem; border:1px solid var(--border);">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Diperbarui pada</div>
            <div style="font-weight:600; font-size:0.95rem;">{{ $todo->updated_at->format('d M Y, H:i') }}</div>
        </div>
    </div>
</div>

@endsection
