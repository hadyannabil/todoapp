<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TodoApp') - Manajemen Tugas</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #060610;
            --surface: #0f0f1a;
            --surface2: #181828;
            --border: #252538;
            --accent: #7c6cfc;
            --accent-glow: #7c6cfc33;
            --accent2: #34eba8;
            --danger: #ff4d6a;
            --text: #e2e2f0;
            --muted: #7878a0;
            --radius: 12px;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            background-image: radial-gradient(ellipse at 20% 0%, #1a0f3a 0%, transparent 60%),
                              radial-gradient(ellipse at 80% 0%, #0a1a30 0%, transparent 60%);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* NAV */
        nav {
            background: rgba(15, 15, 26, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
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
            color: #fff;
            font-weight: 600;
        }

        .nav-links .btn-accent:hover { background: #6a5bf0; color: #fff; }

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
            transition: border-color 0.2s;
        }

        .card:hover {
            border-color: #353550;
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
            box-shadow: 0 0 0 3px var(--accent-glow);
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

        .btn-primary { background: var(--accent); color: #fff; box-shadow: 0 0 16px var(--accent-glow); }
        .btn-primary:hover { background: #6a5bf0; box-shadow: 0 0 24px var(--accent-glow); }

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

        .badge-pending     { background: #2a2010; color: #f0b840; border: 1px solid #f0b84040; }
        .badge-in_progress { background: #101830; color: #60b0ff; border: 1px solid #60b0ff40; }
        .badge-completed   { background: #0f2820; color: var(--accent2); border: 1px solid #34eba840; }

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
