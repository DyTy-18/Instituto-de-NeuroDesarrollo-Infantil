@extends('layouts.app')

@section('title', 'Admin — Pacientes registrados')

@section('styles')
<style>
    body { background: var(--gray-100); min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 12px rgba(41, 171, 226, .25);
    }
    .topbar h1 {
        font-family: var(--font-title);
        color: var(--white);
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .topbar a.btn-outline {
        font-family: var(--font-ui);
        font-size: .82rem;
        font-weight: 600;
        color: var(--white);
        border: 2px solid rgba(255,255,255,.5);
        padding: .4rem .9rem;
        border-radius: 99px;
        text-decoration: none;
        transition: background .2s;
    }
    .topbar a.btn-outline:hover { background: rgba(255,255,255,.15); }

    .main { padding: 2rem; max-width: 1200px; margin: 0 auto; }

    /* ── Stats ── */
    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--white);
        border-radius: 16px;
        padding: 1.2rem 1.4rem;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .stat-card .icon {
        font-size: 2rem;
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
    }
    .stat-card:nth-child(1) .icon { background: var(--sky-100); }
    .stat-card:nth-child(2) .icon { background: #FFF8E1; }
    .stat-card:nth-child(3) .icon { background: #F3F0FF; }
    .stat-card .info .num {
        font-family: var(--font-ui);
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--sky-700);
        line-height: 1;
    }
    .stat-card .info .lbl {
        font-family: var(--font-ui);
        font-size: .78rem;
        color: var(--gray-500);
        margin-top: .2rem;
    }

    /* ── Filtros ── */
    .filters {
        background: var(--white);
        border-radius: 16px;
        padding: 1.2rem 1.4rem;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        margin-bottom: 1.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }
    .filters .field { display: flex; flex-direction: column; gap: .35rem; flex: 1; min-width: 160px; }
    .filters label { font-family: var(--font-ui); font-size: .78rem; font-weight: 600; color: var(--sky-700); }
    .filters input,
    .filters select {
        padding: .6rem .9rem;
        border: 2px solid var(--gray-200);
        border-radius: 10px;
        font-family: var(--font-ui);
        font-size: .88rem;
        color: var(--gray-800);
        background: var(--gray-50);
        appearance: none;
    }
    .filters input:focus, .filters select:focus {
        outline: none; border-color: var(--sky-500);
        box-shadow: 0 0 0 3px rgba(41,171,226,.1);
    }
    .btn-filter {
        padding: .6rem 1.4rem;
        background: var(--sky-500);
        color: var(--white);
        border: none;
        border-radius: 10px;
        font-family: var(--font-ui);
        font-size: .88rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s;
        align-self: flex-end;
    }
    .btn-filter:hover { background: var(--sky-700); }
    .btn-clear {
        padding: .6rem 1rem;
        background: transparent;
        color: var(--gray-500);
        border: 2px solid var(--gray-200);
        border-radius: 10px;
        font-family: var(--font-ui);
        font-size: .88rem;
        cursor: pointer;
        text-decoration: none;
        align-self: flex-end;
        display: inline-flex;
        align-items: center;
    }

    /* ── Tabla ── */
    .table-wrap {
        background: var(--white);
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: var(--sky-700); }
    thead th {
        padding: .9rem 1rem;
        text-align: left;
        font-family: var(--font-ui);
        font-size: .78rem;
        font-weight: 600;
        color: var(--white);
        letter-spacing: .05em;
        text-transform: uppercase;
    }
    tbody tr { border-bottom: 1px solid var(--gray-100); transition: background .15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--sky-100); }
    tbody td {
        padding: .85rem 1rem;
        font-family: var(--font-ui);
        font-size: .88rem;
        color: var(--gray-700);
    }
    .badge-esp {
        display: inline-block;
        padding: .25rem .7rem;
        border-radius: 99px;
        font-size: .75rem;
        font-weight: 700;
        font-family: var(--font-ui);
    }
    .badge-fono  { background: var(--sky-100); color: var(--sky-700); }
    .badge-psico { background: #FFF8E1; color: #B45309; }

    .btn-ver {
        font-family: var(--font-ui);
        font-size: .8rem;
        font-weight: 600;
        color: var(--sky-700);
        text-decoration: none;
        padding: .3rem .7rem;
        border: 1.5px solid var(--sky-300);
        border-radius: 8px;
        transition: background .15s;
    }
    .btn-ver:hover { background: var(--sky-100); }

    /* ── Paginación ── */
    .pagination { display: flex; justify-content: center; gap: .4rem; padding: 1.2rem; }
    .pagination a, .pagination span {
        font-family: var(--font-ui);
        font-size: .85rem;
        padding: .45rem .85rem;
        border-radius: 8px;
        text-decoration: none;
        color: var(--sky-700);
        border: 1.5px solid var(--gray-200);
        transition: background .15s;
    }
    .pagination a:hover { background: var(--sky-100); }
    .pagination .active span {
        background: var(--sky-500);
        color: var(--white);
        border-color: var(--sky-500);
    }
    .pagination .disabled span { color: var(--gray-200); border-color: var(--gray-100); cursor: default; }

    .empty {
        text-align: center;
        padding: 3rem;
        font-family: var(--font-ui);
        color: var(--gray-500);
    }
    .empty .empty-icon { font-size: 3rem; margin-bottom: .5rem; }

    @media (max-width: 768px) {
        .stats { grid-template-columns: 1fr; }
        .main { padding: 1rem; }
        .topbar { padding: .8rem 1rem; }
        table { font-size: .8rem; }
        thead th, tbody td { padding: .7rem .6rem; }
    }
</style>
@endsection

@section('content')
<div class="topbar">
    <h1>🩺 Panel — Pacientes</h1>
    <a href="{{ route('formulario') }}" class="btn-outline">← Ver formulario</a>
</div>

<div class="main">
    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="icon">👨‍👩‍👧</div>
            <div class="info">
                <div class="num">{{ $total }}</div>
                <div class="lbl">Total registros</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon">🗣️</div>
            <div class="info">
                <div class="num">{{ $totalFono }}</div>
                <div class="lbl">Fonoaudiología</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon">🤸</div>
            <div class="info">
                <div class="num">{{ $totalPsico }}</div>
                <div class="lbl">Psicomotricidad</div>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <form class="filters" method="GET" action="{{ route('admin.pacientes') }}">
        <div class="field">
            <label>Buscar</label>
            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Nombre del niño o tutor…">
        </div>
        <div class="field" style="max-width:200px;">
            <label>Especialidad</label>
            <select name="especialidad">
                <option value="">Todas</option>
                <option value="fonoaudiologia"   @selected(request('especialidad') === 'fonoaudiologia')>Fonoaudiología</option>
                <option value="psicomotricidad" @selected(request('especialidad') === 'psicomotricidad')>Psicomotricidad</option>
            </select>
        </div>
        <button type="submit" class="btn-filter">Filtrar</button>
        <a href="{{ route('admin.pacientes') }}" class="btn-clear">Limpiar</a>
    </form>

    {{-- Tabla --}}
    <div class="table-wrap">
        @if($pacientes->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del niño</th>
                    <th>Edad</th>
                    <th>Escolaridad</th>
                    <th>Tutor(es)</th>
                    <th>Especialidad</th>
                    <th>Especialista</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td><strong>{{ $p->nombre_nino }}</strong></td>
                    <td>{{ $p->edad }} años</td>
                    <td>{{ $p->escolaridad }}</td>
                    <td>{{ $p->tutores }}</td>
                    <td>
                        @php
                            $badgeClass = match($p->especialidad) {
                                'fonoaudiologia'  => 'badge-fono',
                                'psicomotricidad' => 'badge-psico',
                                default           => 'badge-psico',
                            };
                            $badgeLabel = match($p->especialidad) {
                                'fonoaudiologia'  => 'Fonoaudiología',
                                'psicomotricidad' => 'Psicomotricidad',
                                default           => ucfirst($p->especialidad),
                            };
                        @endphp
                        <span class="badge-esp {{ $badgeClass }}">{{ $badgeLabel }}</span>
                    </td>
                    <td>{{ $p->especialista?->nombre ?? '—' }}</td>
                    <td style="white-space:nowrap; color:var(--gray-500); font-size:.8rem;">
                        {{ $p->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.pacientes.show', $p) }}" class="btn-ver">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pacientes->links('pagination::simple-bootstrap-4') }}
        @else
        <div class="empty">
            <div class="empty-icon">🔍</div>
            <p>No se encontraron registros.</p>
        </div>
        @endif
    </div>
</div>
@endsection
