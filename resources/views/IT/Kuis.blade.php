@extends('Layouts.app')

@section('title', 'Manajemen Kuis')
@section('page-title', 'Manajemen Kuis')
@section('breadcrumb', 'SIREKRUT / SDM / <span>Kuis</span>')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <style>
        /* ─── PAGE HEADER ─── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap
        }

        .page-header-left h2 {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.5rem;
            color: var(--ink);
            letter-spacing: -.3px;
            line-height: 1.2
        }

        .page-header-left p {
            font-size: .8rem;
            color: var(--muted);
            margin-top: 4px
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', inherit;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(13, 122, 110, .3);
            transition: transform .2s, box-shadow .2s;
            white-space: nowrap
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 122, 110, .4)
        }

        /* ─── SUMMARY ─── */
        .summary-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 14px;
            margin-bottom: 24px
        }

        .summary-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1) both
        }

        .summary-card:nth-child(2) {
            animation-delay: .07s
        }

        .summary-card:nth-child(3) {
            animation-delay: .14s
        }

        .summary-card:nth-child(4) {
            animation-delay: .21s
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .sc-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .88rem;
            flex-shrink: 0
        }

        .sc-icon.all {
            background: #eef2f7;
            color: var(--ink2)
        }

        .sc-icon.soal {
            background: var(--teal-lt);
            color: var(--teal)
        }

        .sc-icon.waktu {
            background: #fdf3e3;
            color: var(--gold)
        }

        .sc-icon.posisi {
            background: #edf7f2;
            color: var(--green)
        }

        .sc-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1
        }

        .sc-lbl {
            font-size: .7rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 2px
        }

        /* ─── TABLE CARD ─── */
        .table-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 14px rgba(0, 0, 0, .05);
            overflow: hidden;
            animation: fadeUp .4s .1s cubic-bezier(.22, 1, .36, 1) both
        }

        .table-card-header {
            padding: 18px 22px 14px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap
        }

        .table-card-title {
            font-size: .88rem;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px
        }

        .table-card-title i {
            color: var(--teal)
        }

        .table-card-body {
            padding: 16px 22px 22px
        }

        /* ─── DATATABLES OVERRIDE ─── */
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            font-family: 'DM Sans', sans-serif;
            font-size: .83rem
        }

        table.dataTable thead th {
            background: var(--bg) !important;
            color: var(--muted) !important;
            font-size: .68rem !important;
            font-weight: 700 !important;
            letter-spacing: .8px !important;
            text-transform: uppercase !important;
            border-bottom: 1px solid var(--line) !important;
            padding: 11px 14px !important;
            white-space: nowrap
        }

        table.dataTable tbody td {
            padding: 13px 14px !important;
            border-bottom: 1px solid var(--line) !important;
            color: var(--ink2);
            vertical-align: middle
        }

        table.dataTable tbody tr:last-child td {
            border-bottom: none !important
        }

        table.dataTable tbody tr {
            transition: background .15s
        }

        table.dataTable tbody tr:hover {
            background: var(--teal-lt) !important
        }

        table.dataTable.no-footer {
            border-bottom: none !important
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1.5px solid var(--line) !important;
            border-radius: 8px !important;
            padding: 6px 10px !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: .8rem !important;
            color: var(--ink) !important;
            background: var(--bg) !important;
            outline: none !important;
            transition: border .2s !important
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--teal) !important;
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1) !important;
            background: #fff !important
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            font-size: .78rem;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif
        }

        .dataTables_wrapper .dataTables_info {
            font-size: .75rem;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            padding-top: 14px
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 7px !important;
            font-size: .78rem !important;
            font-family: 'DM Sans', sans-serif !important;
            padding: 5px 11px !important;
            margin: 0 2px !important;
            border: 1px solid transparent !important;
            color: var(--muted) !important;
            transition: all .2s !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--teal-lt) !important;
            border-color: var(--teal-mid) !important;
            color: var(--teal-dk) !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--teal), var(--teal-dk)) !important;
            border-color: var(--teal) !important;
            color: #fff !important;
            box-shadow: 0 3px 10px rgba(13, 122, 110, .3) !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: .4 !important
        }

        /* ─── INLINE TABLE ─── */
        .kuis-name {
            font-weight: 700;
            color: var(--ink);
            font-size: .85rem
        }

        .kuis-desc {
            font-size: .72rem;
            color: var(--muted);
            margin-top: 2px;
            max-width: 240px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical
        }

        .row-num {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: var(--bg);
            border: 1px solid var(--line);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            font-weight: 700;
            color: var(--muted)
        }

        .badge-soal {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 6px;
            background: var(--teal-lt);
            color: var(--teal-dk);
            font-size: .72rem;
            font-weight: 700
        }

        .badge-waktu {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 6px;
            background: #fdf3e3;
            color: #92400e;
            font-size: .72rem;
            font-weight: 700
        }

        .badge-posisi {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 6px;
            background: #edf7f2;
            color: var(--green);
            font-size: .72rem;
            font-weight: 600
        }

        .btn-tbl {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 11px;
            border-radius: 7px;
            border: 1.5px solid;
            font-family: 'DM Sans', inherit;
            font-size: .72rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s;
            background: none;
            text-decoration: none;
            white-space: nowrap
        }

        .btn-tbl:hover {
            transform: translateY(-1px)
        }

        .btn-edit {
            border-color: var(--teal-mid);
            color: var(--teal-dk)
        }

        .btn-edit:hover {
            background: var(--teal-lt);
            border-color: var(--teal)
        }

        .btn-soal {
            border-color: #c7d2fe;
            color: #4338ca
        }

        .btn-soal:hover {
            background: #eef2ff;
            border-color: #818cf8
        }

        .btn-del {
            border-color: #f5c6c2;
            color: var(--red)
        }

        .btn-del:hover {
            background: #fdf0ef;
            border-color: var(--red)
        }

        .action-group {
            display: flex;
            gap: 5px;
            flex-wrap: wrap
        }

        /* ─── MODAL ─── */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 32, .55);
            backdrop-filter: blur(5px);
            z-index: 500;
            align-items: center;
            justify-content: center;
            padding: 20px
        }

        .modal-backdrop.open {
            display: flex
        }

        .modal {
            background: var(--white);
            border-radius: 20px;
            width: min(540px, 100%);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .2);
            overflow: hidden;
            animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both;
            max-height: 90vh;
            display: flex;
            flex-direction: column
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(.94) translateY(20px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            flex-shrink: 0
        }

        .mh-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--teal-lt);
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            flex-shrink: 0
        }

        .mh-icon.del {
            background: #fdf0ef;
            color: var(--red)
        }

        .mht-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.08rem;
            color: var(--ink)
        }

        .mht-sub {
            font-size: .74rem;
            color: var(--muted);
            margin-top: 2px
        }

        .modal-close {
            background: var(--bg);
            border: none;
            color: var(--muted);
            width: 28px;
            height: 28px;
            border-radius: 7px;
            cursor: pointer;
            font-size: .78rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            flex-shrink: 0
        }

        .modal-close:hover {
            background: var(--line);
            color: var(--ink)
        }

        .modal-body {
            padding: 20px 24px;
            overflow-y: auto
        }

        .modal-footer {
            padding: 14px 24px;
            border-top: 1px solid var(--line);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: var(--bg);
            flex-shrink: 0
        }

        /* form */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px
        }

        .form-group {
            margin-bottom: 16px
        }

        .form-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--ink2);
            margin-bottom: 6px
        }

        .form-label .req {
            color: var(--red);
            margin-left: 2px
        }

        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--line);
            border-radius: 9px;
            font-family: 'DM Sans', inherit;
            font-size: .84rem;
            color: var(--ink);
            background: var(--bg);
            outline: none;
            transition: border .2s, box-shadow .2s, background .2s
        }

        .form-control:focus {
            border-color: var(--teal);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1)
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px
        }

        .field-error {
            font-size: .72rem;
            color: var(--red);
            margin-top: 4px;
            display: none;
            align-items: center;
            gap: 4px
        }

        /* buttons */
        .btn-cancel {
            padding: 9px 18px;
            border-radius: 9px;
            border: 1.5px solid var(--line);
            background: #fff;
            font-family: 'DM Sans', inherit;
            font-size: .82rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s
        }

        .btn-cancel:hover {
            border-color: var(--ink);
            color: var(--ink)
        }

        .btn-save {
            padding: 9px 22px;
            border-radius: 9px;
            border: none;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            font-family: 'DM Sans', inherit;
            font-size: .82rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(13, 122, 110, .3);
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 7px
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 20px rgba(13, 122, 110, .4)
        }

        .btn-save:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none
        }

        .btn-del-confirm {
            padding: 9px 22px;
            border-radius: 9px;
            border: none;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff;
            font-family: 'DM Sans', inherit;
            font-size: .82rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(192, 57, 43, .3);
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 7px
        }

        .btn-del-confirm:hover {
            transform: translateY(-1px)
        }

        .spin {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .65s linear infinite;
            display: none
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }

        .loading .spin {
            display: block
        }

        .loading .btn-icon {
            display: none
        }

        /* del modal */
        .del-info {
            background: #fdf0ef;
            border: 1px solid #f5c6c2;
            border-radius: 10px;
            padding: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .82rem;
            color: var(--red);
            margin-bottom: 4px
        }

        @media(max-width:640px) {
            .summary-row {
                grid-template-columns: 1fr 1fr
            }

            .form-row {
                grid-template-columns: 1fr
            }

            .action-group {
                flex-direction: column
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <div class="page-header-left">
            <h2>Manajemen Kuis</h2>
            <p>Buat dan kelola kuis seleksi untuk setiap posisi rekrutmen</p>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i> Tambah Kuis
        </button>
    </div>

    {{-- SUMMARY --}}
    <div class="summary-row">
        <div class="summary-card">
            <div class="sc-icon all"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
                <div class="sc-num" id="scTotal">—</div>
                <div class="sc-lbl">Total Kuis</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="sc-icon soal"><i class="fa-solid fa-list-check"></i></div>
            <div>
                <div class="sc-num" id="scSoal">—</div>
                <div class="sc-lbl">Total Soal</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="sc-icon waktu"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="sc-num" id="scWaktu">—</div>
                <div class="sc-lbl">Rata-rata Waktu</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="sc-icon posisi"><i class="fa-solid fa-briefcase"></i></div>
            <div>
                <div class="sc-num" id="scPosisi">—</div>
                <div class="sc-lbl">Posisi Tercakup</div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title"><i class="fa-solid fa-table-list"></i> Daftar Kuis Rekrutmen</div>
        </div>
        <div class="table-card-body">
            <table id="kuisTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kuis</th>
                        <th>Posisi</th>
                        <th>Soal</th>
                        <th>Waktu</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- ══ MODAL FORM KUIS ══ --}}
    <div class="modal-backdrop" id="modalForm">
        <div class="modal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="mh-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <div class="mht-title" id="mTitle">Tambah Kuis</div>
                        <div class="mht-sub" id="mSub">Isi detail kuis seleksi baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalForm')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fId">
                <div class="form-group">
                    <label class="form-label">Nama Kuis <span class="req">*</span></label>
                    <input type="text" class="form-control" id="fNama"
                        placeholder="cth. Kuis Kompetensi Perawat IGD">
                    <div class="field-error" id="errNama"><i class="fa-solid fa-triangle-exclamation"></i><span></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Posisi <span class="req">*</span></label>
                        <select class="form-control" id="fPosisi">
                            <option value="">-- Pilih Posisi --</option>
                            @foreach ($posisis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_posisi }}</option>
                            @endforeach
                        </select>
                        <div class="field-error" id="errPosisi"><i
                                class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu (menit) <span class="req">*</span></label>
                        <input type="number" class="form-control" id="fWaktu" placeholder="cth. 60" min="1">
                        <div class="field-error" id="errWaktu"><i
                                class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="fDeskripsi" placeholder="Jelaskan tujuan atau materi yang diujikan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalForm')">Batal</button>
                <button class="btn-save" id="btnSave" onclick="submitKuis()">
                    <span class="spin"></span><i class="fa-solid fa-floppy-disk btn-icon"></i><span
                        class="btn-text">Simpan</span>
                </button>
            </div>
        </div>
    </div>

    {{-- ══ MODAL HAPUS ══ --}}
    <div class="modal-backdrop" id="modalDel">
        <div class="modal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="mh-icon del"><i class="fa-solid fa-trash-can"></i></div>
                    <div>
                        <div class="mht-title">Hapus Kuis</div>
                        <div class="mht-sub">Semua soal akan ikut terhapus</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalDel')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <p style="font-weight:700;font-size:.95rem;color:var(--ink);margin-bottom:10px" id="delName">—</p>
                <div class="del-info"><i class="fa-solid fa-triangle-exclamation"></i><span>Kuis dan seluruh soal di
                        dalamnya akan dihapus permanen.</span></div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalDel')">Batal</button>
                <button class="btn-del-confirm" id="btnDel" onclick="confirmDelete()">
                    <span class="spin"></span><i class="fa-solid fa-trash btn-icon"></i><span class="btn-text">Ya,
                        Hapus</span>
                </button>
            </div>
        </div>
    </div>
    {{-- ══ MODAL COPY KUIS ══ --}}
    <div class="modal-backdrop" id="modalCopy">
        <div class="modal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="mh-icon" style="background:#fdf3e3;color:var(--gold)"><i class="fa-solid fa-copy"></i>
                    </div>
                    <div>
                        <div class="mht-title">Salin Kuis</div>
                        <div class="mht-sub" id="mCopySub">Duplikat kuis beserta soal-soalnya</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalCopy')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fCopyId">

                {{-- Info kuis sumber --}}
                <div class="copy-source-box">
                    <div class="copy-source-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <div class="copy-source-name" id="cSrcNama">—</div>
                        <div class="copy-source-meta">
                            <span><i class="fa-solid fa-briefcase"></i><span id="cSrcPosisi">—</span></span>
                            <span><i class="fa-solid fa-clock"></i><span id="cSrcWaktu">—</span> mnt</span>
                            <span><i class="fa-solid fa-list-check"></i><span id="cSrcSoal">—</span> soal</span>
                        </div>
                    </div>
                </div>

                {{-- Nama kuis baru --}}
                <div class="form-group">
                    <label class="form-label">Nama Kuis Baru <span class="req">*</span></label>
                    <input type="text" class="form-control" id="fCopyNama"
                        placeholder="cth. Salinan Kuis Perawat IGD">
                    <div class="field-error" id="errCopyNama"><i
                            class="fa-solid fa-triangle-exclamation"></i><span></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Posisi <span class="req">*</span></label>
                        <select class="form-control" id="fCopyPosisi">
                            <option value="">-- Pilih Posisi --</option>
                            @foreach ($posisis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_posisi }}</option>
                            @endforeach
                        </select>
                        <div class="field-error" id="errCopyPosisi"><i
                                class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu (menit) <span class="req">*</span></label>
                        <input type="number" class="form-control" id="fCopyWaktu" min="1">
                        <div class="field-error" id="errCopyWaktu"><i
                                class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                    </div>
                </div>

                {{-- Toggle salin soal --}}
                <label class="form-label">Opsi Penyalinan</label>
                <div class="toggle-switch-wrap active" id="toggleCopySoalWrap" onclick="toggleCopySoal()">
                    <div class="toggle-label">
                        Salin semua soal
                        <small>Semua pertanyaan dan jawaban dari kuis asal ikut disalin</small>
                    </div>
                    <div class="toggle-pill" id="togglePill"></div>
                </div>
                <input type="hidden" id="fCopySoal" value="1">

                {{-- Ringkasan hasil copy --}}
                <div class="copy-summary" id="copySummary">
                    <div class="copy-summary-chip">
                        <strong id="sumSoal">0</strong>
                        soal akan disalin
                    </div>
                    <div class="copy-summary-chip">
                        <strong id="sumFoto">0</strong>
                        foto ikut disalin
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalCopy')">Batal</button>
                <button class="btn-copy-confirm" id="btnCopyConfirm" onclick="submitCopy()">
                    <span class="spin"></span>
                    <i class="fa-solid fa-copy btn-icon"></i>
                    <span class="btn-text">Salin Kuis</span>
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        const KUIS_URL = "{{ route('sdm.kuis.index') }}";
        let _delId = null,
            _dt = null;

        $(function() {
            _dt = $('#kuisTable').DataTable({
                ajax: {
                    url: KUIS_URL,
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    dataSrc: function(json) {
                        updateSummary(json);
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        render: (d, t, r, m) => `<div class="row-num">${m.row+1}</div>`,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kuis',
                        render: d => `<div class="kuis-name">${esc(d)}</div>`
                    },
                    {
                        data: 'posisi',
                        render: d =>
                            `<span class="badge-posisi"><i class="fa-solid fa-briefcase"></i> ${esc(d)}</span>`
                    },
                    {
                        data: 'total_soal',
                        render: d =>
                            `<span class="badge-soal"><i class="fa-solid fa-list-check"></i> ${d} soal</span>`
                    },
                    {
                        data: 'waktu',
                        render: d =>
                            `<span class="badge-waktu"><i class="fa-solid fa-clock"></i> ${d} mnt</span>`
                    },
                    {
                        data: 'created_at',
                        render: d =>
                            `<span style="font-size:.74rem;color:var(--muted)">${fmtDate(d)}</span>`
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: (d, t, row) => `
                <div class="action-group">
                    <button class="btn-tbl btn-edit" onclick='openEdit(${JSON.stringify(row)})'>
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <a href="/sdm/kuis/${row.id}/soal/page" class="btn-tbl btn-soal">
                        <i class="fa-solid fa-list-check"></i> Soal
                    </a>
                    <button class="btn-tbl btn-copy" onclick='openCopy(${JSON.stringify(row)})'>
                        <i class="fa-solid fa-copy"></i> Salin
                    </button>
                    <button class="btn-tbl btn-del" onclick="openDel(${row.id},'${esc(row.nama_kuis)}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>`
                    }
                ],
                order: [
                    [5, 'desc']
                ],
                language: {
                    search: '',
                    searchPlaceholder: 'Cari kuis...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ kuis',
                    infoEmpty: 'Tidak ada kuis',
                    zeroRecords: '<div style="text-align:center;padding:30px;color:var(--muted)"><i class="fa-solid fa-inbox" style="font-size:1.8rem;display:block;margin-bottom:8px;opacity:.3"></i>Kuis tidak ditemukan</div>',
                    paginate: {
                        previous: '<i class="fa-solid fa-chevron-left"></i>',
                        next: '<i class="fa-solid fa-chevron-right"></i>'
                    }
                },
                pageLength: 10,
                responsive: true,
                dom: '<"dt-top"lf>rt<"dt-bottom"ip>'
            });
        });

        function updateSummary(data) {
            const totalSoal = data.reduce((s, k) => s + (k.total_soal || 0), 0);
            const avgWaktu = data.length ? Math.round(data.reduce((s, k) => s + k.waktu, 0) / data.length) : 0;
            const uniquePosisi = new Set(data.map(k => k.posisi)).size;
            animNum('scTotal', data.length);
            animNum('scSoal', totalSoal);
            animNum('scWaktu', avgWaktu);
            animNum('scPosisi', uniquePosisi);
        }

        function animNum(id, target) {
            const el = document.getElementById(id);
            let c = 0;
            const step = Math.max(1, Math.ceil(target / 20));
            const iv = setInterval(() => {
                c = Math.min(c + step, target);
                el.textContent = c;
                if (c >= target) clearInterval(iv);
            }, 40);
        }

        function openModal() {
            ['fId', 'fNama', 'fDeskripsi', 'fWaktu'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('fPosisi').value = '';
            document.getElementById('mTitle').textContent = 'Tambah Kuis';
            document.getElementById('mSub').textContent = 'Isi detail kuis seleksi baru';
            document.querySelector('#btnSave .btn-text').textContent = 'Simpan';
            clearErr();
            showModal('modalForm');
        }

        function openEdit(row) {
            document.getElementById('fId').value = row.id;
            document.getElementById('fNama').value = row.nama_kuis || '';
            document.getElementById('fWaktu').value = row.waktu || '';
            document.getElementById('fDeskripsi').value = row.deskripsi || '';
            // posisi: perlu id, ambil dari ajax show
            fetch(`/kuis/${row.id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json()).then(data => {
                    document.getElementById('fPosisi').value = data.posisi_id || '';
                });
            document.getElementById('mTitle').textContent = 'Edit Kuis';
            document.getElementById('mSub').textContent = 'Perbarui detail kuis ini';
            document.querySelector('#btnSave .btn-text').textContent = 'Perbarui';
            clearErr();
            showModal('modalForm');
        }

        function openDel(id, name) {
            _delId = id;
            document.getElementById('delName').textContent = name;
            showModal('modalDel');
        }

        function showModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }
        ['modalForm', 'modalDel'].forEach(id => document.getElementById(id).addEventListener('click', e => {
            if (e.target === document.getElementById(id)) closeModal(id);
        }));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeModal('modalForm');
                closeModal('modalDel');
            }
        });

        async function submitKuis() {
            clearErr();
            const id = document.getElementById('fId').value,
                nama = document.getElementById('fNama').value.trim(),
                posisi = document.getElementById('fPosisi').value,
                waktu = document.getElementById('fWaktu').value,
                deskripsi = document.getElementById('fDeskripsi').value.trim();
            if (!nama) {
                showErr('errNama', 'Nama kuis wajib diisi');
                return;
            }
            if (!posisi) {
                showErr('errPosisi', 'Posisi wajib dipilih');
                return;
            }
            if (!waktu || waktu < 1) {
                showErr('errWaktu', 'Waktu harus diisi minimal 1 menit');
                return;
            }
            const btn = document.getElementById('btnSave');
            setLoad(btn, true);
            try {
                const res = await fetch("{{ route('sdm.kuis.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id || undefined,
                        nama_kuis: nama,
                        posisi_id: posisi,
                        waktu: parseInt(waktu),
                        deskripsi
                    })
                });
                const data = await res.json();
                if (data.success) {
                    closeModal('modalForm');
                    _dt.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else if (res.status === 422 && data.errors) {
                    if (data.errors.nama_kuis) showErr('errNama', data.errors.nama_kuis[0]);
                    if (data.errors.posisi_id) showErr('errPosisi', data.errors.posisi_id[0]);
                    if (data.errors.waktu) showErr('errWaktu', data.errors.waktu[0]);
                } else showToast(data.message || 'Terjadi kesalahan', 'error');
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoad(btn, false);
            }
        }
        async function confirmDelete() {
            if (!_delId) return;
            const btn = document.getElementById('btnDel');
            setLoad(btn, true);
            try {
                const res = await fetch(`/kuis/${_delId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    closeModal('modalDel');
                    _dt.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else showToast(data.message || 'Gagal menghapus', 'error');
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoad(btn, false);
                _delId = null;
            }
        }

        function setLoad(btn, s) {
            btn.disabled = s;
            btn.classList.toggle('loading', s);
        }

        function showErr(id, msg) {
            const el = document.getElementById(id);
            el.style.display = 'flex';
            el.querySelector('span').textContent = msg;
        }

        function clearErr() {
            document.querySelectorAll('.field-error').forEach(e => e.style.display = 'none');
        }

        function esc(s) {
            return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g,
                '&quot;');
        }

        function fmtDate(d) {
            return new Date(d).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
        }
        // ── COPY KUIS ──────────────────────────────
        let _copyRow = null;

        function openCopy(row) {
            _copyRow = row;
            document.getElementById('fCopyId').value = row.id;
            document.getElementById('fCopyNama').value = 'Salinan — ' + row.nama_kuis;
            document.getElementById('fCopyWaktu').value = row.waktu;

            // isi posisi sama dengan asli
            const posisiSel = document.getElementById('fCopyPosisi');
            // cari posisi_id dari show endpoint
            fetch(`/kuis/${row.id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json()).then(data => {
                    posisiSel.value = data.posisi_id || '';
                });

            // info sumber
            document.getElementById('cSrcNama').textContent = row.nama_kuis;
            document.getElementById('cSrcPosisi').textContent = row.posisi;
            document.getElementById('cSrcWaktu').textContent = row.waktu;
            document.getElementById('cSrcSoal').textContent = row.total_soal;

            // summary chips
            document.getElementById('sumSoal').textContent = row.total_soal;
            // rough estimate foto (tidak perlu exact di client)
            document.getElementById('sumFoto').textContent = '—';

            // reset toggle
            document.getElementById('fCopySoal').value = '1';
            document.getElementById('toggleCopySoalWrap').classList.add('active');
            updateSummaryChips(true);

            clearCopyErr();
            showModal('modalCopy');
        }

        function toggleCopySoal() {
            const wrap = document.getElementById('toggleCopySoalWrap');
            const isActive = wrap.classList.toggle('active');
            document.getElementById('fCopySoal').value = isActive ? '1' : '0';
            updateSummaryChips(isActive);
        }

        function updateSummaryChips(withSoal) {
            const soalCount = _copyRow ? _copyRow.total_soal : 0;
            document.getElementById('sumSoal').textContent = withSoal ? soalCount : 0;
            document.getElementById('sumFoto').textContent = withSoal ? '≤' + soalCount : 0;
        }

        async function submitCopy() {
            clearCopyErr();
            const id = document.getElementById('fCopyId').value;
            const nama = document.getElementById('fCopyNama').value.trim();
            const posisi = document.getElementById('fCopyPosisi').value;
            const waktu = document.getElementById('fCopyWaktu').value;
            const copyS = document.getElementById('fCopySoal').value === '1';

            let valid = true;
            if (!nama) {
                showCopyErr('errCopyNama', 'Nama kuis baru wajib diisi');
                valid = false;
            }
            if (!posisi) {
                showCopyErr('errCopyPosisi', 'Posisi wajib dipilih');
                valid = false;
            }
            if (!waktu || waktu < 1) {
                showCopyErr('errCopyWaktu', 'Waktu minimal 1 menit');
                valid = false;
            }
            if (!valid) return;

            const btn = document.getElementById('btnCopyConfirm');
            setLoad(btn, true);
            try {
                const res = await fetch(`/kuis/${id}/duplicate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nama_kuis: nama,
                        posisi_id: posisi,
                        waktu: parseInt(waktu),
                        copy_soal: copyS
                    })
                });
                const data = await res.json();
                if (data.success) {
                    closeModal('modalCopy');
                    _dt.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else if (res.status === 422 && data.errors) {
                    if (data.errors.nama_kuis) showCopyErr('errCopyNama', data.errors.nama_kuis[0]);
                    if (data.errors.posisi_id) showCopyErr('errCopyPosisi', data.errors.posisi_id[0]);
                    if (data.errors.waktu) showCopyErr('errCopyWaktu', data.errors.waktu[0]);
                } else showToast(data.message || 'Terjadi kesalahan', 'error');
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoad(btn, false);
            }
        }

        function showCopyErr(id, msg) {
            const el = document.getElementById(id);
            el.style.display = 'flex';
            el.querySelector('span').textContent = msg;
        }

        function clearCopyErr() {
            ['errCopyNama', 'errCopyPosisi', 'errCopyWaktu'].forEach(id => {
                document.getElementById(id).style.display = 'none';
            });
        }

        // close modalCopy on backdrop
        document.getElementById('modalCopy').addEventListener('click', e => {
            if (e.target === document.getElementById('modalCopy')) closeModal('modalCopy');
        });
    </script>
@endpush
