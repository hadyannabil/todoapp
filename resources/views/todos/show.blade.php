@extends('layouts.app')

@section('title', $todo->title)

@section('content')

<div style="margin-bottom:1.5rem;">
    <a href="{{ route('todos.index') }}" style="color:var(--muted); text-decoration:none; font-size:0.9rem;">← Kembali ke Daftar</a>
</div>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <h1 style="font-family:'Syne',sans-serif; font-size:1.8rem; font-weight:800; margin-bottom:0.5rem;">
                {{ $todo->title }}
            </h1>
            <span class="badge badge-{{ $todo->status }}">{{ $todo->status_label }}</span>
        </div>

        @auth
            @if(Auth::id() === $todo->user_id)
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('todos.edit', $todo) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
            @endif
        @endauth
    </div>

    <hr>

    @if($todo->description)
    <div style="margin-bottom:1.5rem;">
        <label>Deskripsi</label>
        <p style="color:var(--text); line-height:1.7; margin-top:0.5rem;">{{ $todo->description }}</p>
    </div>
    @endif

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:1rem; margin-top:1.5rem;">
        <div style="background:var(--surface2); border-radius:8px; padding:1rem;">
            <div style="font-size:0.75rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.3rem;">Dibuat oleh</div>
            <div style="font-weight:500;">{{ $todo->user->name }}</div>
        </div>

        @if($todo->due_date)
        <div style="background:var(--surface2); border-radius:8px; padding:1rem;">
            <div style="font-size:0.75rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.3rem;">Tenggat Waktu</div>
            <div style="font-weight:500;">{{ $todo->due_date->format('d M Y') }}</div>
        </div>
        @endif

        <div style="background:var(--surface2); border-radius:8px; padding:1rem;">
            <div style="font-size:0.75rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.3rem;">Dibuat pada</div>
            <div style="font-weight:500;">{{ $todo->created_at->format('d M Y, H:i') }}</div>
        </div>

        <div style="background:var(--surface2); border-radius:8px; padding:1rem;">
            <div style="font-size:0.75rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.3rem;">Diperbarui pada</div>
            <div style="font-weight:500;">{{ $todo->updated_at->format('d M Y, H:i') }}</div>
        </div>
    </div>
</div>

@endsection
