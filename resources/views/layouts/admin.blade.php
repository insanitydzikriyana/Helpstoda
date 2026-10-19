<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} · HELPSTODA</title>
    @vite(['resources/css/app.css', 'resources/css/admin-refresh.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="sidebar" id="sidebar">
            <a class="brand" href="{{ route('dashboard') }}"><x-brand-mark /><span><strong>HELPSTODA</strong><small>HELPDESK STORAGE DATA</small></span></a>
            <div class="side-label">MENU UTAMA</div>
            <nav class="side-nav" aria-label="Navigasi utama">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><span class="nav-icon">⌂</span>Dashboard</a>
                <a href="{{ route('records.index') }}" class="{{ request()->routeIs('records.*') ? 'active' : '' }}"><span class="nav-icon">▤</span>Data helpdesk <span class="nav-count">{{ \App\Models\HelpdeskRecord::count() }}</span></a>
            </nav>
            <div class="sidebar-bottom">
                <div class="user-card"><div class="avatar">H</div><div class="user-meta"><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></div><form method="POST" action="{{ route('logout') }}">@csrf<button class="logout-button" title="Keluar" aria-label="Keluar">↗</button></form></div>
            </div>
        </aside>
        <main class="main-panel">
            <header class="topbar"><button class="menu-toggle" id="menu-toggle" aria-label="Buka menu">☰</button><div class="breadcrumb">Workspace <span>/</span> <strong>{{ $breadcrumb ?? 'Dashboard' }}</strong></div><div class="topbar-right"><span class="today-label">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span><span class="top-avatar">H</span></div></header>
            <div class="page-content">@yield('content')</div>
            <footer class="footer">© {{ now()->year }} HELPSTODA <span>·</span> Helpdesk storage data</footer>
        </main>
    </div>
</body>
</html>
