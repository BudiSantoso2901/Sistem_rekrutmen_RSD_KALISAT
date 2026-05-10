@extends('layouts.app')

@section('title', 'Manajemen Posisi')
@section('page-title', 'Manajemen Posisi')
@section('breadcrumb', 'SIREKRUT / SDM / Posisi')

@push('styles')
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style>
        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .page-header-left h2 {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.5rem;
            color: var(--ink);
            letter-spacing: -.3px;
            line-height: 1.2;
        }

        .page-header-left p {
            font-size: .8rem;
            color: var(--muted);
            margin-top: 4px;
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
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 122, 110, .4);
        }

        .btn-primary:active {
            transform: none;
        }

        /* ── SUMMARY CARDS ── */
        .summary-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
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
            animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1) both;
        }

        .summary-card:nth-child(2) {
            animation-delay: .07s
        }

        .summary-card:nth-child(3) {
            animation-delay: .14s
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: none;
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
            flex-shrink: 0;
        }

        .sc-icon.all {
            background: #eef2f7;
            color: var(--ink2);
        }

        .sc-icon.aktif {
            background: var(--teal-lt);
            color: var(--teal);
        }

        .sc-icon.tutup {
            background: #fdf3e3;
            color: var(--gold);
        }

        .sc-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
        }

        .sc-lbl {
            font-size: .7rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 14px rgba(0, 0, 0, .05);
            overflow: hidden;
            animation: fadeUp .4s .1s cubic-bezier(.22, 1, .36, 1) both;
        }

        .table-card-header {
            padding: 18px 22px 14px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .table-card-title {
            font-size: .88rem;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-card-title i {
            color: var(--teal);
        }

        .table-card-body {
            padding: 16px 22px 22px;
        }

        /* ── DATATABLES OVERRIDE ── */
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            font-family: 'DM Sans', sans-serif;
            font-size: .83rem;
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
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 13px 14px !important;
            border-bottom: 1px solid var(--line) !important;
            color: var(--ink2);
            vertical-align: middle;
        }

        table.dataTable tbody tr:last-child td {
            border-bottom: none !important;
        }

        table.dataTable tbody tr {
            transition: background .15s;
        }

        table.dataTable tbody tr:hover {
            background: var(--teal-lt) !important;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        /* DT controls */
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
            transition: border .2s !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--teal) !important;
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1) !important;
            background: #fff !important;
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            font-size: .78rem;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dataTables_wrapper .dataTables_filter label::before {
            content: '\f002';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: var(--muted);
            font-size: .75rem;
        }

        .dataTables_wrapper .dataTables_info {
            font-size: .75rem;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            padding-top: 14px;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 7px !important;
            font-size: .78rem !important;
            font-family: 'DM Sans', sans-serif !important;
            padding: 5px 11px !important;
            margin: 0 2px !important;
            border: 1px solid transparent !important;
            color: var(--muted) !important;
            transition: all .2s !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--teal-lt) !important;
            border-color: var(--teal-mid) !important;
            color: var(--teal-dk) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--teal), var(--teal-dk)) !important;
            border-color: var(--teal) !important;
            color: #fff !important;
            box-shadow: 0 3px 10px rgba(13, 122, 110, .3) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: .4 !important;
        }

        div.dataTables_wrapper div.dataTables_length {
            padding-bottom: 0;
        }

        /* ── INLINE TABLE ELEMENTS ── */
        .posisi-name {
            font-weight: 600;
            color: var(--ink);
            font-size: .85rem;
        }

        .posisi-desc {
            font-size: .72rem;
            color: var(--muted);
            margin-top: 2px;
            max-width: 280px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            line-clamp: 1;
        }

        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .75rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 7px;
            white-space: nowrap;
        }

        .date-badge.aktif {
            background: var(--teal-lt);
            color: var(--teal-dk);
        }

        .date-badge.tutup {
            background: #fdf3e3;
            color: #92400e;
        }

        .date-badge.nodate {
            background: var(--bg);
            color: var(--muted);
            border: 1px solid var(--line);
        }

        .row-num {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--bg);
            border: 1px solid var(--line);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            font-weight: 700;
            color: var(--muted);
        }

        /* action buttons */
        .btn-tbl {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 7px;
            border: 1.5px solid;
            font-family: 'DM Sans', inherit;
            font-size: .72rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s;
            background: none;
        }

        .btn-tbl:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            border-color: var(--teal-mid);
            color: var(--teal-dk);
        }

        .btn-edit:hover {
            background: var(--teal-lt);
            border-color: var(--teal);
        }

        .btn-del {
            border-color: #f5c6c2;
            color: var(--red);
        }

        .btn-del:hover {
            background: #fdf0ef;
            border-color: var(--red);
        }

        /* ── MODAL ── */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 32, .55);
            backdrop-filter: blur(5px);
            z-index: 500;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal {
            background: var(--white);
            border-radius: 20px;
            width: min(520px, 100%);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .2);
            overflow: hidden;
            animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(.94) translateY(20px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .modal-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .modal-header-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--teal-lt);
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
        }

        .modal-header-icon.del {
            background: #fdf0ef;
            color: var(--red);
        }

        .modal-header-text .mht-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.1rem;
            color: var(--ink);
            line-height: 1.2;
        }

        .modal-header-text .mht-sub {
            font-size: .75rem;
            color: var(--muted);
            margin-top: 3px;
        }

        .modal-close {
            background: var(--bg);
            border: none;
            color: var(--muted);
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: .8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: var(--line);
            color: var(--ink);
        }

        .modal-body {
            padding: 22px 24px;
        }

        /* form inside modal */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--ink2);
            margin-bottom: 7px;
        }

        .form-label .req {
            color: var(--red);
            margin-left: 2px;
        }

        .form-control {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            font-family: 'DM Sans', inherit;
            font-size: .85rem;
            color: var(--ink);
            background: var(--bg);
            outline: none;
            transition: border .2s, box-shadow .2s, background .2s;
        }

        .form-control:focus {
            border-color: var(--teal);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        .field-error {
            font-size: .72rem;
            color: var(--red);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* modal footer */
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--line);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: var(--bg);
        }

        .btn-cancel {
            padding: 9px 20px;
            border-radius: 9px;
            border: 1.5px solid var(--line);
            background: #fff;
            font-family: 'DM Sans', inherit;
            font-size: .82rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
        }

        .btn-cancel:hover {
            border-color: var(--ink);
            color: var(--ink);
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
            gap: 7px;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 20px rgba(13, 122, 110, .4);
        }

        .btn-save:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
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
            gap: 7px;
        }

        .btn-del-confirm:hover {
            transform: translateY(-1px);
        }

        /* spinner */
        .spin {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .65s linear infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading .spin {
            display: block;
        }

        .loading .btn-icon {
            display: none;
        }

        /* delete modal content */
        .del-info {
            background: #fdf0ef;
            border: 1px solid #f5c6c2;
            border-radius: 10px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .82rem;
            color: var(--red);
            margin-bottom: 4px;
        }

        .del-info i {
            font-size: .88rem;
            flex-shrink: 0;
        }

        .del-posisi-name {
            font-weight: 700;
            font-size: .95rem;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .del-warning {
            font-size: .76rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* responsive */
        @media (max-width: 640px) {
            .summary-row {
                grid-template-columns: 1fr 1fr;
            }

            .table-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length {
                float: none !important;
            }
        }
    </style>
@endpush

@section('content')

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <h2>Manajemen Posisi</h2>
            <p>Kelola daftar posisi yang tersedia untuk rekrutmen pegawai</p>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i>
            Tambah Posisi
        </button>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="summary-row">
        <div class="summary-card">
            <div class="sc-icon all"><i class="fa-solid fa-layer-group"></i></div>
            <div>
                <div class="sc-num" id="scTotal">—</div>
                <div class="sc-lbl">Total Posisi</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="sc-icon aktif"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="sc-num" id="scAktif">—</div>
                <div class="sc-lbl">Masih Dibuka</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="sc-icon tutup"><i class="fa-solid fa-lock"></i></div>
            <div>
                <div class="sc-num" id="scTutup">—</div>
                <div class="sc-lbl">Sudah Ditutup</div>
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fa-solid fa-table-list"></i>
                Daftar Posisi Rekrutmen
            </div>
        </div>
        <div class="table-card-body">
            <table id="posisiTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:50px">#</th>
                        <th>Kode Posisi Pelamar</th>
                        <th>RS</th>
                        <th>Nama Posisi</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Ditutup</th>
                        <th>Dibuat</th>
                        <th style="width:130px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- ══════════════════════════════════════
     MODAL TAMBAH / EDIT POSISI
══════════════════════════════════════ --}}
    <div class="modal-backdrop" id="modalForm">
        <div class="modal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="modal-header-icon" id="mFormIcon">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="modal-header-text">
                        <div class="mht-title" id="mFormTitle">Tambah Posisi</div>
                        <div class="mht-sub" id="mFormSub">Isi detail posisi rekrutmen baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalForm')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="fId">

                <div class="form-group">
                    <label class="form-label" for="fNamaPosisi">
                        Nama Posisi <span class="req">*</span>
                    </label>
                    <input type="text" class="form-control" id="fNamaPosisi"
                        placeholder="cth. Perawat IGD, Dokter Umum...">
                    <div class="field-error" id="errNama" style="display:none">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="fIdRs">Rumah Sakit</label>
                    <select class="form-control" id="fIdRs">
                        <option value="">Pilih Rumah Sakit</option>
                        @foreach ($rumahSakits as $rs)
                            <option value="{{ $rs->id }}">{{ $rs->nama_rs }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="fDeskripsi">Deskripsi</label>
                    <textarea class="form-control" id="fDeskripsi"
                        placeholder="Tuliskan kualifikasi, tugas, atau persyaratan posisi ini..."></textarea>
                </div>

                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="fTanggalDitutup">Tanggal Ditutup</label>
                    <input type="date" class="form-control" id="fTanggalDitutup">
                    <div style="font-size:.72rem;color:var(--muted);margin-top:5px">
                        <i class="fa-solid fa-info-circle" style="color:var(--teal)"></i>
                        Kosongkan jika belum ditentukan
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="fKodePelamar">
                        Kode Pelamar <span class="req">*</span>
                    </label>
                    <input type="text" class="form-control" id="fKodePelamar" placeholder="cth. P001, P002...">
                    <div class="field-error" id="errKode" style="display:none">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span></span>
                    </div>
                    <small class="text-danger" id="errKode"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalForm')">Batal</button>
                <button class="btn-save" id="btnSave" onclick="submitForm()">
                    <span class="spin"></span>
                    <i class="fa-solid fa-floppy-disk btn-icon"></i>
                    <span class="btn-text">Simpan</span>
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
     MODAL KONFIRMASI HAPUS
══════════════════════════════════════ --}}
    <div class="modal-backdrop" id="modalDel">
        <div class="modal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="modal-header-icon del">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    <div class="modal-header-text">
                        <div class="mht-title">Hapus Posisi</div>
                        <div class="mht-sub">Tindakan ini tidak dapat dibatalkan</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalDel')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="del-posisi-name" id="delName">—</div>
                <div class="del-info">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Posisi ini akan dihapus secara permanen dari sistem.</span>
                </div>
                <div class="del-warning" style="margin-top:10px">
                    Pastikan posisi ini tidak sedang digunakan oleh pelamar aktif sebelum menghapus.
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalDel')">Batal</button>
                <button class="btn-del-confirm" id="btnDelConfirm" onclick="confirmDelete()">
                    <span class="spin"></span>
                    <i class="fa-solid fa-trash btn-icon"></i>
                    <span class="btn-text">Ya, Hapus</span>
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- jQuery + DataTables --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <!-- Responsive Extension -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        // ─── GLOBALS ─────────────────────────────────
        const STORE_URL = "{{ route('sdm.posisi.store') }}";
        const DELETE_URL = "/posisi/delete/"; // + id
        let _delId = null;
        let _table = null;

        // ─── DATATABLES INIT ─────────────────────────
        $(document).ready(function() {
            _table = $('#posisiTable').DataTable({
                ajax: {
                    url: "{{ route('sdm.posisi.index') }}",
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
                        render: (d, t, r, m) =>
                            `<div class="row-num">${m.row + 1}</div>`,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_pelamar',
                        render: d => `<strong>${escHtml(d)}</strong>`
                    },
                    {
                        data: 'nama_rs',
                        render: d => d ? escHtml(d) : `<span style="color:var(--muted);font-size:.75rem">— RS tidak ditentukan</span>`
                    },
                    {
                        data: 'nama_posisi',
                        render: d =>
                            `<div class="posisi-name">${escHtml(d)}</div>`
                    },
                    {
                        data: 'deskripsi_posisi',
                        render: d => d ?
                            `<div class="posisi-desc" title="${escHtml(d)}">${escHtml(d)}</div>` :
                            `<span style="color:var(--muted);font-size:.75rem">— Tidak ada deskripsi</span>`,
                        orderable: false
                    },
                    {
                        data: 'tanggal_ditutup',
                        render: d => {
                            if (!d)
                                return `<span class="date-badge nodate"><i class="fa-solid fa-minus"></i> Belum ditentukan</span>`;
                            const today = new Date().toISOString().split('T')[0];
                            const isTutup = d < today;
                            const fmt = new Date(d).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                            return isTutup ?
                                `<span class="date-badge tutup"><i class="fa-solid fa-lock"></i> ${fmt}</span>` :
                                `<span class="date-badge aktif"><i class="fa-solid fa-calendar-check"></i> ${fmt}</span>`;
                        }
                    },
                    {
                        data: 'created_at',
                        render: d => {
                            const dt = new Date(d);
                            const fmt = dt.toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                            return `<span style="font-size:.75rem;color:var(--muted)">${fmt}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: (d, t, row) => `
                    <div style="display:flex;gap:6px">
                        <button class="btn-tbl btn-edit" onclick="openEdit(${JSON.stringify(row).replace(/"/g,'&quot;')})">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        <button class="btn-tbl btn-del" onclick="openDel(${row.id}, '${escHtml(row.nama_posisi)}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>`,
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [4, 'desc']
                ],
                language: {
                    search: '',
                    searchPlaceholder: 'Cari posisi...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ posisi',
                    infoEmpty: 'Tidak ada data',
                    zeroRecords: `<div style="text-align:center;padding:30px;color:var(--muted)">
                <i class="fa-solid fa-inbox" style="font-size:1.8rem;margin-bottom:8px;display:block;opacity:.3"></i>
                Posisi tidak ditemukan
            </div>`,
                    paginate: {
                        previous: '<i class="fa-solid fa-chevron-left"></i>',
                        next: '<i class="fa-solid fa-chevron-right"></i>'
                    }
                },
                drawCallback: function() {
                    // re-animate rows
                    $('#posisiTable tbody tr').each(function(i) {
                        $(this).css({
                            opacity: 0,
                            transform: 'translateY(8px)',
                            transition: `opacity .25s ${i*0.04}s, transform .25s ${i*0.04}s`
                        });
                        setTimeout(() => $(this).css({
                            opacity: 1,
                            transform: 'none'
                        }), 10);
                    });
                },
                responsive: true,
                pageLength: 10,
                dom: '<"dt-top"lf>rt<"dt-bottom"ip>'
            });
        });

        // ─── SUMMARY UPDATE ──────────────────────────
        function updateSummary(data) {
            const today = new Date().toISOString().split('T')[0];
            const total = data.length;
            const tutup = data.filter(p => p.tanggal_ditutup && p.tanggal_ditutup < today).length;
            const aktif = total - tutup;
            animateNum('scTotal', total);
            animateNum('scAktif', aktif);
            animateNum('scTutup', tutup);
        }

        function animateNum(id, target) {
            const el = document.getElementById(id);
            let curr = 0;
            const step = Math.ceil(target / 20);
            const interval = setInterval(() => {
                curr = Math.min(curr + step, target);
                el.textContent = curr;
                if (curr >= target) clearInterval(interval);
            }, 40);
        }

        // ─── MODAL HELPERS ───────────────────────────
        function openModal() {
            document.getElementById('fId').value = '';
            document.getElementById('fIdRs').value = '';
            document.getElementById('fNamaPosisi').value = '';
            document.getElementById('fDeskripsi').value = '';
            document.getElementById('fTanggalDitutup').value = '';
            document.getElementById('fKodePelamar').value = '';
            document.getElementById('mFormTitle').textContent = 'Tambah Posisi';
            document.getElementById('mFormSub').textContent = 'Isi detail posisi rekrutmen baru';
            document.getElementById('btnSave').querySelector('.btn-text').textContent = 'Simpan';
            clearErrors();
            showModal('modalForm');
        }

        function openEdit(row) {
            document.getElementById('fId').value = row.id;
            document.getElementById('fIdRs').value = row.id_rs || '';
            document.getElementById('fNamaPosisi').value = row.nama_posisi || '';
            document.getElementById('fDeskripsi').value = row.deskripsi_posisi || '';
            document.getElementById('fTanggalDitutup').value = row.tanggal_ditutup ? row.tanggal_ditutup.split('T')[0] : '';
            document.getElementById('fKodePelamar').value = row.kode_pelamar || '';
            document.getElementById('mFormTitle').textContent = 'Edit Posisi';
            document.getElementById('mFormSub').textContent = 'Perbarui detail posisi ini';
            document.getElementById('btnSave').querySelector('.btn-text').textContent = 'Perbarui';
            clearErrors();
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
        // backdrop click
        ['modalForm', 'modalDel'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) closeModal(id);
            });
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeModal('modalForm');
                closeModal('modalDel');
            }
        });

        // ─── FORM SUBMIT ─────────────────────────────
        async function submitForm() {
            clearErrors();
            const id = document.getElementById('fId').value;
            const kode_pelamar = document.getElementById('fKodePelamar').value.trim();
            if (!kode_pelamar) {
                showErr('errKode', 'Kode pelamar wajib diisi');
                document.getElementById('fKodePelamar').focus();
                return;
            }
            const id_rs = document.getElementById('fIdRs').value || null;
            const nama = document.getElementById('fNamaPosisi').value.trim();
            const deskripsi_posisi = document.getElementById('fDeskripsi').value.trim();
            const tanggal = document.getElementById('fTanggalDitutup').value;

            if (!nama) {
                showErr('errNama', 'Nama posisi wajib diisi');
                document.getElementById('fNamaPosisi').focus();
                return;
            }

            const btn = document.getElementById('btnSave');
            setLoading(btn, true);

            try {

                const res = await fetch(STORE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id || undefined,
                        kode_pelamar: kode_pelamar,
                        nama_posisi: nama,
                        deskripsi_posisi: deskripsi_posisi,
                        tanggal_ditutup: tanggal || null,
                        id_rs: id_rs
                    })
                });

                const data = await res.json();

                if (res.ok && data.success) {

                    closeModal('modalForm');
                    _table.ajax.reload(null, false);
                    showToast(data.message, 'success');

                } else if (res.status === 422) {

                    const errs = data.errors || {};

                    if (errs.nama_posisi) {
                        showErr('errNama', errs.nama_posisi[0]);
                    }

                    if (errs.kode_pelamar) {
                        showErr('errKode', errs.kode_pelamar[0]);
                    }

                    showToast('Validasi gagal', 'error');

                } else {

                    showToast(data.message || 'Terjadi kesalahan', 'error');

                }

            } catch (e) {

                console.log(e);

                showToast('Terjadi kesalahan server', 'error');

            } finally {
                setLoading(btn, false);
            }
        }

        // ─── DELETE ──────────────────────────────────
        async function confirmDelete() {
            if (!_delId) return;
            const btn = document.getElementById('btnDelConfirm');
            setLoading(btn, true);

            try {
                const res = await fetch(DELETE_URL + _delId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();

                if (data.success) {
                    closeModal('modalDel');
                    _table.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else {
                    showToast(data.message || 'Gagal menghapus', 'error');
                }
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoading(btn, false);
                _delId = null;
            }
        }

        // ─── UTILS ───────────────────────────────────
        function setLoading(btn, state) {
            btn.disabled = state;
            btn.classList.toggle('loading', state);
        }

        function showErr(id, msg) {
            const el = document.getElementById(id);
            el.style.display = 'flex';
            el.querySelector('span').textContent = msg;
            el.previousElementSibling?.classList.add &&
                document.querySelector(`#${id}`).previousElementSibling?.focus?.();
        }

        function clearErrors() {
            document.querySelectorAll('.field-error').forEach(el => el.style.display = 'none');
        }

        function escHtml(str) {
            if (!str) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    </script>
@endpush
