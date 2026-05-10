@extends('Layouts.app')

@section('title', 'Hasil Kuis Pelamar')
@section('page-title', 'Hasil Kuis Pelamar')
@section('breadcrumb', 'SIREKRUT / <span>Hasil Kuis</span>')

@section('extra-styles')
    <style>
        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .stat-icon.total {
            background: #e6f1fb;
            color: #185fa5;
        }

        .stat-icon.pending {
            background: #faeeda;
            color: #854f0b;
        }

        .stat-icon.lulus {
            background: #eaf3de;
            color: #3b6d11;
        }

        .stat-icon.gagal {
            background: #fcebeb;
            color: #a32d2d;
        }

        .stat-val {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .stat-label {
            font-size: .72rem;
            color: var(--muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 2px;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--line);
            padding: 16px 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-bar input,
        .filter-bar select {
            height: 38px;
            padding: 0 12px;
            border: 1px solid var(--line);
            border-radius: 9px;
            font-size: .83rem;
            color: var(--ink);
            background: var(--bg);
            font-family: inherit;
            outline: none;
            transition: border-color .2s;
        }

        .filter-bar input:focus,
        .filter-bar select:focus {
            border-color: var(--teal);
        }

        .filter-bar input {
            flex: 1;
            min-width: 180px;
        }

        .btn-filter {
            height: 38px;
            padding: 0 18px;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: .83rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
        }

        .btn-filter:hover {
            background: var(--teal-dk);
        }

        .btn-reset {
            height: 38px;
            padding: 0 14px;
            background: var(--bg);
            color: var(--muted);
            border: 1px solid var(--line);
            border-radius: 9px;
            font-size: .83rem;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        /* ── CARD LIST ── */
        .card-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .result-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--line);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow .2s, border-color .2s;
            text-decoration: none;
            color: inherit;
        }

        .result-card:hover {
            border-color: var(--teal-mid);
            box-shadow: 0 4px 20px rgba(13, 122, 110, .08);
        }

        /* avatar inisial */
        .rc-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem;
            color: #fff;
            flex-shrink: 0;
            letter-spacing: .5px;
        }

        .rc-info {
            flex: 1;
            min-width: 0;
        }

        .rc-name {
            font-weight: 600;
            font-size: .92rem;
            color: var(--ink);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rc-meta {
            font-size: .75rem;
            color: var(--muted);
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .rc-meta i {
            margin-right: 4px;
        }

        /* skor lingkaran */
        .rc-score {
            text-align: center;
            flex-shrink: 0;
        }

        .score-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 3px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0 auto 2px;
            position: relative;
        }

        .score-circle.high {
            border-color: #3b6d11;
            color: #3b6d11;
        }

        .score-circle.mid {
            border-color: #854f0b;
            color: #854f0b;
        }

        .score-circle.low {
            border-color: #a32d2d;
            color: #a32d2d;
        }

        .score-lbl {
            font-size: .65rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        /* status badge */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            flex-shrink: 0;
        }

        .badge-status.pending {
            background: #faeeda;
            color: #854f0b;
        }

        .badge-status.lulus {
            background: #eaf3de;
            color: #3b6d11;
        }

        .badge-status.gagal {
            background: #fcebeb;
            color: #a32d2d;
        }

        .badge-status i {
            font-size: .68rem;
        }

        /* action btn */
        .btn-detail {
            height: 36px;
            padding: 0 14px;
            border: 1.5px solid var(--teal);
            color: var(--teal);
            background: none;
            border-radius: 9px;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s, color .2s;
            font-family: inherit;
            flex-shrink: 0;
        }

        .btn-detail:hover {
            background: var(--teal);
            color: #fff;
        }

        /* empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--line);
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--teal-mid);
            margin-bottom: 14px;
            display: block;
        }

        .empty-state h3 {
            font-size: 1rem;
            color: var(--ink2);
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: .82rem;
            color: var(--muted);
        }

        /* pagination */
        .pagination-wrap {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .pagination-wrap nav {
            display: flex;
            gap: 4px;
        }

        @media (max-width: 640px) {
            .result-card {
                flex-wrap: wrap;
            }

            .rc-score,
            .badge-status {
                display: none;
            }
        }
    </style>
@endsection

@section('content')

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon total"><i class="fa-solid fa-clipboard-list"></i></div>
            <div>
                <div class="stat-val">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Pengerjaan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pending"><i class="fa-solid fa-hourglass-half"></i></div>
            <div>
                <div class="stat-val">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon lulus"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-val">{{ $stats['lulus'] }}</div>
                <div class="stat-label">Lulus</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gagal"><i class="fa-solid fa-circle-xmark"></i></div>
            <div>
                <div class="stat-val">{{ $stats['gagal'] }}</div>
                <div class="stat-label">Gagal</div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('hasil-kuis.index') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email pelamar…">
        <select name="kuis_id">
            <option value="">Semua Kuis</option>
            @foreach ($kuisList as $kuis)
                <option value="{{ $kuis->id }}" @selected(request('kuis_id') == $kuis->id)>
                    {{ $kuis->nama }}
                </option>
            @endforeach
        </select>
        <select name="status">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="lulus" @selected(request('status') === 'lulus')>Lulus</option>
            <option value="gagal" @selected(request('status') === 'gagal')>Gagal</option>
        </select>
        <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
        <a href="{{ route('hasil-kuis.index') }}" class="btn-reset"><i class="fa-solid fa-rotate-left"></i></a>
    </form>

    {{-- CARD LIST --}}
    @if ($pengerjaans->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-inbox"></i>
            <h3>Belum ada data pengerjaan</h3>
            <p>Data akan muncul setelah pelamar menyelesaikan kuis rekrutmen.</p>
        </div>
    @else
        <div class="card-list">
            @foreach ($pengerjaans as $item)
                @php
                    $nama = $item->pelamar?->nama ?? '—';
                    $inisial = strtoupper(substr($nama, 0, 2));
                    $nilai = $item->nilai ?? 0;
                    $scoreCls = $nilai >= 75 ? 'high' : ($nilai >= 50 ? 'mid' : 'low');
                @endphp
                <div class="result-card">
                    {{-- Avatar --}}
                    <div class="rc-avatar">{{ $inisial }}</div>

                    {{-- Info --}}
                    <div class="rc-info">
                        <div class="rc-name">{{ $nama }}</div>
                        <div class="rc-meta">
                            <span><i class="fa-solid fa-envelope"></i>{{ $item->pelamar?->email ?? '—' }}</span>
                            <span><i class="fa-solid fa-file-alt"></i>{{ $item->kuis?->nama ?? '—' }}</span>
                            <span><i class="fa-regular fa-clock"></i>{{ $item->created_at?->diffForHumans() }}</span>
                        </div>
                    </div>

                    {{-- Skor --}}
                    <div class="rc-score">
                        <div class="score-circle {{ $scoreCls }}">{{ $nilai }}</div>
                        <div class="score-lbl">Nilai</div>
                    </div>

                    {{-- Status Badge --}}
                    @php
                        $badgeIcon = match ($item->status) {
                            'lulus' => 'fa-circle-check',
                            'gagal' => 'fa-circle-xmark',
                            default => 'fa-hourglass-half',
                        };
                    @endphp
                    <span class="badge-status {{ $item->status }}">
                        <i class="fa-solid {{ $badgeIcon }}"></i>
                        {{ ucfirst($item->status) }}
                    </span>

                    {{-- Tombol Detail --}}
                    <a href="{{ route('hasil-kuis.show', $item->id) }}" class="btn-detail">
                        <i class="fa-solid fa-eye"></i> Lihat
                    </a>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $pengerjaans->links() }}
        </div>
    @endif

@endsection
