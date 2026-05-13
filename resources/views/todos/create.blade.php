@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')

<div style="max-width:600px; margin:0 auto;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('todos.index') }}" style="color:var(--muted); text-decoration:none; font-size:0.9rem;">← Kembali</a>
    </div>

    <h1 class="page-title">Tambah Tugas</h1>
    <p class="page-subtitle">Buat tugas baru untuk dikerjakan</p>

    <div class="card">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Judul Tugas *</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title') }}"
                       placeholder="Masukkan judul tugas..."
                       class="{{ $errors->has('title') ? 'is-invalid' : '' }}">
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
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="due_date">Tenggat Waktu</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date') }}">
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <div style="display:flex; gap:0.75rem; justify-content:flex-end;">
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Tugas</button>
            </div>
        </form>
    </div>
</div>

@endsection
