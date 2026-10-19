<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk · HELPSTODA</title>
    @vite(['resources/css/app.css', 'resources/css/admin-refresh.css', 'resources/js/app.js'])
</head>
<body class="login-body">
    <main class="login-layout">
        <section class="login-visual">
            <a class="login-brand" href="{{ route('login') }}"><x-brand-mark /><span><strong>HELPSTODA</strong><small>HELPDESK STORAGE DATA</small></span></a>
            <div class="visual-content">
                <div class="visual-kicker"><span></span> RUANG KERJA HELPDESK</div>
                <div class="robot-scene" aria-label="Ilustrasi robot customer service membawa dokumen data">
                    <div class="scene-glow"></div>
                    <svg class="robot-svg" viewBox="0 0 360 330" role="img" aria-hidden="true">
                        <defs>
                            <linearGradient id="robot-ceramic" x1="0" y1="0" x2="1" y2="1"><stop stop-color="#fff"/><stop offset="1" stop-color="#a9c6df"/></linearGradient>
                            <linearGradient id="robot-metal" x1="0" y1="0" x2="0" y2="1"><stop stop-color="#426d95"/><stop offset="1" stop-color="#1c3c5d"/></linearGradient>
                            <filter id="robot-shadow" x="-.3" y="-.2" width="1.6" height="1.6"><feDropShadow dx="0" dy="15" stdDeviation="12" flood-color="#06162a" flood-opacity=".32"/></filter>
                        </defs>
                        <circle cx="180" cy="174" r="126" fill="#5b94c4" opacity=".09"/>
                        <circle cx="180" cy="174" r="108" fill="none" stroke="#a9c9e4" stroke-opacity=".18"/>
                        <g filter="url(#robot-shadow)">
                            <path d="M123 101V91q0-32 32-32h50q32 0 32 32v10" fill="none" stroke="#74a1c7" stroke-width="8"/>
                            <rect x="98" y="99" width="24" height="48" rx="8" fill="url(#robot-metal)"/><rect x="238" y="99" width="24" height="48" rx="8" fill="url(#robot-metal)"/>
                            <path d="M105 116h10M245 116h10" stroke="#6bdccd" stroke-width="3" stroke-linecap="round"/>
                            <path d="M126 78q0-19 19-19h62q19 0 19 19v64q0 28-28 28h-44q-28 0-28-28z" fill="url(#robot-ceramic)"/>
                            <rect x="137" y="83" width="78" height="59" rx="15" fill="#142b45"/>
                            <rect x="151" y="109" width="50" height="5" rx="2.5" fill="#68dfd1"/><path d="M157 120h38" stroke="#7294b5" stroke-width="2" stroke-linecap="round"/>
                            <path d="M169 170v13h22v-13" fill="#7698b8"/>
                            <path d="M117 208q4-24 28-24h70q24 0 28 24l10 53q3 15-12 15H119q-15 0-12-15z" fill="url(#robot-ceramic)"/>
                            <path d="M122 207h116l5 24H117z" fill="#294d70"/><path d="M178 207h4v22h-4z" fill="#69d9cb"/>
                            <path d="M120 211 94 240q-9 10 0 20l4 4q10 8 19-2l30-32M240 211l26 29q9 10 0 20l-4 4q-10 8-19-2l-30-32" fill="none" stroke="#c3d9eb" stroke-width="13" stroke-linecap="round"/>
                            <rect x="137" y="229" width="86" height="61" rx="7" fill="#f5f8fc" stroke="#82a8ca" stroke-width="2"/>
                            <path d="M151 244h47M151 254h56M151 264h38" stroke="#7898b7" stroke-width="3" stroke-linecap="round"/>
                            <rect x="204" y="241" width="9" height="9" rx="2" fill="#5fd4c5"/><rect x="204" y="258" width="9" height="9" rx="2" fill="#7da7cf"/>
                            <path d="m148 291-12 18h37l4-18M212 291l12 18h-37l-4-18" fill="#456c91"/>
                        </g>
                    </svg>
                    <div class="scene-shadow"></div>
                </div>
            </div>
            <div class="visual-footer"><span>✳</span> Dirancang untuk layanan yang lebih baik</div>
        </section>
        <section class="login-side">
            <div class="login-card-wrap">
                <div class="mobile-brand"><x-brand-mark /><span><strong>HELPSTODA</strong><small>HELPDESK STORAGE DATA</small></span></div>
                <div class="login-heading"><span class="welcome-pill"><span></span> SELAMAT DATANG KEMBALI</span><h2>Masuk ke akun Anda</h2><p>Masukkan kredensial helpdesk untuk melanjutkan.</p></div>
                @if ($errors->any())<div class="alert-error" role="alert">{{ $errors->first() }}</div>@endif
                <form method="POST" action="{{ route('login.store') }}" class="login-form">@csrf
                    <label for="username">Username</label><div class="input-wrap"><span class="input-icon">♙</span><input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" required autofocus></div>
                    <div class="password-label"><label for="password">Password</label><span>AMAN &amp; TERENKRIPSI</span></div><div class="input-wrap"><span class="input-icon">◈</span><input id="password" name="password" type="password" placeholder="Masukkan password" autocomplete="current-password" required><button class="show-password" type="button" id="toggle-password" aria-label="Tampilkan password">◎</button></div>
                    <label class="remember-row"><input type="checkbox" name="remember" value="1"><span>Ingat saya di perangkat ini</span></label>
                    <button class="submit-button" type="submit">Masuk ke dashboard <span>→</span></button>
                </form>
                <div class="secure-note"><span>▣</span> Login Anda dilindungi dengan enkripsi aman.</div>
            </div>
            <div class="login-bottom"><span>© {{ now()->year }} HELPSTODA</span><span>Butuh bantuan? Hubungi administrator</span></div>
        </section>
    </main>
</body>
</html>
