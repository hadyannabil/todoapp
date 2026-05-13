<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TodoApp') - Manajemen Tugas</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0e0e10;
            --surface: #1a1a1f;
            --surface2: #24242b;
            --border: #2e2e38;
            --accent: #f0e040;
            --accent2: #40e0a0;
            --danger: #ff5566;
            --text: #e8e8ec;
            --muted: #888896;
            --radius: 12px;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* NAV */
        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-brand span { color: var(--accent2); }

        .nav-links { display: flex; align-items: center; gap: 0.5rem; }

        .nav-links a, .nav-links button {
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 0.45rem 1rem;
            border-radius: 8px;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.2s, background 0.2s;
        }

        .nav-links a:hover, .nav-links button:hover {
            color: var(--text);
            background: var(--surface2);
        }

        .nav-links .btn-accent {
            background: var(--accent);
            color: #0e0e10;
            font-weight: 600;
        }

        .nav-links .btn-accent:hover { background: #ffe820; color: #0e0e10; }

        .nav-user {
            font-size: 0.85rem;
            color: var(--muted);
            padding: 0.4rem 0.8rem;
            background: var(--surface2);
            border-radius: 8px;
        }

        /* MAIN */
        main { max-width: 900px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* ALERTS */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            border-left: 4px solid;
        }

        .alert-success { background: #1a2e22; border-color: var(--accent2); color: var(--accent2); }
        .alert-danger  { background: #2e1a1a; border-color: var(--danger); color: var(--danger); }

        /* CARDS */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
        }

        /* FORMS */
        .form-group { margin-bottom: 1.2rem; }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.2s;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--accent);
        }

        textarea { min-height: 100px; resize: vertical; }
        select option { background: var(--surface2); }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.82rem;
            margin-top: 0.3rem;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.3rem;
            border-radius: 8px;
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary { background: var(--accent); color: #0e0e10; }
        .btn-primary:hover { background: #ffe820; }

        .btn-secondary { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }

        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #ff3344; }

        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.82rem; }

        /* PAGE TITLE */
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 0.3rem;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending     { background: #2e2a1a; color: #f0c040; border: 1px solid #f0c04055; }
        .badge-in_progress { background: #1a2030; color: #40a0f0; border: 1px solid #40a0f055; }
        .badge-completed   { background: #1a2e22; color: var(--accent2); border: 1px solid #40e0a055; }

        /* DIVIDER */
        hr { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('todos.index') }}" class="nav-brand">Todo<span>App</span></a>
    <div class="nav-links">
        @auth
            <span class="nav-user">👤 {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="btn-accent">Daftar</a>
        @endauth
    </div>
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">✕ {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>
