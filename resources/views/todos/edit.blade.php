@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')

<div style="max-width:600px; margin:0 auto;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('todos.index') }}" style="color:var(--muted); text-decoration:none; font-size:0.875rem; display:inline-flex; align-items:center; gap:0.4rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>

    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:0.3rem;">
        <div style="width:44px; height:44px; background:linear-gradient(135deg,#FBBF24,#F87171); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
        </div>
        <div>
            <h1 class="page-title" style="font-size:1.7rem; margin-bottom:0;">Edit Tugas</h1>
            <p class="page-subtitle" style="margin-bottom:0;">Perbarui informasi tugas</p>
        </div>
    </div>

    <br>

    <div class="card">
        <form action="{{ route('todos.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Tugas *</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $todo->title) }}"
                       placeholder="Masukkan judul tugas...">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description"
                          placeholder="Jelaskan detail tugas ini...">{{ old('description', $todo->description) }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status">
                        <option value="pending"     {{ old('status', $todo->status) === 'pending'     ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="in_progress" {{ old('status', $todo->status) === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="completed"   {{ old('status', $todo->status) === 'completed'   ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Tenggat Waktu</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date', $todo->due_date?->format('Y-m-d')) }}">
                </div>
            </div>

            <hr>

            <div style="display:flex; gap:0.75rem; justify-content:flex-end;">
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection
