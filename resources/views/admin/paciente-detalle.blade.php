@extends('layouts.app')

@section('title', 'Detalle — ' . $paciente->nombre_nino)

@section('styles')
<style>
    body { background: var(--gray-100); min-height: 100vh; }

    .topbar {
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 12px rgba(41, 171, 226, .25);
    }
    .topbar a.back {
        font-family: var(--font-ui);
        font-size: .85rem;
        font-weight: 600;
        color: rgba(255,255,255,.8);
        text-decoration: none;
    }
    .topbar a.back:hover { color: var(--white); }
    .topbar h1 {
        font-family: var(--font-title);
        color: var(--white);
        font-size: 1.4rem;
    }

    .main { padding: 2rem; max-width: 680px; margin: 0 auto; }

    .detail-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        overflow: hidden;
    }
    .detail-header {
        background: var(--sky-100);
        padding: 1.5rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        border-bottom: 2px solid var(--sky-300);
    }
    .avatar {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sky-500), var(--sky-700));
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }
    .detail-header .name {
        font-family: var(--font-title);
        font-size: 1.5rem;
        color: var(--sky-700);
    }
    .detail-header .meta {
        font-family: var(--font-ui);
        font-size: .82rem;
        color: var(--gray-500);
        margin-top: .2rem;
    }

    .detail-body { padding: 1.8rem; }
    .field-row {
        display: grid;
        grid-template-columns: 160px 1fr;
        gap: .5rem;
        padding: .85rem 0;
        border-bottom: 1px solid var(--gray-100);
        align-items: start;
    }
    .field-row:last-child { border-bottom: none; }
    .field-row .lbl {
        font-family: var(--font-ui);
        font-size: .78rem;
        font-weight: 700;
        color: var(--sky-700);
        text-transform: uppercase;
        letter-spacing: .05em;
        padding-top: .05rem;
    }
    .field-row .val {
        font-family: var(--font-ui);
        font-size: .92rem;
        color: var(--gray-800);
    }

    .badge-esp {
        display: inline-block;
        padding: .3rem .85rem;
        border-radius: 99px;
        font-size: .82rem;
        font-weight: 700;
        font-family: var(--font-ui);
    }
    .badge-fono  { background: var(--sky-100); color: var(--sky-700); }
    .badge-quiro { background: #F3F0FF; color: #6D28D9; }

    @media (max-width: 480px) {
        .field-row { grid-template-columns: 1fr; }
        .main { padding: 1rem; }
    }
</style>
@endsection

@section('content')
<div class="topbar">
    <a href="{{ route('admin.pacientes') }}" class="back">← Volver</a>
    <h1>Detalle del paciente</h1>
</div>

<div class="main">
    <div class="detail-card">
        <div class="detail-header">
            <div class="avatar">👦</div>
            <div>
                <div class="name">{{ $paciente->nombre_nino }}</div>
                <div class="meta">Registrado el {{ $paciente->created_at->format('d \d\e F \d\e Y, H:i') }}</div>
            </div>
        </div>
        <div class="detail-body">
            <div class="field-row">
                <span class="lbl">Edad</span>
                <span class="val">{{ $paciente->edad }} años</span>
            </div>
            <div class="field-row">
                <span class="lbl">Escolaridad</span>
                <span class="val">{{ $paciente->escolaridad }}</span>
            </div>
            <div class="field-row">
                <span class="lbl">Tutor(es)</span>
                <span class="val">{{ $paciente->tutores }}</span>
            </div>
            <div class="field-row">
                <span class="lbl">Especialidad</span>
                <span class="val">
                    <span class="badge-esp {{ $paciente->especialidad === 'fonoaudiologia' ? 'badge-fono' : 'badge-quiro' }}">
                        {{ $paciente->especialidad === 'fonoaudiologia' ? 'Fonoaudiología' : 'Quiropráctica' }}
                    </span>
                </span>
            </div>
            <div class="field-row">
                <span class="lbl">Especialista</span>
                <span class="val">{{ $paciente->especialista?->nombre ?? '—' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
