@extends('layouts.app')

@section('title', 'Kelola Soal — ' . $kuis->nama_kuis)
@section('page-title', 'Kelola Soal')
@section('breadcrumb', 'SIREKRUT / SDM / Kuis')

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
        <style>
            /* ─── KUIS INFO BANNER ─── */
            .kuis-banner {
                background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dk) 100%);
                border-radius: 16px;
                padding: 22px 26px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
                position: relative;
                overflow: hidden;
                animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1)
            }

            .kuis-banner::after {
                content: '';
                position: absolute;
                right: -40px;
                top: -40px;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .06);
                pointer-events: none
            }

            .kuis-banner::before {
                content: '';
                position: absolute;
                right: 60px;
                bottom: -60px;
                width: 140px;
                height: 140px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .04);
                pointer-events: none
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

            .kb-title {
                font-family: 'DM Serif Display', Georgia, serif;
                font-size: 1.3rem;
                color: #fff;
                letter-spacing: -.2px;
                margin-bottom: 6px
            }

            .kb-meta {
                display: flex;
                gap: 14px;
                flex-wrap: wrap
            }

            .kb-chip {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(255, 255, 255, .15);
                backdrop-filter: blur(4px);
                border: 1px solid rgba(255, 255, 255, .2);
                color: #fff;
                font-size: .75rem;
                font-weight: 600;
                padding: 4px 12px;
                border-radius: 20px
            }

            .kb-actions {
                display: flex;
                gap: 10px;
                align-items: center;
                position: relative;
                z-index: 2
            }

            .btn-back {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 9px 18px;
                background: rgba(255, 255, 255, .15);
                border: 1px solid rgba(255, 255, 255, .3);
                color: #fff;
                border-radius: 9px;
                font-family: 'DM Sans', inherit;
                font-size: .82rem;
                font-weight: 600;
                cursor: pointer;
                text-decoration: none;
                transition: background .2s;
                backdrop-filter: blur(4px)
            }

            .btn-back:hover {
                background: rgba(255, 255, 255, .25)
            }

            .btn-add-soal {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 9px 18px;
                background: #fff;
                border: none;
                color: var(--teal-dk);
                border-radius: 9px;
                font-family: 'DM Sans', inherit;
                font-size: .82rem;
                font-weight: 700;
                cursor: pointer;
                transition: all .2s;
                box-shadow: 0 4px 14px rgba(0, 0, 0, .1)
            }

            .btn-add-soal:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, .15)
            }

            /* ─── TABLE CARD ─── */
            .table-card {
                background: var(--white);
                border-radius: 16px;
                border: 1px solid var(--line);
                box-shadow: 0 2px 14px rgba(0, 0, 0, .05);
                overflow: hidden;
                animation: fadeUp .4s .08s cubic-bezier(.22, 1, .36, 1) both
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

            /* ─── DATATABLES ─── */
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
                padding: 12px 14px !important;
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

            /* ─── SOAL ROW ─── */
            .soal-num {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: linear-gradient(135deg, var(--teal), var(--teal-dk));
                color: #fff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: .72rem;
                font-weight: 800;
                flex-shrink: 0
            }

            .soal-q {
                font-weight: 600;
                color: var(--ink);
                font-size: .84rem;
                max-width: 320px;
                line-height: 1.4
            }

            .jawaban-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4px;
                min-width: 200px
            }

            .jawaban-item {
                display: flex;
                align-items: flex-start;
                gap: 6px;
                font-size: .72rem;
                color: var(--ink2);
                line-height: 1.35;
                padding: 3px 0
            }

            .jwb-key {
                width: 20px;
                height: 20px;
                border-radius: 5px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: .65rem;
                font-weight: 800;
                flex-shrink: 0;
                background: var(--bg);
                border: 1px solid var(--line);
                color: var(--muted)
            }

            .jwb-key.correct {
                background: linear-gradient(135deg, var(--teal), var(--teal-dk));
                border-color: var(--teal);
                color: #fff
            }

            .badge-answer {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 4px 10px;
                border-radius: 7px;
                background: var(--teal-lt);
                color: var(--teal-dk);
                font-size: .72rem;
                font-weight: 800;
                letter-spacing: .3px
            }

            .badge-answer i {
                font-size: .65rem
            }

            .foto-thumb {
                width: 44px;
                height: 44px;
                border-radius: 8px;
                object-fit: cover;
                border: 2px solid var(--line);
                cursor: pointer;
                transition: transform .2s
            }

            .foto-thumb:hover {
                transform: scale(1.1)
            }

            .no-foto {
                width: 44px;
                height: 44px;
                border-radius: 8px;
                background: var(--bg);
                border: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--line);
                font-size: .75rem
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
                gap: 5px
            }

            /* ─── MODAL ─── */
            .modal-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(10, 20, 32, .6);
                backdrop-filter: blur(6px);
                z-index: 500;
                align-items: center;
                justify-content: center;
                padding: 16px
            }

            .modal-backdrop.open {
                display: flex
            }

            .modal-soal {
                background: var(--white);
                border-radius: 20px;
                width: min(660px, 100%);
                box-shadow: 0 30px 80px rgba(0, 0, 0, .22);
                overflow: hidden;
                animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both;
                display: flex;
                flex-direction: column;
                max-height: 94vh
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
                padding: 18px 22px 14px;
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
                font-size: 1.05rem;
                color: var(--ink)
            }

            .mht-sub {
                font-size: .73rem;
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
                padding: 20px 22px;
                overflow-y: auto;
                flex: 1
            }

            .modal-footer {
                padding: 13px 22px;
                border-top: 1px solid var(--line);
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                background: var(--bg);
                flex-shrink: 0
            }

            /* form */
            .form-row-2 {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px
            }

            .form-group {
                margin-bottom: 14px
            }

            .form-label {
                display: block;
                font-size: .7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .5px;
                color: var(--ink2);
                margin-bottom: 5px
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
                font-size: .7rem;
                color: var(--red);
                margin-top: 3px;
                display: none;
                align-items: center;
                gap: 4px
            }

            /* jawaban section */
            .jawaban-section {
                background: var(--bg);
                border-radius: 12px;
                border: 1px solid var(--line);
                padding: 14px 16px;
                margin-bottom: 14px
            }

            .jawaban-section-title {
                font-size: .7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .5px;
                color: var(--muted);
                margin-bottom: 10px
            }

            .jawaban-input-row {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-bottom: 8px
            }

            .jawaban-input-row:last-child {
                margin-bottom: 0
            }

            .jwb-badge {
                width: 28px;
                height: 28px;
                border-radius: 7px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: .72rem;
                font-weight: 800;
                flex-shrink: 0;
                margin-top: 2px
            }

            .jwb-a {
                background: #dbeafe;
                color: #1d4ed8
            }

            .jwb-b {
                background: #fef9c3;
                color: #854d0e
            }

            .jwb-c {
                background: #dcfce7;
                color: #166534
            }

            .jwb-d {
                background: #fde2ff;
                color: #86198f
            }

            .jawaban-input-row input {
                flex: 1;
                padding: 8px 11px;
                border: 1.5px solid var(--line);
                border-radius: 8px;
                font-family: 'DM Sans', inherit;
                font-size: .82rem;
                color: var(--ink);
                background: #fff;
                outline: none;
                transition: border .2s
            }

            .jawaban-input-row input:focus {
                border-color: var(--teal);
                box-shadow: 0 0 0 3px rgba(13, 122, 110, .08)
            }

            /* jawaban benar radio */
            .radio-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 8px;
                margin-bottom: 14px
            }

            .radio-opt {
                display: none
            }

            .radio-lbl {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 4px;
                padding: 10px 6px;
                border: 2px solid var(--line);
                border-radius: 10px;
                cursor: pointer;
                transition: all .2s;
                font-size: .72rem;
                font-weight: 700;
                color: var(--muted)
            }

            .radio-lbl:hover {
                border-color: var(--teal);
                background: var(--teal-lt);
                color: var(--teal-dk)
            }

            .radio-lbl .rl-key {
                width: 28px;
                height: 28px;
                border-radius: 7px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: .82rem;
                font-weight: 800
            }

            .radio-lbl .rl-key.a {
                background: #dbeafe;
                color: #1d4ed8
            }

            .radio-lbl .rl-key.b {
                background: #fef9c3;
                color: #854d0e
            }

            .radio-lbl .rl-key.c {
                background: #dcfce7;
                color: #166534
            }

            .radio-lbl .rl-key.d {
                background: #fde2ff;
                color: #86198f
            }

            .radio-opt:checked+.radio-lbl {
                border-color: var(--teal);
                background: var(--teal-lt);
                color: var(--teal-dk);
                box-shadow: 0 0 0 3px rgba(13, 122, 110, .12)
            }

            .radio-opt:checked+.radio-lbl .rl-key {
                box-shadow: 0 2px 8px rgba(13, 122, 110, .3)
            }

            /* foto upload */
            .foto-upload-wrap {
                border: 2px dashed var(--line);
                border-radius: 10px;
                padding: 16px;
                text-align: center;
                cursor: pointer;
                transition: border .2s, background .2s;
                position: relative
            }

            .foto-upload-wrap:hover {
                border-color: var(--teal);
                background: var(--teal-lt)
            }

            .foto-upload-wrap input {
                position: absolute;
                inset: 0;
                opacity: 0;
                cursor: pointer;
                width: 100%;
                height: 100%
            }

            .foto-upload-icon {
                font-size: 1.5rem;
                color: var(--muted);
                margin-bottom: 6px
            }

            .foto-upload-text {
                font-size: .75rem;
                color: var(--muted);
                font-weight: 500
            }

            .foto-upload-text span {
                color: var(--teal);
                font-weight: 700
            }

            .foto-preview-wrap {
                display: none;
                position: relative;
                margin-top: 10px
            }

            .foto-preview {
                width: 100%;
                max-height: 160px;
                object-fit: contain;
                border-radius: 8px;
                border: 1px solid var(--line)
            }

            .foto-remove {
                position: absolute;
                top: -6px;
                right: -6px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: var(--red);
                color: #fff;
                border: none;
                cursor: pointer;
                font-size: .65rem;
                display: flex;
                align-items: center;
                justify-content: center
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
                transform: translateY(-1px)
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

            .del-info {
                background: #fdf0ef;
                border: 1px solid #f5c6c2;
                border-radius: 10px;
                padding: 13px;
                display: flex;
                align-items: flex-start;
                gap: 10px;
                font-size: .82rem;
                color: var(--red)
            }

            /* lightbox foto */
            .lightbox {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .85);
                z-index: 700;
                align-items: center;
                justify-content: center;
                padding: 20px
            }

            .lightbox.open {
                display: flex
            }

            .lightbox img {
                max-width: 90vw;
                max-height: 85vh;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
                object-fit: contain
            }

            .lightbox-close {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, .15);
                border: none;
                color: #fff;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                cursor: pointer;
                font-size: .9rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background .2s
            }

            .lightbox-close:hover {
                background: rgba(255, 255, 255, .25)
            }

            @media(max-width:640px) {
                .kuis-banner {
                    flex-direction: column;
                    align-items: flex-start
                }

                .kb-actions {
                    width: 100%;
                    justify-content: space-between
                }

                .form-row-2 {
                    grid-template-columns: 1fr
                }

                .radio-grid {
                    grid-template-columns: 1fr 1fr
                }

                .jawaban-grid {
                    grid-template-columns: 1fr
                }

                .action-group {
                    flex-direction: column
                }
            }
        </style>
    @endpush

@section('content')

    {{-- KUIS BANNER --}}
    <div class="kuis-banner">
        <div>
            <div class="kb-title">{{ $kuis->nama_kuis }}</div>
            <div class="kb-meta">
                <span class="kb-chip"><i class="fa-solid fa-briefcase"></i> {{ $kuis->posisi?->nama_posisi ?? '-' }}</span>
                <span class="kb-chip"><i class="fa-solid fa-clock"></i> {{ $kuis->waktu }} menit</span>
                <span class="kb-chip"><i class="fa-solid fa-list-check"></i> <span
                        id="totalSoalChip">{{ $kuis->soals->count() }}</span> soal</span>
            </div>
        </div>
        <div class="kb-actions">
            <a href="{{ route('sdm.kuis.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <button class="btn-add-soal" onclick="openModal()">
                <i class="fa-solid fa-plus"></i> Tambah Soal
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title"><i class="fa-solid fa-list-check"></i> Daftar Soal</div>
        </div>
        <div class="table-card-body">
            <table id="soalTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan</th>
                        <th>Pilihan Jawaban</th>
                        <th>Jawaban Benar</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- ══ MODAL FORM SOAL ══ --}}
    <div class="modal-backdrop" id="modalSoal">
        <div class="modal-soal">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="mh-icon"><i class="fa-solid fa-circle-question"></i></div>
                    <div>
                        <div class="mht-title" id="mSoalTitle">Tambah Soal</div>
                        <div class="mht-sub" id="mSoalSub">Isi pertanyaan dan jawaban</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalSoal')"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="fSoalId">

                {{-- Pertanyaan --}}
                <div class="form-group">
                    <label class="form-label">Pertanyaan <span class="req">*</span></label>
                    <textarea class="form-control" id="fPertanyaan" placeholder="Tuliskan pertanyaan soal..." rows="3"></textarea>
                    <div class="field-error" id="errPertanyaan"><i
                            class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                </div>

                {{-- Foto Soal --}}
                <div class="form-group">
                    <label class="form-label">Foto Soal <span
                            style="color:var(--muted);font-weight:500;text-transform:none;letter-spacing:0">(opsional)</span></label>
                    <div class="foto-upload-wrap" id="fotoWrap">
                        <input type="file" id="fFoto" accept="image/jpeg,image/png,image/jpg"
                            onchange="previewFoto(this)">
                        <div class="foto-upload-icon"><i class="fa-solid fa-image"></i></div>
                        <div class="foto-upload-text">Klik atau seret gambar ke sini<br><span>JPG, JPEG, PNG</span> maks.
                            2MB</div>
                    </div>
                    <div class="foto-preview-wrap" id="fotoPreviewWrap">
                        <img src="" alt="preview" class="foto-preview" id="fotoPreview">
                        <button type="button" class="foto-remove" onclick="removeFoto()" title="Hapus foto"><i
                                class="fa-solid fa-xmark"></i></button>
                    </div>
                    <input type="hidden" id="fFotoExisting">
                    <div class="field-error" id="errFoto"><i class="fa-solid fa-triangle-exclamation"></i><span></span>
                    </div>
                </div>

                {{-- Pilihan Jawaban --}}
                <div class="jawaban-section">
                    <div class="jawaban-section-title">Pilihan Jawaban</div>
                    @foreach (['a' => ['jwb-a', 'A'], 'b' => ['jwb-b', 'B'], 'c' => ['jwb-c', 'C'], 'd' => ['jwb-d', 'D']] as $key => $meta)
                        <div class="jawaban-input-row">
                            <div class="jwb-badge {{ $meta[0] }}">{{ $meta[1] }}</div>
                            <input type="text" id="fJawaban_{{ $key }}" class="jwb-inp"
                                placeholder="Jawaban {{ $meta[1] }}...">
                        </div>
                    @endforeach
                    <div class="field-error" id="errJawaban" style="margin-top:6px"><i
                            class="fa-solid fa-triangle-exclamation"></i><span></span></div>
                </div>

                {{-- Jawaban Benar --}}
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Jawaban Benar <span class="req">*</span></label>
                    <div class="radio-grid">
                        @foreach (['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $val => $lbl)
                            <div>
                                <input type="radio" name="jawaban_benar" id="jb_{{ $val }}"
                                    value="{{ $val }}" class="radio-opt">
                                <label for="jb_{{ $val }}" class="radio-lbl">
                                    <div class="rl-key {{ $val }}">{{ $lbl }}</div>
                                    Jawaban {{ $lbl }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="field-error" id="errBenar"><i class="fa-solid fa-triangle-exclamation"></i><span></span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalSoal')">Batal</button>
                <button class="btn-save" id="btnSaveSoal" onclick="submitSoal()">
                    <span class="spin"></span><i class="fa-solid fa-floppy-disk btn-icon"></i><span
                        class="btn-text">Simpan Soal</span>
                </button>
            </div>
        </div>
    </div>

    {{-- ══ MODAL HAPUS SOAL ══ --}}
    <div class="modal-backdrop" id="modalDelSoal">
        <div class="modal-soal" style="max-width:420px">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="mh-icon del"><i class="fa-solid fa-trash-can"></i></div>
                    <div>
                        <div class="mht-title">Hapus Soal</div>
                        <div class="mht-sub">Tindakan ini tidak dapat dibatalkan</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal('modalDelSoal')"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="del-info"><i class="fa-solid fa-triangle-exclamation"
                        style="flex-shrink:0;margin-top:1px"></i><span>Soal dan foto terkait akan dihapus secara permanen
                        dari sistem.</span></div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modalDelSoal')">Batal</button>
                <button class="btn-del-confirm" id="btnDelSoal" onclick="confirmDelSoal()">
                    <span class="spin"></span><i class="fa-solid fa-trash btn-icon"></i><span class="btn-text">Ya,
                        Hapus</span>
                </button>
            </div>
        </div>
    </div>

    {{-- LIGHTBOX --}}
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="fa-solid fa-xmark"></i></button>
        <img src="" alt="foto soal" id="lightboxImg">
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        const KUIS_ID = {{ $kuis->id }};
        const SOAL_URL = `/sdm/kuis/${KUIS_ID}/soal`;
        const STORE_URL = `/sdm/kuis/${KUIS_ID}/soal/store`;
        let _delSoalId = null,
            _dt = null;

        $(function() {
            _dt = $('#soalTable').DataTable({
                ajax: {
                    url: SOAL_URL,
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    dataSrc: function(json) {
                        updateChip(json.length);
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        render: (d, t, r, m) => `<div class="soal-num">${m.row+1}</div>`,
                        orderable: false,
                        searchable: false,
                        width: '40px'
                    },
                    {
                        data: 'pertanyaan',
                        render: d => `<div class="soal-q">${esc(d)}</div>`,
                        width: '260px'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: (d, t, row) => `
                <div class="jawaban-grid">
                    ${['a','b','c','d'].map(k=>`
                            <div class="jawaban-item">
                                <span class="jwb-key ${row.jawaban_benar===k?'correct':''}">${k.toUpperCase()}</span>
                                <span>${esc(row['jawaban_'+k]||'-')}</span>
                            </div>`).join('')}
                </div>`
                    },
                    {
                        data: 'jawaban_benar',
                        render: d =>
                            `<span class="badge-answer"><i class="fa-solid fa-check-circle"></i> ${d.toUpperCase()}</span>`
                    },
                    {
                        data: 'foto_soal',
                        orderable: false,
                        searchable: false,
                        render: d => d ?
                            `<img src="/storage/${esc(d)}" class="foto-thumb" onclick="openLightbox('/storage/${esc(d)}')" alt="foto">` :
                            `<div class="no-foto"><i class="fa-solid fa-image"></i></div>`
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: (d, t, row) => `
                <div class="action-group">
                    <button class="btn-tbl btn-edit" onclick='openEdit(${JSON.stringify(row).replace(/'/g,"\\'")})'><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <button class="btn-tbl btn-del" onclick="openDel(${row.id})"><i class="fa-solid fa-trash-can"></i></button>
                </div>`
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: '',
                    searchPlaceholder: 'Cari soal...',
                    lengthMenu: 'Tampilkan _MENU_ soal',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ soal',
                    infoEmpty: 'Belum ada soal',
                    zeroRecords: '<div style="text-align:center;padding:30px;color:var(--muted)"><i class="fa-solid fa-inbox" style="font-size:1.8rem;display:block;margin-bottom:8px;opacity:.3"></i>Soal tidak ditemukan</div>',
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

        function updateChip(n) {
            document.getElementById('totalSoalChip').textContent = n;
        }

        // ── MODAL ──
        function openModal() {
            document.getElementById('fSoalId').value = '';
            document.getElementById('fPertanyaan').value = '';
            ['a', 'b', 'c', 'd'].forEach(k => document.getElementById(`fJawaban_${k}`).value = '');
            document.querySelectorAll('input[name="jawaban_benar"]').forEach(r => r.checked = false);
            removeFoto();
            document.getElementById('fFotoExisting').value = '';
            document.getElementById('mSoalTitle').textContent = 'Tambah Soal';
            document.getElementById('mSoalSub').textContent = 'Isi pertanyaan dan pilihan jawaban';
            document.querySelector('#btnSaveSoal .btn-text').textContent = 'Simpan Soal';
            clearErr();
            showModal('modalSoal');
        }

        function openEdit(row) {
            document.getElementById('fSoalId').value = row.id;
            document.getElementById('fPertanyaan').value = row.pertanyaan || '';
            ['a', 'b', 'c', 'd'].forEach(k => document.getElementById(`fJawaban_${k}`).value = row[`jawaban_${k}`] || '');
            const rb = document.getElementById(`jb_${row.jawaban_benar}`);
            if (rb) rb.checked = true;
            // foto existing
            removeFoto();
            if (row.foto_soal) {
                document.getElementById('fFotoExisting').value = row.foto_soal;
                document.getElementById('fotoPreview').src = `/storage/${row.foto_soal}`;
                document.getElementById('fotoPreviewWrap').style.display = 'block';
                document.getElementById('fotoWrap').style.display = 'none';
            }
            document.getElementById('mSoalTitle').textContent = 'Edit Soal';
            document.getElementById('mSoalSub').textContent = 'Perbarui pertanyaan dan jawaban';
            document.querySelector('#btnSaveSoal .btn-text').textContent = 'Perbarui Soal';
            clearErr();
            showModal('modalSoal');
        }

        function openDel(id) {
            _delSoalId = id;
            showModal('modalDelSoal');
        }

        function showModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }
        ['modalSoal', 'modalDelSoal'].forEach(id => document.getElementById(id).addEventListener('click', e => {
            if (e.target === document.getElementById(id)) closeModal(id);
        }));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeModal('modalSoal');
                closeModal('modalDelSoal');
            }
        });

        // ── SUBMIT SOAL ──
        async function submitSoal() {
            clearErr();
            const soalId = document.getElementById('fSoalId').value;
            const pertanyaan = document.getElementById('fPertanyaan').value.trim();
            const jawabans = ['a', 'b', 'c', 'd'].reduce((o, k) => ({
                ...o,
                [k]: document.getElementById(`fJawaban_${k}`).value.trim()
            }), {});
            const benar = document.querySelector('input[name="jawaban_benar"]:checked')?.value;
            const fotoFile = document.getElementById('fFoto').files[0];
            const existing = document.getElementById('fFotoExisting').value;

            let valid = true;
            if (!pertanyaan) {
                showErr('errPertanyaan', 'Pertanyaan wajib diisi');
                valid = false;
            }
            if (Object.values(jawabans).some(v => !v)) {
                showErr('errJawaban', 'Semua pilihan jawaban wajib diisi');
                valid = false;
            }
            if (!benar) {
                showErr('errBenar', 'Tentukan jawaban yang benar');
                valid = false;
            }
            if (!valid) return;

            const fd = new FormData();
            if (soalId) fd.append('soal_id', soalId);
            fd.append('pertanyaan', pertanyaan);
            ['a', 'b', 'c', 'd'].forEach(k => fd.append(`jawaban_${k}`, jawabans[k]));
            fd.append('jawaban_benar', benar);
            if (fotoFile) fd.append('foto_soal', fotoFile);
            fd.append('_token', csrfToken);

            const btn = document.getElementById('btnSaveSoal');
            setLoad(btn, true);
            try {
                const res = await fetch(STORE_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: fd
                });
                const data = await res.json();
                if (data.success) {
                    closeModal('modalSoal');
                    _dt.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else if (res.status === 422 && data.errors) {
                    if (data.errors.pertanyaan) showErr('errPertanyaan', data.errors.pertanyaan[0]);
                    if (data.errors.foto_soal) showErr('errFoto', data.errors.foto_soal[0]);
                    if (data.errors.jawaban_benar) showErr('errBenar', data.errors.jawaban_benar[0]);
                } else showToast(data.message || 'Terjadi kesalahan', 'error');
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoad(btn, false);
            }
        }

        // ── DELETE SOAL ──
        async function confirmDelSoal() {
            if (!_delSoalId) return;
            const btn = document.getElementById('btnDelSoal');
            setLoad(btn, true);
            try {
                const res = await fetch(`${SOAL_URL}/${_delSoalId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    closeModal('modalDelSoal');
                    _dt.ajax.reload(null, false);
                    showToast(data.message, 'success');
                } else showToast(data.message || 'Gagal menghapus', 'error');
            } catch (e) {
                showToast('Tidak dapat terhubung ke server', 'error');
            } finally {
                setLoad(btn, false);
                _delSoalId = null;
            }
        }

        // ── FOTO ──
        function previewFoto(input) {
            if (!input.files[0]) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('fotoPreview').src = e.target.result;
                document.getElementById('fotoPreviewWrap').style.display = 'block';
                document.getElementById('fotoWrap').style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function removeFoto() {
            document.getElementById('fFoto').value = '';
            document.getElementById('fotoPreviewWrap').style.display = 'none';
            document.getElementById('fotoWrap').style.display = 'block';
            document.getElementById('fotoPreview').src = '';
        }

        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.add('open');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
        }

        // ── UTILS ──
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
    </script>
@endpush
