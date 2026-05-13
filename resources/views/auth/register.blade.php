@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<div style="max-width:420px; margin:3rem auto;">
    <div style="text-align:center; margin-bottom:2rem;">
        <h1 class="page-title" style="font-size:2.2rem;">Daftar</h1>
        <p class="page-subtitle" style="margin-bottom:0;">Buat akun baru untuk mulai mengelola tugas</p>
    </div>

    <div class="card">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Nama Anda"
                       autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="email@contoh.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
                Buat Akun →
            </button>
        </form>
    </div>

    <p style="text-align:center; color:var(--muted); font-size:0.9rem; margin-top:1.5rem;">
        Sudah punya akun?
        <a href="{{ route('login') }}" style="color:var(--accent); text-decoration:none; font-weight:500;">Masuk di sini</a>
    </p>
</div>

@endsection
