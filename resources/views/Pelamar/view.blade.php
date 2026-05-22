@extends('Layouts.app')

@section('title', 'Data Pelamar')
@section('page-title', 'Data Pelamar')
@section('breadcrumb', 'SIREKRUT / Rekrutmen / Validasi Pelamar')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        /* ── STATS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 14px;
            margin-bottom: 26px
        }

        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            border: 1px solid var(--line);
            cursor: pointer;
            transition: box-shadow .2s, transform .2s;
            animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1) both
        }

        .stat-card:nth-child(2) {
            animation-delay: .06s
        }

        .stat-card:nth-child(3) {
            animation-delay: .12s
        }

        .stat-card:nth-child(4) {
            animation-delay: .18s
        }

        .stat-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
            transform: translateY(-2px)
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            flex-shrink: 0
        }

        .stat-icon.all {
            background: #eef2f7;
            color: var(--ink2)
        }

        .stat-icon.pending {
            background: #fef9ec;
            color: var(--amber)
        }

        .stat-icon.diterima {
            background: #edf7f2;
            color: var(--green)
        }

        .stat-icon.ditolak {
            background: #fdf0ef;
            color: var(--red)
        }

        .stat-num {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1
        }

        .stat-lbl {
            font-size: .72rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 3px
        }

        /* ── TABLE ── */
        .table-wrap {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--line);
            overflow: hidden;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .05);
            padding: 20px
        }

        .ext-filter-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px
        }

        .filter-select {
            padding: 9px 32px 9px 12px;
            border: 1.5px solid var(--line);
            border-radius: 9px;
            font-family: inherit;
            font-size: .83rem;
            color: var(--ink);
            background: var(--bg);
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7e93' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            transition: border .2s
        }

        .filter-select:focus {
            border-color: var(--teal)
        }

        div.dataTables_wrapper div.dataTables_filter input,
        div.dataTables_wrapper div.dataTables_length select {
            border: 1.5px solid var(--line);
            border-radius: 9px;
            padding: 7px 12px;
            font-family: inherit;
            font-size: .83rem;
            color: var(--ink);
            background: var(--bg);
            outline: none;
            transition: border .2s, box-shadow .2s
        }

        div.dataTables_wrapper div.dataTables_filter input:focus,
        div.dataTables_wrapper div.dataTables_length select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1)
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: .75rem;
            color: var(--muted)
        }

        div.dataTables_paginate .paginate_button {
            border-radius: 7px !important;
            font-size: .78rem !important
        }

        div.dataTables_paginate .paginate_button.current,
        div.dataTables_paginate .paginate_button.current:hover {
            background: var(--teal) !important;
            border-color: var(--teal) !important;
            color: #fff !important
        }

        div.dataTables_paginate .paginate_button:hover {
            background: var(--teal-lt) !important;
            border-color: var(--teal) !important;
            color: var(--teal-dk) !important
        }

        table.dataTable thead th {
            padding: 13px 16px;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--bg);
            border-bottom: 1px solid var(--line) !important;
            white-space: nowrap
        }

        table.dataTable tbody tr {
            border-bottom: 1px solid var(--line);
            transition: background .15s
        }

        table.dataTable tbody tr:hover {
            background: var(--teal-lt) !important
        }

        table.dataTable tbody td {
            padding: 14px 16px;
            font-size: .83rem;
            color: var(--ink2);
            vertical-align: middle
        }

        table.dataTable {
            border-collapse: collapse !important
        }

        .td-name {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .td-name-primary {
            font-weight: 600;
            font-size: .85rem;
            color: var(--ink)
        }

        .td-name-secondary {
            font-size: .72rem;
            color: var(--muted)
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .3px;
            white-space: nowrap
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%
        }

        .badge.pending {
            background: #fef9ec;
            color: var(--amber)
        }

        .badge.pending .badge-dot {
            background: var(--amber)
        }

        .badge.diterima {
            background: #edf7f2;
            color: var(--green)
        }

        .badge.diterima .badge-dot {
            background: var(--green)
        }

        .badge.ditolak {
            background: #fdf0ef;
            color: var(--red)
        }

        .badge.ditolak .badge-dot {
            background: var(--red)
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 13px;
            border-radius: 8px;
            border: 1.5px solid;
            font-family: inherit;
            font-size: .75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap
        }

        .btn-action:hover {
            transform: translateY(-1px)
        }

        .btn-validasi {
            background: var(--teal);
            border-color: var(--teal);
            color: #fff
        }

        .btn-validasi:hover {
            background: var(--teal-dk);
            box-shadow: 0 4px 12px rgba(13, 122, 110, .35)
        }

        .btn-detail {
            background: transparent;
            border-color: var(--line);
            color: var(--muted)
        }

        .btn-detail:hover {
            border-color: var(--teal);
            color: var(--teal)
        }

        .btn-final {
            background: transparent;
            border-color: var(--line);
            color: var(--muted);
            font-size: .7rem;
            cursor: default
        }

        /* ════════════  MODAL SHARED  ════════════ */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 32, .55);
            backdrop-filter: blur(4px);
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
            width: min(500px, 100%);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .2);
            overflow: hidden;
            animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both
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
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            padding: 22px 24px 18px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between
        }

        .modal-header-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.15rem;
            color: #fff
        }

        .modal-header-sub {
            font-size: .78rem;
            color: rgba(255, 255, 255, .7);
            margin-top: 2px
        }

        .modal-close {
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: .8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
            flex-shrink: 0
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, .25)
        }

        .modal-body {
            padding: 22px 24px
        }

        .modal-pelamar-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 18px
        }

        .modal-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            color: #fff;
            font-size: .9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .modal-pelamar-name {
            font-weight: 700;
            font-size: .9rem;
            color: var(--ink)
        }

        .modal-pelamar-meta {
            font-size: .74rem;
            color: var(--muted);
            margin-top: 2px
        }

        .current-status {
            margin-left: auto
        }

        .flow-steps {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 18px;
            background: var(--bg);
            border-radius: 10px;
            padding: 11px 16px;
            flex-wrap: wrap
        }

        .flow-step {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: .7rem;
            font-weight: 600;
            color: var(--muted)
        }

        .flow-step.done {
            color: var(--teal)
        }

        .flow-step.current {
            color: var(--gold);
            font-weight: 700
        }

        .flow-step i {
            font-size: .68rem
        }

        .flow-arrow {
            color: var(--line);
            font-size: .7rem;
            margin: 0 2px
        }

        .status-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px
        }

        .status-option {
            display: none
        }

        .status-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 13px;
            border: 2px solid var(--line);
            border-radius: 11px;
            cursor: pointer;
            transition: all .2s;
            font-size: .8rem;
            font-weight: 600;
            color: var(--ink2)
        }

        .status-label:hover {
            border-color: var(--teal);
            background: var(--teal-lt)
        }

        .status-option:checked+.status-label {
            border-color: var(--teal);
            background: var(--teal-lt);
            color: var(--teal-dk);
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .12)
        }

        .sl-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            flex-shrink: 0
        }

        .sl-diterima .sl-icon {
            background: #edf7f2;
            color: var(--green)
        }

        .sl-ditolak .sl-icon {
            background: #fdf0ef;
            color: var(--red)
        }

        #so_diterima:checked+.status-label {
            border-color: var(--green);
            background: #edf7f2;
            color: var(--green);
            box-shadow: 0 0 0 3px rgba(26, 127, 90, .12)
        }

        #so_ditolak:checked+.status-label {
            border-color: var(--red);
            background: #fdf0ef;
            color: var(--red);
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .12)
        }

        .form-label-sm {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .4px;
            text-transform: uppercase;
            color: var(--ink2);
            margin-bottom: 6px;
            display: block
        }

        textarea.catatan-input {
            width: 100%;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            padding: 10px 12px;
            font-family: inherit;
            font-size: .83rem;
            color: var(--ink);
            background: var(--bg);
            resize: vertical;
            min-height: 80px;
            outline: none;
            transition: border .2s, box-shadow .2s;
            margin-bottom: 18px
        }

        textarea.catatan-input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1);
            background: var(--white)
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end
        }

        .btn-cancel {
            padding: 10px 20px;
            border-radius: 9px;
            border: 1.5px solid var(--line);
            background: none;
            font-family: inherit;
            font-size: .83rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s
        }

        .btn-cancel:hover {
            border-color: var(--ink);
            color: var(--ink)
        }

        .btn-submit {
            padding: 10px 24px;
            border-radius: 9px;
            border: none;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            font-family: inherit;
            font-size: .83rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 4px 14px rgba(13, 122, 110, .3)
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(13, 122, 110, .4)
        }

        .btn-submit:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none
        }

        .btn-submit .spin {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
            display: none
        }

        .btn-submit.loading .spin {
            display: block
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }

        /* ════════════  MODAL DETAIL  ════════════ */
        .detail-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 32, .6);
            backdrop-filter: blur(5px);
            z-index: 550;
            align-items: center;
            justify-content: center;
            padding: 16px
        }

        .detail-backdrop.open {
            display: flex
        }

        .detail-modal {
            background: var(--white);
            border-radius: 22px;
            width: min(700px, 100%);
            max-height: 92vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 40px 100px rgba(0, 0, 0, .25);
            animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both
        }

        .detail-header {
            background: linear-gradient(135deg, #162130 0%, #0d7a6e 100%);
            padding: 24px 26px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden
        }

        .detail-header::after {
            content: '';
            position: absolute;
            right: -50px;
            top: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            pointer-events: none
        }

        .dh-avatar {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            color: #fff;
            font-size: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, .2);
            box-shadow: 0 4px 16px rgba(0, 0, 0, .2)
        }

        .dh-info {
            flex: 1;
            min-width: 0
        }

        .dh-name {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.2rem;
            color: #fff;
            letter-spacing: -.2px
        }

        .dh-chips {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-top: 7px
        }

        .dh-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            color: rgba(255, 255, 255, .9);
            font-size: .7rem;
            font-weight: 600
        }

        .dh-close {
            background: rgba(255, 255, 255, .12);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 9px;
            cursor: pointer;
            font-size: .82rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
            flex-shrink: 0
        }

        .dh-close:hover {
            background: rgba(255, 255, 255, .22)
        }

        .dm-tabs {
            display: flex;
            border-bottom: 1px solid var(--line);
            background: var(--bg);
            flex-shrink: 0
        }

        .dm-tab {
            flex: 1;
            padding: 11px 8px;
            text-align: center;
            font-size: .76rem;
            font-weight: 700;
            color: var(--muted);
            cursor: pointer;
            border: none;
            background: none;
            border-bottom: 2.5px solid transparent;
            transition: all .2s;
            font-family: 'DM Sans', inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px
        }

        .dm-tab:hover {
            color: var(--teal)
        }

        .dm-tab.active {
            color: var(--teal);
            border-bottom-color: var(--teal);
            background: var(--white)
        }

        .dm-body {
            flex: 1;
            overflow-y: auto
        }

        .dm-pane {
            display: none;
            padding: 20px 24px
        }

        .dm-pane.active {
            display: block
        }

        .ds-title {
            font-size: .65rem;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            color: var(--teal);
            border-bottom: 1.5px solid var(--teal-lt);
            padding-bottom: 6px;
            margin: 18px 0 10px;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .ds-title:first-child {
            margin-top: 0
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px
        }

        .info-item {
            background: var(--bg);
            border-radius: 10px;
            padding: 11px 13px;
            border: 1px solid var(--line)
        }

        .info-item.full {
            grid-column: 1/-1
        }

        .info-key {
            font-size: .62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            margin-bottom: 3px
        }

        .info-val {
            font-size: .84rem;
            color: var(--ink);
            font-weight: 600;
            line-height: 1.5;
            word-break: break-word
        }

        .info-val.empty {
            color: var(--muted);
            font-style: italic;
            font-weight: 400
        }

        .pw-wrap {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .pw-mask {
            font-family: monospace;
            font-size: .9rem;
            letter-spacing: 2px;
            color: var(--ink);
            flex: 1
        }

        .pw-toggle {
            background: none;
            border: 1px solid var(--line);
            border-radius: 7px;
            padding: 4px 9px;
            font-size: .72rem;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 4px;
            font-family: inherit
        }

        .pw-toggle:hover {
            border-color: var(--teal);
            color: var(--teal)
        }

        /* ════ RESET PASSWORD SECTION ════ */
        .reset-pw-card {
            background: var(--bg);
            border: 1.5px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
            margin-top: 6px
        }

        .reset-pw-card-header {
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--line);
            background: var(--white)
        }

        .reset-pw-card-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .82rem;
            flex-shrink: 0
        }

        .reset-pw-card-title {
            font-size: .85rem;
            font-weight: 700;
            color: var(--ink)
        }

        .reset-pw-card-sub {
            font-size: .72rem;
            color: var(--muted);
            margin-top: 1px
        }

        .reset-pw-card-body {
            padding: 16px
        }

        .pw-input-wrap {
            position: relative;
            margin-bottom: 12px
        }

        .pw-input-wrap input {
            width: 100%;
            padding: 10px 40px 10px 13px;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            font-family: inherit;
            font-size: .85rem;
            color: var(--ink);
            background: var(--white);
            outline: none;
            transition: border .2s, box-shadow .2s
        }

        .pw-input-wrap input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .1)
        }

        .pw-input-wrap input.error-input {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .1)
        }

        .pw-eye-btn {
            position: absolute;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            font-size: .82rem;
            transition: color .2s;
            padding: 4px
        }

        .pw-eye-btn:hover {
            color: var(--teal)
        }

        .pw-strength-bar {
            height: 4px;
            border-radius: 20px;
            background: var(--line);
            overflow: hidden;
            margin-bottom: 6px
        }

        .pw-strength-fill {
            height: 100%;
            border-radius: 20px;
            transition: width .4s, background .3s;
            width: 0
        }

        .pw-strength-text {
            font-size: .68rem;
            color: var(--muted);
            margin-bottom: 12px
        }

        .pw-requirements {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 14px;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 10px 12px
        }

        .pw-req-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: .72rem;
            color: var(--muted);
            transition: color .2s
        }

        .pw-req-item.ok {
            color: var(--green)
        }

        .pw-req-item i {
            font-size: .7rem;
            width: 14px;
            text-align: center
        }

        .pw-req-item.ok i::before {
            content: '\f00c'
        }

        /* fa-check */
        .pw-req-item:not(.ok) i::before {
            content: '\f111'
        }

        /* fa-circle */
        .pw-generate-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            border: 1.5px dashed var(--teal);
            background: var(--teal-lt);
            color: var(--teal-dk);
            font-size: .76rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
            margin-bottom: 14px
        }

        .pw-generate-btn:hover {
            background: var(--teal);
            color: #fff;
            border-style: solid
        }

        .pw-actions {
            display: flex;
            gap: 9px;
            justify-content: flex-end
        }

        .btn-pw-reset {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            border-radius: 9px;
            border: none;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            font-family: inherit;
            font-size: .8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 3px 12px rgba(13, 122, 110, .3)
        }

        .btn-pw-reset:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 18px rgba(13, 122, 110, .4)
        }

        .btn-pw-reset:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none
        }

        .btn-pw-reset .spin {
            width: 13px;
            height: 13px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
            display: none
        }

        .btn-pw-reset.loading .spin {
            display: block
        }

        .pw-result-box {
            display: none;
            background: #edf7f2;
            border: 1.5px solid var(--green);
            border-radius: 10px;
            padding: 12px 14px;
            margin-top: 10px
        }

        .pw-result-box.show {
            display: block
        }

        .pw-result-title {
            font-size: .72rem;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .pw-result-newpw {
            font-family: monospace;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 7px;
            padding: 7px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: 4px
        }

        .pw-result-copy {
            background: none;
            border: 1px solid var(--teal);
            border-radius: 6px;
            padding: 3px 10px;
            font-size: .7rem;
            font-weight: 700;
            color: var(--teal);
            cursor: pointer;
            font-family: inherit;
            transition: all .2s
        }

        .pw-result-copy:hover {
            background: var(--teal);
            color: #fff
        }

        /* ════ BERKAS CARDS (PERBAIKAN ICON) ════ */
        .berkas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px
        }

        .berkas-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 16px 12px;
            background: var(--bg);
            border: 1.5px solid var(--line);
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            text-align: center
        }

        .berkas-card:hover {
            border-color: var(--teal);
            background: var(--teal-lt);
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(13, 122, 110, .12)
        }

        /* file type icon wrapper */
        .berkas-icon-wrap {
            width: 52px;
            height: 60px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        /* generic file shape via CSS */
        .berkas-icon-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--file-bg, #eef2f7);
            border-radius: 6px 6px 6px 6px;
            clip-path: polygon(0 0, 78% 0, 100% 16%, 100% 100%, 0 100%)
        }

        .berkas-icon-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 22%;
            height: 16%;
            background: var(--file-fold, #c8d3e0);
            border-radius: 0 0 0 5px;
            clip-path: polygon(0 0, 100% 100%, 0 100%)
        }

        .berkas-icon-wrap .file-type-badge {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            font-size: .55rem;
            font-weight: 900;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--file-color, #4a5568);
            background: var(--file-badge-bg, rgba(255, 255, 255, .85));
            border-radius: 3px;
            padding: 1px 5px;
            white-space: nowrap
        }

        .berkas-icon-wrap .file-icon-main {
            font-size: 1.4rem;
            color: var(--file-color, #4a5568);
            z-index: 1;
            position: relative;
            margin-top: -6px
        }

        /* colour themes per type */
        .ftype-pdf {
            --file-bg: #fdf0ef;
            --file-fold: #ffc5be;
            --file-color: #c0392b;
            --file-badge-bg: rgba(255, 255, 255, .9)
        }

        .ftype-img {
            --file-bg: #edf7f2;
            --file-fold: #9de4c3;
            --file-color: #1a7a56;
            --file-badge-bg: rgba(255, 255, 255, .9)
        }

        .ftype-doc {
            --file-bg: #eef4fb;
            --file-fold: #a8ccf0;
            --file-color: #1a56a0;
            --file-badge-bg: rgba(255, 255, 255, .9)
        }

        .ftype-xls {
            --file-bg: #edf7f2;
            --file-fold: #8dd8b2;
            --file-color: #1a7a56;
            --file-badge-bg: rgba(255, 255, 255, .9)
        }

        .ftype-other {
            --file-bg: #eef2f7;
            --file-fold: #c8d3e0;
            --file-color: #4a5568;
            --file-badge-bg: rgba(255, 255, 255, .9)
        }

        .berkas-label {
            font-size: .68rem;
            font-weight: 700;
            color: var(--ink);
            text-transform: uppercase;
            line-height: 1.3;
            word-break: break-word
        }

        .no-berkas {
            text-align: center;
            padding: 30px;
            color: var(--muted)
        }

        .no-berkas i {
            display: block;
            font-size: 1.8rem;
            margin-bottom: 8px;
            opacity: .3
        }

        /* skeleton */
        .skeleton {
            background: linear-gradient(90deg, var(--bg) 25%, var(--line) 50%, var(--bg) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 7px
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0
            }

            100% {
                background-position: -200% 0
            }
        }

        .sk-line {
            height: 13px;
            margin-bottom: 9px
        }

        .sk-short {
            width: 55%
        }

        .sk-med {
            width: 78%
        }

        .sk-full {
            width: 100%
        }

        /* PDF MODAL */
        .pdfmodal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 32, .75);
            backdrop-filter: blur(6px);
            z-index: 700;
            align-items: center;
            justify-content: center;
            padding: 20px
        }

        .pdfmodal-backdrop.open {
            display: flex
        }

        .pdfmodal {
            background: var(--ink);
            border-radius: 16px;
            width: min(900px, 100%);
            height: min(88vh, 800px);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .5);
            animation: modalIn .3s cubic-bezier(.22, 1, .36, 1) both
        }

        .pdfmodal-topbar {
            padding: 13px 18px;
            background: rgba(255, 255, 255, .06);
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            gap: 10px
        }

        .pdfmodal-title {
            font-size: .85rem;
            font-weight: 600;
            color: #fff;
            flex: 1
        }

        .pdfmodal-close {
            background: rgba(255, 255, 255, .1);
            border: none;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: .82rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s
        }

        .pdfmodal-close:hover {
            background: rgba(255, 255, 255, .2)
        }

        .pdfmodal-frame {
            flex: 1;
            border: none;
            background: #333
        }

        @media(max-width:768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .info-grid {
                grid-template-columns: 1fr
            }

            .status-options {
                grid-template-columns: 1fr
            }
        }

        @media(max-width:480px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr
            }

            .berkas-grid {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        .ext-filter-row {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .export-btn {

            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;

            border-radius: 10px;

            background: #16a34a;
            color: #fff;

            text-decoration: none;

            font-weight: 600;

            transition: .25s ease;
        }

        .export-btn:hover {

            background: #15803d;

            color: #fff;

            transform: translateY(-2px);

        }
    </style>
@endpush

@section('content')

    @php
        $all = $pelamars->count();
        $pending = $pelamars->where('status_pelamar', 'pending')->count();
        $diterima = $pelamars->where('status_pelamar', 'diterima')->count();
        $ditolak = $pelamars->where('status_pelamar', 'ditolak')->count();
    @endphp

    <div class="stats-grid">
        <div class="stat-card" data-filter="">
            <div class="stat-icon all"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-num">{{ $all }}</div>
                <div class="stat-lbl">Total Pelamar</div>
            </div>
        </div>
        <div class="stat-card" data-filter="pending">
            <div class="stat-icon pending"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-num">{{ $pending }}</div>
                <div class="stat-lbl">Menunggu Keputusan</div>
            </div>
        </div>
        <div class="stat-card" data-filter="diterima">
            <div class="stat-icon diterima"><i class="fa-solid fa-user-check"></i></div>
            <div>
                <div class="stat-num">{{ $diterima }}</div>
                <div class="stat-lbl">Diterima</div>
            </div>
        </div>
        <div class="stat-card" data-filter="ditolak">
            <div class="stat-icon ditolak"><i class="fa-solid fa-user-xmark"></i></div>
            <div>
                <div class="stat-num">{{ $ditolak }}</div>
                <div class="stat-lbl">Ditolak</div>
            </div>
        </div>
    </div>

    <div class="ext-filter-row">

        {{-- FILTER POSISI --}}
        <select class="filter-select" id="posisiFilter" onchange="applyFilter()">

            <option value="">
                Semua Posisi
            </option>

            @foreach ($posisis as $posisi)
                <option value="{{ $posisi->id }}" {{ request('id_posisi') == $posisi->id ? 'selected' : '' }}>

                    {{ $posisi->nama_posisi }}

                </option>
            @endforeach

        </select>

        {{-- FILTER STATUS --}}
        <select class="filter-select" id="statusFilter" onchange="applyFilter()">

            <option value="">
                Semua Status
            </option>

            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>

                Pending

            </option>

            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>

                Diterima

            </option>

            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>

                Ditolak

            </option>

        </select>

        {{-- BUTTON EXPORT EXCEL --}}
        <a href="{{ route('pelamar.export', [
            'id_posisi' => request('id_posisi'),

            'status' => request('status'),
        ]) }}"
            class="export-btn">

            <i class="fa-solid fa-file-excel"></i>

        </a>

    </div>

    <div class="table-wrap">
        <table id="pelamarTable" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelamar</th>
                    <th>Posisi</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelamars as $i => $p)
                    @php
                        $initials = strtoupper(
                            substr($p->nama ?? 'P', 0, 1) . substr(explode(' ', $p->nama ?? 'P ')[1] ?? '', 0, 1),
                        );

                        $canValidate = $p->status_pelamar === 'pending';
                    @endphp

                    <tr data-status="{{ $p->status_pelamar }}">
                        <td style="color:var(--muted);font-size:.75rem">
                            {{ $i + 1 }}
                        </td>

                        <td>
                            <div class="td-name">
                                <div class="avatar-circle">{{ $initials }}</div>

                                <div>
                                    <div class="td-name-primary">{{ $p->nama }}</div>
                                    <div class="td-name-secondary">{{ $p->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td style="font-size:.82rem;color:var(--ink2)">
                            {{ $p->posisi->nama_posisi ?? '-' }}
                        </td>

                        <td style="font-size:.75rem;color:var(--muted)">
                            {{ $p->created_at->format('d M Y') }}<br>

                            <span style="font-size:.7rem">
                                {{ $p->created_at->diffForHumans() }}
                            </span>
                        </td>

                        <td>
                            <span class="badge {{ $p->status_pelamar }}">
                                <span class="badge-dot"></span>

                                {{ str_replace('_', ' ', ucwords($p->status_pelamar, '_')) }}
                            </span>
                        </td>

                        <td>
                            <div style="display:flex;gap:6px;flex-wrap:wrap">

                                @if ($canValidate)
                                    <button class="btn-action btn-validasi"
                                        onclick="openValidasi('{{ $p->token }}','{{ addslashes($p->nama) }}','{{ $p->posisi->nama_posisi ?? '-' }}','{{ $p->status_pelamar }}')">

                                        <i class="fa-solid fa-stamp"></i>
                                        Validasi
                                    </button>
                                @else
                                    <span class="btn-action btn-final">
                                        <i class="fa-solid fa-lock"></i>
                                        Final
                                    </span>
                                @endif

                                <button class="btn-action btn-detail" onclick="openDetail('{{ $p->token }}')">

                                    <i class="fa-solid fa-eye"></i>
                                    Detail
                                </button>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- ══════════  MODAL VALIDASI  ══════════ --}}
    <div class="modal-backdrop" id="modalValidasi">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-header-title">Keputusan Pelamar</div>
                    <div class="modal-header-sub">Tentukan status akhir pelamar ini</div>
                </div>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-pelamar-info">
                    <div class="modal-avatar" id="mAvatar">P</div>
                    <div>
                        <div class="modal-pelamar-name" id="mNama">—</div>
                        <div class="modal-pelamar-meta" id="mPosisi">—</div>
                    </div>
                    <div class="current-status">
                        <span class="badge pending" id="mCurrentBadge"><span class="badge-dot"></span> Pending</span>
                    </div>
                </div>
                <div class="flow-steps">
                    <div class="flow-step done"><i class="fa-solid fa-circle-dot"></i> Pending</div>
                    <span class="flow-arrow"><i class="fa-solid fa-chevron-right"></i></span>
                    <div class="flow-step current"><i class="fa-solid fa-circle-dot"></i> Keputusan Akhir</div>
                </div>
                <label class="form-label-sm">Tentukan Keputusan</label>
                <div class="status-options">
                    <div>
                        <input type="radio" class="status-option" name="next_status" id="so_diterima"
                            value="diterima">
                        <label for="so_diterima" class="status-label sl-diterima">
                            <div class="sl-icon"><i class="fa-solid fa-user-check"></i></div> Diterima
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="status-option" name="next_status" id="so_ditolak" value="ditolak">
                        <label for="so_ditolak" class="status-label sl-ditolak">
                            <div class="sl-icon"><i class="fa-solid fa-user-xmark"></i></div> Ditolak
                        </label>
                    </div>
                </div>
                <label class="form-label-sm" for="catatanInput">Catatan (wajib)</label>
                <textarea class="catatan-input" id="catatanInput" placeholder="Tambahkan alasan atau catatan..." required></textarea>
                <div class="modal-footer">
                    <button class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button class="btn-submit" id="btnSubmitValidasi" onclick="submitValidasi()">
                        <span class="spin" id="submitSpin"></span>
                        <i class="fa-solid fa-gavel" id="submitIcon"></i>
                        Simpan Keputusan
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════  MODAL DETAIL  ══════════ --}}
    <div class="detail-backdrop" id="detailModal">
        <div class="detail-modal">

            <div class="detail-header">
                <div class="dh-avatar" id="dAvatar">?</div>
                <div class="dh-info">
                    <div class="dh-name" id="dNama">Memuat...</div>
                    <div class="dh-chips" id="dChips"></div>
                </div>
                <button class="dh-close" onclick="closeDetail()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="dm-tabs">
                <button class="dm-tab active" onclick="switchDmTab('info')" id="dt-info">
                    <i class="fa-solid fa-id-card"></i> Informasi
                </button>
                <button class="dm-tab" onclick="switchDmTab('akun')" id="dt-akun">
                    <i class="fa-solid fa-key"></i> Akun & Password
                </button>
                <button class="dm-tab" onclick="switchDmTab('berkas')" id="dt-berkas">
                    <i class="fa-solid fa-folder-open"></i> Berkas
                </button>
            </div>

            <div class="dm-body">
                <div class="dm-pane active" id="dp-info">
                    <div id="dmInfoContent">{{ '<!-- skeleton -->' }}</div>
                </div>
                <div class="dm-pane" id="dp-akun">
                    <div id="dmAkunContent">{{ '<!-- skeleton -->' }}</div>
                </div>
                <div class="dm-pane" id="dp-berkas">
                    <div id="dmBerkasContent">{{ '<!-- skeleton -->' }}</div>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════  PDF VIEWER  ══════════ --}}
    <div class="pdfmodal-backdrop" id="pdfModal">
        <div class="pdfmodal">
            <div class="pdfmodal-topbar">
                <i class="fa-solid fa-file-pdf" style="color:#e74c3c"></i>
                <div class="pdfmodal-title" id="pdfTitle">Dokumen</div>
                <a id="pdfDownload" href="#" target="_blank"
                    style="color:rgba(255,255,255,.55);font-size:.78rem;text-decoration:none;margin-right:8px">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka baru
                </a>
                <button class="pdfmodal-close" onclick="closePdf()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <iframe class="pdfmodal-frame" id="pdfFrame" src="about:blank"></iframe>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.all.min.js"></script>

    <script>
        // ─── DATATABLES ───────────────────────────────────────────────
        let dtTable;
        $(document).ready(function() {
            dtTable = $('#pelamarTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    emptyTable: "Belum ada data pelamar",
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ pelamar',
                    infoEmpty: 'Tidak ada data',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    },
                    emptyTable: 'Belum ada data pelamar',
                    zeroRecords: 'Data tidak ditemukan',
                },
                columnDefs: [{
                    orderable: false,
                    targets: [5]
                }, {
                    searchable: false,
                    targets: [0, 5]
                }],
                order: [
                    [3, 'desc']
                ],
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
            });

            $('#statusFilter').on('change', function() {
                const val = this.value;
                $.fn.dataTable.ext.search = [];
                if (val !== '') {
                    $.fn.dataTable.ext.search.push((s, d, i) =>
                        $(dtTable.row(i).node()).data('status') === val);
                }
                dtTable.draw();
            });

            document.querySelectorAll('.stat-card[data-filter]').forEach(c => {
                c.addEventListener('click', () =>
                    $('#statusFilter').val(c.dataset.filter).trigger('change'));
            });
        });

        // ─── VALIDASI MODAL ───────────────────────────────────────────
        let _token;

        function openValidasi(token, nama, posisi) {
            _token = token;
            document.getElementById('mAvatar').textContent = nama.split(' ').map(w => w[0]).join('').substring(0, 2)
                .toUpperCase();
            document.getElementById('mNama').textContent = nama;
            document.getElementById('mPosisi').textContent = posisi + ' · Status: pending';
            document.getElementById('catatanInput').value = '';
            document.querySelectorAll('input[name="next_status"]').forEach(r => r.checked = false);
            showBd('modalValidasi');
        }

        function closeModal() {
            hideBd('modalValidasi');
        }

        async function submitValidasi() {
            const sel = document.querySelector('input[name="next_status"]:checked');
            if (!sel) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Keputusan',
                    text: 'Tentukan apakah pelamar diterima atau ditolak.',
                    confirmButtonColor: '#0d7a6e'
                });
                return;
            }
            const btn = document.getElementById('btnSubmitValidasi');
            setLoading(btn, true, 'submitSpin', 'submitIcon');
            try {
                const res = await post(`/pelamar/validasi/${_token}`, {
                    status_pelamar: sel.value,
                    catatan: document.getElementById('catatanInput').value
                });
                const data = await res.json();
                if (data.success) {
                    closeModal();
                    if (typeof showToast === 'function') showToast(data.message, 'success');
                    setTimeout(() => location.reload(), 1100);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan.',
                        confirmButtonColor: '#0d7a6e'
                    });
                }
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Tidak dapat terhubung ke server.',
                    confirmButtonColor: '#0d7a6e'
                });
            } finally {
                setLoading(btn, false, 'submitSpin', 'submitIcon');
            }
        }
        document.getElementById('modalValidasi').addEventListener('click', e => {
            if (e.target === document.getElementById('modalValidasi')) closeModal();
        });

        // ─── DETAIL MODAL ─────────────────────────────────────────────
        let _detailToken = null;
        let _pwVisible = false;

        function openDetail(token) {
            _detailToken = token;
            _pwVisible = false;
            document.getElementById('dAvatar').textContent = '?';
            document.getElementById('dNama').textContent = 'Memuat...';
            document.getElementById('dChips').innerHTML = '';
            ['Info', 'Akun', 'Berkas'].forEach(t =>
                document.getElementById('dmInfoContent'.replace('Info', t) || `dm${t}Content`).innerHTML = skelHtml()
            );
            document.getElementById('dmInfoContent').innerHTML = skelHtml();
            document.getElementById('dmAkunContent').innerHTML = skelHtml();
            document.getElementById('dmBerkasContent').innerHTML = skelHtml();
            switchDmTab('info');
            showBd('detailModal');

            $.ajax({
                url: `/pelamar/detail/${token}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: res => res.success ? renderDetail(res.data) : (document.getElementById('dmInfoContent')
                    .innerHTML = errHtml(res.message)),
                error: () => {
                    document.getElementById('dmInfoContent').innerHTML = errHtml(
                        'Terjadi kesalahan, coba lagi.');
                }
            });
        }

        function renderDetail(p) {
            const ini = (p.nama || 'P').split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
            document.getElementById('dAvatar').textContent = ini;
            document.getElementById('dNama').textContent = p.nama || '-';
            document.getElementById('dChips').innerHTML = `
        <span class="dh-chip"><i class="fa-solid fa-briefcase"></i> ${esc(p.posisi_nama||'-')}</span>
        <span class="dh-chip"><i class="fa-solid fa-id-badge"></i> ${esc(p.nomer_peserta||'No. Peserta —')}</span>
        <span class="dh-chip">${(p.status_pelamar||'-').replace(/_/g,' ')}</span>`;

            // ── Tab INFO ──────────────────────────────────────
            document.getElementById('dmInfoContent').innerHTML = `
        <div class="ds-title"><i class="fa-solid fa-user"></i> Data Pribadi</div>
        <div class="info-grid">
            ${ii('Nama Lengkap',p.nama)} ${ii('NIK',p.nik)}
            ${ii('No. HP',p.no_hp)} ${ii('Email',p.email)}
            ${ii('Jenis Kelamin',p.jenis_kelamin)} ${ii('Kota Domisili',p.kota_domisili)}
            ${ii('Jenjang',p.jenjang)} ${ii('Jenis Pelamar',p.jenis_pelamar)}
            ${ii('Rumah Sakit Yang Dipilih',p.nama_rs)}
            ${ii('Tempat Lahir',p.tempat_lahir)} ${ii('Tanggal Lahir',p.tanggal_lahir)}
            ${ii('Usia',p.usia)}
            ${ii('No. STR',p.no_str,true)} ${ii('Alamat',p.alamat,true)}
        </div>
        <div class="ds-title" style="margin-top:18px"><i class="fa-solid fa-briefcase"></i> Pengalaman</div>
        <div class="info-grid">
            ${ii('Pengalaman',p.pengalaman_kerja)} ${ii('Keterangan',p.keterangan_pengalaman)}
        </div>
        ${p.catatan ? `<div class="ds-title" style="margin-top:18px"><i class="fa-solid fa-note-sticky"></i> Catatan Admin</div>
                                        <div class="info-grid">${ii('Catatan',p.catatan,true)}</div>` : ''}
        <div class="ds-title" style="margin-top:18px"><i class="fa-solid fa-clock"></i> Waktu</div>
        <div class="info-grid">${ii('Terdaftar',p.created_at)} ${ii('Diperbarui',p.updated_at)}</div>`;

            // ── Tab AKUN + RESET PASSWORD ─────────────────────
            document.getElementById('dmAkunContent').innerHTML = `
        <div class="ds-title"><i class="fa-solid fa-circle-user"></i> Informasi Akun</div>
        <div class="info-grid">
            ${ii('Username',p.username)} ${ii('Email Login',p.email)}
            <div class="info-item">
                <div class="info-key">Password</div>
                <div class="info-val" style="margin-top:4px">
                    <div class="pw-wrap">
                        <span class="pw-mask" id="pwMask">••••••••</span>
                        <span style="font-size:.72rem;color:var(--muted);font-style:italic">Terenkripsi</span>
                    </div>
                </div>
            </div>
            ${ii('No. Peserta',p.nomer_peserta)}
            ${ii('Status',p.status_pelamar)} ${ii('Posisi',p.posisi_nama)}
        </div>

        <div class="ds-title" style="margin-top:20px"><i class="fa-solid fa-lock-open"></i> Reset Password</div>

        <div class="reset-pw-card">
            <div class="reset-pw-card-header">
                <div class="reset-pw-card-icon"><i class="fa-solid fa-key"></i></div>
                <div>
                    <div class="reset-pw-card-title">Atur Ulang Password Pelamar</div>
                    <div class="reset-pw-card-sub">Masukkan password baru atau generate otomatis</div>
                </div>
            </div>
            <div class="reset-pw-card-body">

                <label class="form-label-sm" style="margin-bottom:6px">Password Baru</label>
                <div class="pw-input-wrap">
                    <input type="password" id="newPwInput" placeholder="Min. 8 karakter" oninput="checkPwStrength(this.value)">
                    <button type="button" class="pw-eye-btn" onclick="toggleNewPwEye(this)">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwStrengthFill"></div></div>
                <div class="pw-strength-text" id="pwStrengthText">Masukkan password</div>

                <div class="pw-requirements" id="pwReqs">
                    <div class="pw-req-item" id="req-len"><i class="fa-solid fa-circle"></i> Minimal 8 karakter</div>
                    <div class="pw-req-item" id="req-upper"><i class="fa-solid fa-circle"></i> Mengandung huruf kapital (A-Z)</div>
                    <div class="pw-req-item" id="req-num"><i class="fa-solid fa-circle"></i> Mengandung angka (0-9)</div>
                    <div class="pw-req-item" id="req-sym"><i class="fa-solid fa-circle"></i> Mengandung simbol (!@#$...)</div>
                </div>

                <button type="button" class="pw-generate-btn" onclick="generatePassword()">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Password Otomatis
                </button>

                <div class="pw-actions">
                    <button type="button" class="btn-pw-reset" id="btnResetPw" onclick="submitResetPassword()">
                        <span class="spin" id="resetPwSpin"></span>
                        <i class="fa-solid fa-rotate" id="resetPwIcon"></i>
                        Reset Password
                    </button>
                </div>

                <div class="pw-result-box" id="pwResultBox">
                    <div class="pw-result-title"><i class="fa-solid fa-circle-check"></i> Password berhasil direset!</div>
                    <div style="font-size:.75rem;color:var(--ink2);margin-bottom:4px">Password baru pelamar:</div>
                    <div class="pw-result-newpw">
                        <span id="pwResultValue" style="letter-spacing:1px">—</span>
                        <button class="pw-result-copy" onclick="copyNewPw()">
                            <i class="fa-solid fa-copy"></i> Salin
                        </button>
                    </div>
                    <div style="font-size:.7rem;color:var(--muted);margin-top:8px">
                        <i class="fa-solid fa-triangle-exclamation" style="color:var(--amber)"></i>
                        Catat dan bagikan password ini ke pelamar. Password tidak dapat ditampilkan lagi setelah modal ditutup.
                    </div>
                </div>

            </div>
        </div>

        <div style="background:#fef9ec;border:1px solid #fde68a;border-radius:10px;padding:11px 14px;font-size:.76rem;color:#92400e;display:flex;gap:9px;align-items:flex-start;margin-top:14px">
            <i class="fa-solid fa-triangle-exclamation" style="flex-shrink:0;margin-top:1px"></i>
            <span>Reset password hanya boleh dilakukan oleh Admin IT yang berwenang. Setelah direset, pelamar harus login ulang menggunakan password baru.</span>
        </div>`;

            // ── Tab BERKAS ────────────────────────────────────
            const files = p.files || [];
            document.getElementById('dmBerkasContent').innerHTML = files.length ?
                `<div class="berkas-grid">${files.map(f => berkasCard(f)).join('')}</div>` :
                `<div class="no-berkas"><i class="fa-solid fa-folder-open"></i><p>Belum ada berkas diunggah</p></div>`;
        }

        // ─── BERKAS CARD — icon berdasarkan ekstensi ──────────────────
        function berkasCard(f) {
            const path = (f.file_path || '').toLowerCase();
            const jenis = (f.jenis_file || '').toLowerCase();
            const ext = path.split('.').pop() || '';

            let typeClass, iconClass, badgeLabel;

            if (['pdf'].includes(ext)) {
                typeClass = 'ftype-pdf';
                iconClass = 'fa-solid fa-file-pdf';
                badgeLabel = 'PDF';
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext)) {
                typeClass = 'ftype-img';
                iconClass = 'fa-solid fa-file-image';
                badgeLabel = ext.toUpperCase();
            } else if (['doc', 'docx'].includes(ext)) {
                typeClass = 'ftype-doc';
                iconClass = 'fa-solid fa-file-word';
                badgeLabel = 'DOCX';
            } else if (['xls', 'xlsx', 'csv'].includes(ext)) {
                typeClass = 'ftype-xls';
                iconClass = 'fa-solid fa-file-excel';
                badgeLabel = ext.toUpperCase();
            } else {
                typeClass = 'ftype-other';
                iconClass = 'fa-solid fa-file';
                badgeLabel = ext.toUpperCase() || 'FILE';
            }

            return `
        <div class="berkas-card" onclick="viewFile(${f.id},'${esc(f.jenis_file)}','${esc(ext)}')">
            <div class="berkas-icon-wrap ${typeClass}">
                <i class="${iconClass} file-icon-main"></i>
                <span class="file-type-badge">${badgeLabel}</span>
            </div>
            <div class="berkas-label">${esc(f.jenis_file||'').replace(/_/g,' ')}</div>
        </div>`;
        }

        // ─── VIEW FILE (PDF di iframe, gambar di tab baru) ────────────
        function viewFile(id, jenis, ext) {
            const url = `/file/view/${id}`;
            const imgs = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];
            if (imgs.includes((ext || '').toLowerCase())) {
                // buka gambar di tab baru
                window.open(url, '_blank');
            } else {
                // buka di PDF modal
                document.getElementById('pdfFrame').src = url;
                document.getElementById('pdfTitle').textContent = 'Dokumen ' + (jenis || '').toUpperCase();
                document.getElementById('pdfDownload').href = url;
                showBd('pdfModal');
            }
        }

        function switchDmTab(tab) {
            document.querySelectorAll('.dm-pane').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.dm-tab').forEach(t => t.classList.remove('active'));
            document.getElementById('dp-' + tab).classList.add('active');
            document.getElementById('dt-' + tab).classList.add('active');
        }

        function closeDetail() {
            hideBd('detailModal');
        }
        document.getElementById('detailModal').addEventListener('click', e => {
            if (e.target === document.getElementById('detailModal')) closeDetail();
        });

        // ─── RESET PASSWORD LOGIC ─────────────────────────────────────
        const CHARSET_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const CHARSET_LOWER = 'abcdefghijklmnopqrstuvwxyz';
        const CHARSET_NUM = '0123456789';
        const CHARSET_SYM = '!@#$%^&*()_+-=[]{}';

        function checkPwStrength(val) {
            const hasLen = val.length >= 8;
            const hasUpper = /[A-Z]/.test(val);
            const hasNum = /[0-9]/.test(val);
            const hasSym = /[!@#$%^&*()\-_=+\[\]{}|;:'",.<>?/`~\\]/.test(val);

        const toggle = (id, ok) => {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.toggle('ok', ok);
            el.querySelector('i').className = ok ? 'fa-solid fa-check' : 'fa-solid fa-circle';
        };
        toggle('req-len', hasLen);
        toggle('req-upper', hasUpper);
        toggle('req-num', hasNum);
        toggle('req-sym', hasSym);

        const score = [hasLen, hasUpper, hasNum, hasSym].filter(Boolean).length;
        const fill = document.getElementById('pwStrengthFill');
        const text = document.getElementById('pwStrengthText');
        const info = [{
                w: '0%',
                bg: 'var(--line)',
                label: 'Masukkan password'
            },
            {
                w: '25%',
                bg: 'var(--red)',
                label: 'Sangat lemah'
            },
            {
                w: '50%',
                bg: 'var(--amber)',
                label: 'Lemah'
            },
            {
                w: '75%',
                bg: '#3b82f6',
                label: 'Sedang'
            },
            {
                w: '100%',
                bg: 'var(--green)',
                label: 'Kuat'
            },
        ];
        const idx = val.length === 0 ? 0 : score;
        if (fill) {
            fill.style.width = info[idx].w;
            fill.style.background = info[idx].bg;
        }
        if (text) text.textContent = info[idx].label;
    }

    function toggleNewPwEye(btn) {
        const inp = document.getElementById('newPwInput');
        if (!inp) return;
        const isText = inp.type === 'text';
        inp.type = isText ? 'password' : 'text';
        btn.querySelector('i').className = isText ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
    }

    function generatePassword() {
        const pool = CHARSET_LOWER + CHARSET_UPPER + CHARSET_NUM + CHARSET_SYM;
        // pastikan minimal 1 dari tiap jenis
        let pw = '';
        pw += CHARSET_UPPER[Math.floor(Math.random() * CHARSET_UPPER.length)];
        pw += CHARSET_LOWER[Math.floor(Math.random() * CHARSET_LOWER.length)];
        pw += CHARSET_NUM[Math.floor(Math.random() * CHARSET_NUM.length)];
        pw += CHARSET_SYM[Math.floor(Math.random() * CHARSET_SYM.length)];
        for (let i = 4; i < 12; i++) pw += pool[Math.floor(Math.random() * pool.length)];
        // shuffle
        pw = pw.split('').sort(() => Math.random() - 0.5).join('');

        const inp = document.getElementById('newPwInput');
        if (inp) {
            inp.value = pw;
            inp.type = 'text';
            checkPwStrength(pw);
            // eye icon jadi hide
            const eyeBtn = inp.parentElement.querySelector('.pw-eye-btn i');
            if (eyeBtn) eyeBtn.className = 'fa-solid fa-eye-slash';
        }
    }

    async function submitResetPassword() {
        const inp = document.getElementById('newPwInput');
        if (!inp) return;
        const pw = inp.value.trim();

        if (pw.length < 8) {
            Swal.fire({
                icon: 'warning',
                title: 'Password Terlalu Pendek',
                text: 'Password minimal 8 karakter.',
                confirmButtonColor: '#0d7a6e'
            });
            inp.classList.add('error-input');
            return;
        }
        inp.classList.remove('error-input');

        const confirmed = await Swal.fire({
            icon: 'question',
            title: 'Konfirmasi Reset Password',
            html: `Apakah Anda yakin ingin mereset password pelamar <strong>${esc(document.getElementById('dNama').textContent)}</strong>?<br><br>Password baru tidak dapat dipulihkan ke semula.`,
            showCancelButton: true,
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#0d7a6e',
            cancelButtonColor: '#aaa',
        });
        if (!confirmed.isConfirmed) return;

        const btn = document.getElementById('btnResetPw');
        setLoading(btn, true, 'resetPwSpin', 'resetPwIcon');

        try {
            const res = await post(`/pelamar/reset-password/${_detailToken}`, {
                password: pw
            });
            const data = await res.json();

            if (data.success) {
                // tampilkan result box
                document.getElementById('pwResultBox').classList.add('show');
                document.getElementById('pwResultValue').textContent = pw;
                inp.value = '';
                checkPwStrength('');
                Swal.fire({
                    icon: 'success',
                    title: 'Password Direset!',
                    text: 'Password baru telah berhasil disimpan.',
                    confirmButtonColor: '#0d7a6e'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message || 'Terjadi kesalahan.',
                    confirmButtonColor: '#0d7a6e'
                });
            }
        } catch (e) {
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Tidak dapat terhubung ke server.',
                confirmButtonColor: '#0d7a6e'
            });
        } finally {
            setLoading(btn, false, 'resetPwSpin', 'resetPwIcon');
        }
    }

    function copyNewPw() {
        const val = document.getElementById('pwResultValue')?.textContent || '';
        if (!val || val === '—') return;
        navigator.clipboard.writeText(val).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Tersalin!',
                text: 'Password berhasil disalin ke clipboard.',
                timer: 1500,
                showConfirmButton: false
            });
        });
    }

    // ─── PDF VIEWER ───────────────────────────────────────────────
    function closePdf() {
        document.getElementById('pdfModal').classList.remove('open');
        document.getElementById('pdfFrame').src = 'about:blank';
        document.body.style.overflow = '';
    }
    document.getElementById('pdfModal').addEventListener('click', e => {
        if (e.target === document.getElementById('pdfModal')) closePdf();
    });

    function showBd(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function hideBd(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeModal();
            closeDetail();
            closePdf();
        }
    });

    async function post(url, body) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(body),
        });
    }

    function setLoading(btn, on, spinId, iconId) {
        btn.disabled = on;
        btn.classList.toggle('loading', on);
        document.getElementById(spinId).style.display = on ? 'block' : 'none';
        document.getElementById(iconId).style.display = on ? 'none' : '';
    }

    function ii(label, val, full = false) {
        const empty = !val || val === 'null' || val === '-' || String(val).trim() === '';
        return `<div class="info-item${full?' full':''}">
                                        <div class="info-key">${label}</div>
                                        <div class="info-val${empty?' empty':''}">${empty ? '—' : esc(String(val))}</div>
                                    </div>`;
    }

    function skelHtml() {
        return `<div style="padding:4px 0">
                                        <div class="skeleton sk-line sk-med"></div>
                                        <div class="skeleton sk-line sk-short"></div>
                                        <div class="skeleton sk-line sk-full"></div>
                                    </div>`;
    }

    function errHtml(msg) {
        return `<p style="text-align:center;padding:30px;color:var(--red)">
                                        <i class="fa-solid fa-circle-exclamation"></i> ${msg}</p>`;
        }

        function esc(s) {
            return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g,
                '&quot;');
        }

        function applyFilter() {

            const posisi =
                document.getElementById(
                    'posisiFilter'
                ).value;

            const status =
                document.getElementById(
                    'statusFilter'
                ).value;

            const params = new URLSearchParams();

            if (posisi) {
                params.set(
                    'id_posisi',
                    posisi
                );
            }

            if (status) {
                params.set(
                    'status',
                    status
                );
            }

            window.location =
                '?' + params.toString();
        }
    </script>
@endpush
