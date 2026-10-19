@extends('layouts.admin', ['title' => 'Dashboard', 'breadcrumb' => 'Dashboard'])

@section('content')
    <div class="page-heading"><div><div class="eyebrow">OVERVIEW</div><h1>Dashboard</h1><p>Selamat datang kembali, {{ auth()->user()->name }}. Ini ringkasan ruang kerja Anda.</p></div><a class="button-primary" href="{{ route('records.create') }}"><span>＋</span> Tambah data</a></div>
    <section class="welcome-banner"><div><span class="banner-eyebrow">HELPDESK STORAGE DATA</span><h2>Halo, {{ auth()->user()->name }} <span>✦</span></h2><p>Pantau dan kelola semua permintaan bantuan dalam satu ruang kerja.</p></div><div class="banner-art"><span class="art-star">✳</span><div class="art-folder"><span>▤</span></div><div class="art-check">✓</div></div></section>
    <section class="stats-grid" aria-label="Ringkasan data">
        <article class="stat-card"><div class="stat-top"><span>Total data</span><span class="stat-icon icon-blue">▤</span></div><strong>{{ number_format($totalRecords) }}</strong><small>Seluruh data tersimpan</small></article>
        <article class="stat-card"><div class="stat-top"><span>Data baru</span><span class="stat-icon icon-orange">✳</span></div><strong>{{ number_format($newRecords) }}</strong><small>Menunggu ditangani</small></article>
        <article class="stat-card"><div class="stat-top"><span>Sedang diproses</span><span class="stat-icon icon-purple">◷</span></div><strong>{{ number_format($inProgressRecords) }}</strong><small>Dalam penanganan</small></article>
        <article class="stat-card"><div class="stat-top"><span>Selesai</span><span class="stat-icon icon-green">✓</span></div><strong>{{ number_format($completedRecords) }}</strong><small>Berhasil ditangani</small></article>
    </section>
    <section class="panel recent-panel"><div class="panel-heading"><div><h2>Data terbaru</h2><p>Aktivitas yang baru saja masuk</p></div><a class="text-link" href="{{ route('records.index') }}">Lihat semua <span>→</span></a></div>
        @if ($recentRecords->isEmpty())<div class="empty-state"><div class="empty-icon">▤</div><strong>Belum ada data tersimpan</strong><p>Mulai dengan menambahkan data helpdesk pertama Anda.</p><a class="button-secondary" href="{{ route('records.create') }}">＋ Tambah data pertama</a></div>
        @else
            <div class="table-scroll"><table><thead><tr><th>ID TIKET</th><th>JUDUL PERMINTAAN</th><th>PELANGGAN</th><th>KATEGORI</th><th>STATUS</th><th>TANGGAL</th></tr></thead><tbody>
                @foreach ($recentRecords as $record)<tr><td class="ticket-cell">{{ $record->ticket_number }}</td><td><strong>{{ $record->title }}</strong></td><td>{{ $record->customer_name }}</td><td>{{ $record->category }}</td><td><span class="status-badge status-{{ $record->status }}"><i></i>{{ ucfirst($record->status) }}</span></td><td>{{ $record->created_at->format('d M Y') }}</td></tr>@endforeach
            </tbody></table></div>
        @endif
    </section>
@endsection
