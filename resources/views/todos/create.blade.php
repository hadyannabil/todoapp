@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')

<div style="max-width:600px; margin:0 auto;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('todos.index') }}" style="color:var(--muted); text-decoration:none; font-size:0.875rem; display:inline-flex; align-items:center; gap:0.4rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>

    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:0.3rem;">
        <div style="width:44px; height:44px; background:linear-gradient(135deg,#38BDF8,#818CF8); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                <line x1="12" y1="7" x2="12" y2="13"/><line x1="9" y1="10" x2="15" y2="10"/>
            </svg>
        </div>
        <div>
            <h1 class="page-title" style="font-size:1.7rem; margin-bottom:0;">Tambah Tugas</h1>
            <p class="page-subtitle" style="margin-bottom:0;">Buat tugas baru untuk dikerjakan</p>
        </div>
    </div>

    <br>

    <div class="card glow">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Judul Tugas *</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title') }}"
                       placeholder="Masukkan judul tugas...">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description"
                          placeholder="Jelaskan detail tugas ini...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status">
                        <option value="pending"     {{ old('status') === 'pending'     ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="completed"   {{ old('status') === 'completed'   ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Tenggat Waktu</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date') }}">
                </div>
            </div>

            <hr>

            <div style="display:flex; gap:0.75rem; justify-content:flex-end;">
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Simpan Tugas
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
