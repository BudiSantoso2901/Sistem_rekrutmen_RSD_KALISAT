@extends('Layouts.app')

@section('title', 'Detail Hasil Kuis — ' . ($pengerjaan->pelamar?->nama ?? ''))
@section('page-title', 'Detail Hasil Kuis')
@section('breadcrumb', 'SIREKRUT / <a href="' . route('sdm.hasil-kuis.index') . '">Hasil Kuis</a> / <span>Detail</span>')

@section('extra-styles')
    <style>
        /* ── LAYOUT ── */
        .detail-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 860px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── SIDEBAR PELAMAR ── */
        .profile-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--line);
            overflow: hidden;
            position: sticky;
            top: calc(var(--topbar-h) + 20px);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            padding: 28px 20px 20px;
            text-align: center;
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            border: 3px solid rgba(255, 255, 255, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin: 0 auto 12px;
        }

        .profile-name {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }

        .profile-kuis {
            font-size: .75rem;
            color: rgba(255, 255, 255, .7);
        }

        .profile-body {
            padding: 18px 20px;
        }

        .profile-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid var(--line);
            font-size: .82rem;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-row i {
            width: 18px;
            text-align: center;
            color: var(--teal);
            font-size: .82rem;
        }

        .profile-row-label {
            color: var(--muted);
            flex: 1;
        }

        .profile-row-val {
            font-weight: 600;
            color: var(--ink);
        }

        /* SKOR DONUT */
        .score-wrap {
            text-align: center;
            padding: 18px 0 10px;
        }

        .donut-svg {
            display: block;
            margin: 0 auto;
        }

        .donut-val {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            margin-top: 10px;
        }

        .donut-sub {
            font-size: .75rem;
            color: var(--muted);
            margin-top: 2px;
        }

        /* mini stat row */
        .mini-stats {
            display: flex;
            gap: 0;
            border: 1px solid var(--line);
            border-radius: 10px;
            overflow: hidden;
            margin: 14px 0;
        }

        .mini-stat {
            flex: 1;
            padding: 10px 4px;
            text-align: center;
            border-right: 1px solid var(--line);
        }

        .mini-stat:last-child {
            border-right: none;
        }

        .mini-stat-val {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .mini-stat-val.benar {
            color: #3b6d11;
        }

        .mini-stat-val.salah {
            color: #a32d2d;
        }

        .mini-stat-val.total {
            color: var(--teal);
        }

        .mini-stat-lbl {
            font-size: .65rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        /* STATUS UPDATER */
        .status-section {
            padding: 16px 20px;
            border-top: 1px solid var(--line);
        }

        .status-section h4 {
            font-size: .78rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .status-btns {
            display: flex;
            gap: 8px;
        }

        .btn-status {
            flex: 1;
            padding: 8px 4px;
            border-radius: 9px;
            border: 1.5px solid var(--line);
            background: none;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all .2s;
        }

        .btn-status.pending {
            border-color: #854f0b;
            color: #854f0b;
        }

        .btn-status.pending:hover,
        .btn-status.pending.active {
            background: #faeeda;
        }

        .btn-status.lulus {
            border-color: #3b6d11;
            color: #3b6d11;
        }

        .btn-status.lulus:hover,
        .btn-status.lulus.active {
            background: #eaf3de;
        }

        .btn-status.gagal {
            border-color: #a32d2d;
            color: #a32d2d;
        }

        .btn-status.gagal:hover,
        .btn-status.gagal.active {
            background: #fcebeb;
        }

        /* ── JAWABAN AREA ── */
        .soal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .soal-header h2 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ink);
        }

        .soal-count {
            font-size: .78rem;
            color: var(--muted);
            background: var(--bg);
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* filter jawaban */
        .filter-jawaban {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .fj-btn {
            height: 32px;
            padding: 0 14px;
            border-radius: 20px;
            border: 1.5px solid var(--line);
            background: none;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
            color: var(--muted);
        }

        .fj-btn.active,
        .fj-btn:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-lt);
        }

        .fj-btn[data-filter="benar"].active {
            border-color: #3b6d11;
            color: #3b6d11;
            background: #eaf3de;
        }

        .fj-btn[data-filter="salah"].active {
            border-color: #a32d2d;
            color: #a32d2d;
            background: #fcebeb;
        }

        /* soal cards */
        .soal-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .soal-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--line);
            overflow: hidden;
            transition: border-color .2s;
        }

        .soal-card.benar {
            border-left: 4px solid #3b6d11;
        }

        .soal-card.salah {
            border-left: 4px solid #a32d2d;
        }

        .soal-top {
            padding: 14px 18px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .soal-no {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--teal-lt);
            color: var(--teal-dk);
            font-size: .78rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .soal-text {
            font-size: .88rem;
            color: var(--ink2);
            line-height: 1.55;
            flex: 1;
        }

        .soal-status-icon {
            flex-shrink: 0;
            font-size: .95rem;
        }

        .soal-status-icon.benar {
            color: #3b6d11;
        }

        .soal-status-icon.salah {
            color: #a32d2d;
        }

        /* jawaban comparison */
        .soal-bottom {
            border-top: 1px solid var(--line);
            padding: 12px 18px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            background: var(--bg);
        }

        .jawaban-box {
            border-radius: 9px;
            padding: 9px 12px;
            font-size: .8rem;
        }

        .jawaban-box-label {
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 4px;
            color: var(--muted);
        }

        .jawaban-box.pelamar {
            background: var(--white);
            border: 1px solid var(--line);
        }

        .jawaban-box.pelamar.benar {
            background: #eaf3de;
            border-color: #c0dd97;
        }

        .jawaban-box.pelamar.salah {
            background: #fcebeb;
            border-color: #f7c1c1;
        }

        .jawaban-box.kunci {
            background: #eaf3de;
            border: 1px solid #c0dd97;
        }

        .jawaban-val {
            font-weight: 600;
            color: var(--ink);
            font-size: .85rem;
        }

        .jawaban-box.pelamar.salah .jawaban-val {
            color: #a32d2d;
        }

        .jawaban-box.pelamar.benar .jawaban-val {
            color: #3b6d11;
        }

        .jawaban-box.kunci .jawaban-val {
            color: #3b6d11;
        }

        /* back btn */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--teal);
            font-size: .83rem;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 20px;
            padding: 7px 0;
            transition: gap .2s;
        }

        .btn-back:hover {
            gap: 10px;
        }
    </style>
@endsection

@section('content')

    <a href="{{ route('hasil-kuis.index') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>

    <div class="detail-grid">

        {{-- ══ KOLOM KIRI: Info Pelamar ══ --}}
        <aside>
            <div class="profile-card">
                {{-- Header --}}
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($pengerjaan->pelamar?->nama ?? 'P', 0, 2)) }}
                    </div>
                    <div class="profile-name">{{ $pengerjaan->pelamar?->nama ?? '—' }}</div>
                    <div class="profile-kuis">{{ $pengerjaan->kuis?->nama ?? '—' }}</div>
                </div>

                {{-- Donut Skor --}}
                <div class="score-wrap">
                    @php
                        $nilai = $pengerjaan->nilai ?? 0;
                        $radius = 44;
                        $circ = 2 * pi() * $radius;
                        $dash = ($nilai / 100) * $circ;
                        $gap = $circ - $dash;
                        $color = $nilai >= 75 ? '#3b6d11' : ($nilai >= 50 ? '#854f0b' : '#a32d2d');
                    @endphp
                    <svg class="donut-svg" width="110" height="110" viewBox="0 0 110 110">
                        <circle cx="55" cy="55" r="{{ $radius }}" fill="none" stroke="#dce4ed"
                            stroke-width="9" />
                        <circle cx="55" cy="55" r="{{ $radius }}" fill="none"
                            stroke="{{ $color }}" stroke-width="9"
                            stroke-dasharray="{{ round($dash, 2) }} {{ round($gap, 2) }}"
                            stroke-dashoffset="{{ $circ / 4 }}" stroke-linecap="round" />
                        <text x="55" y="60" text-anchor="middle" font-size="18" font-weight="700"
                            fill="{{ $color }}" font-family="DM Sans, sans-serif">
                            {{ $nilai }}
                        </text>
                    </svg>
                    <div class="donut-sub">dari 100 poin</div>

                    {{-- Mini stats --}}
                    <div class="mini-stats" style="margin: 14px 12px 0;">
                        <div class="mini-stat">
                            <div class="mini-stat-val total">{{ $totalSoal }}</div>
                            <div class="mini-stat-lbl">Total</div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-stat-val benar">{{ $totalBenar }}</div>
                            <div class="mini-stat-lbl">Benar</div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-stat-val salah">{{ $totalSalah }}</div>
                            <div class="mini-stat-lbl">Salah</div>
                        </div>
                    </div>
                </div>

                {{-- Info rows --}}
                <div class="profile-body">
                    <div class="profile-row">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="profile-row-label">Email</span>
                        <span class="profile-row-val"
                            style="max-width:160px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                            {{ $pengerjaan->pelamar?->email ?? '—' }}
                        </span>
                    </div>
                    <div class="profile-row">
                        <i class="fa-solid fa-phone"></i>
                        <span class="profile-row-label">Telepon</span>
                        <span class="profile-row-val">{{ $pengerjaan->pelamar?->no_hp ?? '—' }}</span>
                    </div>
                    <div class="profile-row">
                        <i class="fa-solid fa-calendar-alt"></i>
                        <span class="profile-row-label">Dikerjakan</span>
                        <span class="profile-row-val">{{ $pengerjaan->created_at?->format('d M Y, H:i') }}</span>
                    </div>
                </div>

                {{-- Update Status --}}
                <div class="status-section">
                    <h4>Ubah Status</h4>
                    <div class="status-btns">
                        @foreach (['pending' => 'fa-hourglass-half', 'lulus' => 'fa-circle-check', 'gagal' => 'fa-circle-xmark'] as $st => $icon)
                            <form method="POST" action="{{ route('hasil-kuis.update-status', $pengerjaan->id) }}"
                                style="flex:1">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $st }}">
                                <button type="submit"
                                    class="btn-status {{ $st }} {{ $pengerjaan->status === $st ? 'active' : '' }}"
                                    style="width:100%">
                                    <i class="fa-solid {{ $icon }}"></i>
                                    {{ ucfirst($st) }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        {{-- ══ KOLOM KANAN: Jawaban Soal ══ --}}
        <main>
            <div class="soal-header">
                <h2><i class="fa-solid fa-list-check" style="color:var(--teal);margin-right:8px"></i>Rincian Jawaban</h2>
                <span class="soal-count">{{ $totalSoal }} Soal</span>
            </div>

            {{-- Filter --}}
            <div class="filter-jawaban">
                <button class="fj-btn active" data-filter="all">Semua</button>
                <button class="fj-btn" data-filter="benar">
                    <i class="fa-solid fa-check" style="margin-right:4px;color:#3b6d11"></i>Benar ({{ $totalBenar }})
                </button>
                <button class="fj-btn" data-filter="salah">
                    <i class="fa-solid fa-xmark" style="margin-right:4px;color:#a32d2d"></i>Salah ({{ $totalSalah }})
                </button>
            </div>

            {{-- Soal List --}}
            <div class="soal-list" id="soalList">
                @forelse ($jawabanList as $no => $jawaban)
                    @php
                        $isBenar = $jawaban->benar;
                        $statusClass = $isBenar ? 'benar' : 'salah';
                        $kunciJawab = $jawaban->soal?->jawaban_benar ?? '—';
                        $pertanyaan = $jawaban->soal?->pertanyaan ?? 'Soal tidak ditemukan';
                    @endphp
                    <div class="soal-card {{ $statusClass }}" data-result="{{ $statusClass }}">
                        <div class="soal-top">
                            <div class="soal-no">{{ $no + 1 }}</div>
                            <div class="soal-text">{{ $pertanyaan }}</div>
                            <div class="soal-status-icon {{ $statusClass }}">
                                @if ($isBenar)
                                    <i class="fa-solid fa-circle-check"></i>
                                @else
                                    <i class="fa-solid fa-circle-xmark"></i>
                                @endif
                            </div>
                        </div>
                        <div class="soal-bottom">
                            {{-- Jawaban pelamar --}}
                            <div class="jawaban-box pelamar {{ $statusClass }}">
                                <div class="jawaban-box-label">
                                    <i class="fa-solid fa-user" style="margin-right:3px"></i> Jawaban Pelamar
                                </div>
                                <div class="jawaban-val">{{ $jawaban->jawaban ?? '—' }}</div>
                            </div>
                            {{-- Kunci jawaban --}}
                            <div class="jawaban-box kunci">
                                <div class="jawaban-box-label">
                                    <i class="fa-solid fa-key" style="margin-right:3px"></i> Kunci Jawaban
                                </div>
                                <div class="jawaban-val">{{ $kunciJawab }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        style="text-align:center;padding:40px;background:var(--white);border-radius:14px;border:1px solid var(--line);">
                        <i class="fa-solid fa-inbox"
                            style="font-size:2rem;color:var(--teal-mid);display:block;margin-bottom:10px"></i>
                        <p style="color:var(--muted);font-size:.85rem">Belum ada data jawaban tersimpan.</p>
                    </div>
                @endforelse
            </div>
        </main>

    </div>
@endsection

@push('scripts')
    <script>
        // Filter jawaban
        const filterBtns = document.querySelectorAll('.fj-btn');
        const soalCards = document.querySelectorAll('.soal-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.dataset.filter;
                soalCards.forEach(card => {
                    if (filter === 'all' || card.dataset.result === filter) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // SweetAlert konfirmasi ubah status
        document.querySelectorAll('.btn-status').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const statusMap = {
                    pending: {
                        label: 'Pending',
                        icon: 'warning',
                        color: '#854f0b'
                    },
                    lulus: {
                        label: 'Lulus',
                        icon: 'success',
                        color: '#3b6d11'
                    },
                    gagal: {
                        label: 'Gagal',
                        icon: 'error',
                        color: '#a32d2d'
                    },
                };
                const status = this.closest('form').querySelector('[name=status]').value;
                const info = statusMap[status];

                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: `Ubah status ke "${info.label}"?`,
                    text: 'Tindakan ini akan memperbarui status pengerjaan pelamar.',
                    icon: info.icon,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, ubah',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: info.color,
                }).then(result => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endpush
