@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div style="max-width:420px; margin:3rem auto;">
    <div style="text-align:center; margin-bottom:2rem;">
        <div style="width:64px; height:64px; background:linear-gradient(135deg,#38BDF8,#818CF8); border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <h1 class="page-title" style="font-size:2rem;">Masuk</h1>
        <p class="page-subtitle" style="margin-bottom:0;">Masuk ke akun Anda untuk mengelola tugas</p>
    </div>

    <div class="card glow">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="email@contoh.com"
                       autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1.5rem;">
                <input type="checkbox" id="remember" name="remember"
                       style="width:auto; accent-color:var(--accent);">
                <label for="remember" style="text-transform:none; letter-spacing:0; font-size:0.875rem; margin:0; color:var(--muted);">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:0.8rem;">
                Masuk →
            </button>
        </form>
    </div>

    <p style="text-align:center; color:var(--muted); font-size:0.875rem; margin-top:1.5rem;">
        Belum punya akun?
        <a href="{{ route('register') }}" style="color:var(--accent); text-decoration:none; font-weight:500;">Daftar sekarang</a>
    </p>
</div>

@endsection
