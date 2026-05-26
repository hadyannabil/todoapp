<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TodoApp') - Manajemen Tugas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #0F172A;
            --surface:  #1E293B;
            --surface2: #293548;
            --border:   #334155;
            --accent:   #38BDF8;
            --accent2:  #22C55E;
            --danger:   #F87171;
            --warning:  #FBBF24;
            --text:     #F8FAFC;
            --muted:    #94A3B8;
            --radius:   14px;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* NAV */
        nav {
            background: rgba(30,41,59,0.85);
            backdrop-filter: blur(12px);
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
            font-size: 1.3rem;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-brand .brand-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #38BDF8, #818CF8);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .nav-brand .brand-icon svg { width: 18px; height: 18px; fill: white; }

        .nav-brand span { color: var(--accent); }

        .nav-links { display: flex; align-items: center; gap: 0.5rem; }

        .nav-links a, .nav-links button {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
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
            background: linear-gradient(135deg, #38BDF8, #818CF8);
            color: #0F172A;
            font-weight: 600;
            border-radius: 8px;
        }

        .nav-links .btn-accent:hover { opacity: 0.9; color: #0F172A; }

        .nav-user {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--muted);
            padding: 0.4rem 0.8rem;
            background: var(--surface2);
            border-radius: 8px;
        }

        .nav-user .avatar {
            width: 26px; height: 26px;
            background: linear-gradient(135deg, #38BDF8, #818CF8);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; color: white;
        }

        /* MAIN */
        main { max-width: 900px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* ALERTS */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-left: 4px solid;
            display: flex; align-items: center; gap: 0.6rem;
        }

        .alert-success { background: #052e16; border-color: var(--accent2); color: var(--accent2); }
        .alert-danger  { background: #2d1515; border-color: var(--danger); color: var(--danger); }

        /* CARDS */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .card:hover { border-color: #475569; }

        /* FORMS */
        .form-group { margin-bottom: 1.2rem; }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
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
            border-radius: 10px;
            color: var(--text);
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(56,189,248,0.12);
        }

        textarea { min-height: 100px; resize: vertical; }
        select option { background: var(--surface2); }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.3rem;
            border-radius: 10px;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #38BDF8, #818CF8);
            color: #0F172A;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(56,189,248,0.3); }

        .btn-secondary { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }

        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #ef4444; }

        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.8rem; }

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
            padding: 0.2rem 0.75rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending     { background: #422006; color: var(--warning); border: 1px solid #92400e55; }
        .badge-in_progress { background: #0c1a3a; color: var(--accent); border: 1px solid #38BDF855; }
        .badge-completed   { background: #052e16; color: var(--accent2); border: 1px solid #22C55E55; }

        /* DIVIDER */
        hr { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }

        /* GLOW EFFECT */
        .glow { box-shadow: 0 0 30px rgba(56,189,248,0.08); }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('todos.index') }}" class="nav-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
        </div>
        Todo<span>App</span>
    </a>
    <div class="nav-links">
        @auth
            <div class="nav-user">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                {{ Auth::user()->name }}
            </div>
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
