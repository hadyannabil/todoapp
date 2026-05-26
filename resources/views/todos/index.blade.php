@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 class="page-title" style="margin-bottom:0.2rem;">📚 Daftar Tugas</h1>
        <p class="page-subtitle" style="margin-bottom:0;">Semua tugas yang telah dibuat oleh pengguna</p>
    </div>
    @auth
    <a href="{{ route('todos.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Tugas
    </a>
    @endauth
</div>

@if($todos->isEmpty())
    <div class="card glow" style="text-align:center; padding:4rem 2rem;">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#38BDF8" stroke-width="1.2" style="margin: 0 auto 1.5rem; display:block; opacity:0.5;">
            <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
        </svg>
        <p style="color:var(--muted); font-size:1.1rem; margin-bottom:1.5rem;">Belum ada tugas. Jadilah yang pertama menambahkan!</p>
        @auth
        <a href="{{ route('todos.create') }}" class="btn btn-primary">+ Tambah Tugas Pertama</a>
        @endauth
    </div>
@else
    <div style="display:flex; flex-direction:column; gap:0.75rem;">
        @foreach($todos as $todo)
        <div class="card" style="display:flex; align-items:center; gap:1.25rem; padding:1.1rem 1.4rem;">

            <div style="width:36px; height:36px; border-radius:10px; flex-shrink:0; display:flex; align-items:center; justify-content:center;
                background: {{ $todo->status === 'completed' ? 'rgba(34,197,94,0.12)' : ($todo->status === 'in_progress' ? 'rgba(56,189,248,0.12)' : 'rgba(251,191,36,0.12)') }}">
                @if($todo->status === 'completed')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                @elseif($todo->status === 'in_progress')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#38BDF8" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                @else
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FBBF24" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                @endif
            </div>

            <div style="flex:1; min-width:0;">
                <a href="{{ route('todos.show', $todo) }}"
                   style="font-weight:600; font-size:1rem; color:var(--text); text-decoration:none;
                          {{ $todo->status === 'completed' ? 'text-decoration:line-through; opacity:0.5;' : '' }}">
                    {{ $todo->title }}
                </a>
                <div style="display:flex; gap:0.6rem; align-items:center; margin-top:0.3rem; flex-wrap:wrap;">
                    <span class="badge badge-{{ $todo->status }}">{{ $todo->status_label }}</span>
                    <span style="font-size:0.78rem; color:var(--muted); display:flex; align-items:center; gap:0.3rem;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ $todo->user->name }}
                    </span>
                    @if($todo->due_date)
                    <span style="font-size:0.78rem; color:var(--muted); display:flex; align-items:center; gap:0.3rem;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $todo->due_date->format('d M Y') }}
                    </span>
                    @endif
                </div>
            </div>

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
