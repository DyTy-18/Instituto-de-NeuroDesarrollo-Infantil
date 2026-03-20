@extends('layouts.app')

@section('title', 'Registro de Pacientes — Fono Bri')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, var(--sky-100) 0%, #fff 60%, #EEF9FF 100%);
        min-height: 100vh;
        padding: 2rem 1rem 4rem;
    }

    body::before {
        content: '';
        position: fixed;
        top: -80px; right: -80px;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, var(--accent-yellow) 0%, transparent 70%);
        opacity: .18;
        pointer-events: none;
    }

    body::after {
        content: '';
        position: fixed;
        bottom: -60px; left: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, var(--accent-lavender) 0%, transparent 70%);
        opacity: .22;
        pointer-events: none;
    }

    .card {
        max-width: 620px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 28px;
        box-shadow: 0 8px 40px rgba(41, 171, 226, .15);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        padding: 2.2rem 2rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .card-header .bubbles span {
        position: absolute;
        border-radius: 50%;
        opacity: .35;
    }
    .card-header .bubbles span:nth-child(1) { background: var(--accent-yellow);   top: 18%; left: 8%;  width: 18px; height: 18px; }
    .card-header .bubbles span:nth-child(2) { background: var(--accent-coral);    top: 60%; left: 5%;  width: 12px; height: 12px; }
    .card-header .bubbles span:nth-child(3) { background: var(--accent-green);    top: 25%; right: 7%; width: 20px; height: 20px; }
    .card-header .bubbles span:nth-child(4) { background: var(--accent-orange);   top: 65%; right: 9%; width: 14px; height: 14px; }
    .card-header .bubbles span:nth-child(5) { background: var(--accent-lavender); top: 10%; left: 45%; width: 10px; height: 10px; }

    .badge {
        display: inline-block;
        background: var(--accent-yellow);
        color: var(--gray-800);
        font-family: var(--font-ui);
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        padding: .3rem .8rem;
        border-radius: 99px;
        margin-bottom: .8rem;
    }

    .card-header h1 {
        font-family: var(--font-title);
        font-size: 2.1rem;
        color: var(--white);
        line-height: 1.15;
    }

    .card-header p { color: var(--sky-100); font-size: .9rem; margin-top: .5rem; }

    .card-body { padding: 2.2rem 2rem; }

    .form-group { margin-bottom: 1.4rem; }

    label {
        display: block;
        font-family: var(--font-ui);
        font-size: .82rem;
        font-weight: 600;
        color: var(--sky-700);
        margin-bottom: .45rem;
        letter-spacing: .03em;
    }

    label .required { color: var(--accent-coral); margin-left: 2px; }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: .75rem 1rem;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-family: var(--font-ui);
        font-size: .92rem;
        color: var(--gray-800);
        background: var(--gray-50);
        transition: border-color .2s, box-shadow .2s;
        appearance: none;
        -webkit-appearance: none;
    }

    input:focus, select:focus {
        outline: none;
        border-color: var(--sky-500);
        box-shadow: 0 0 0 4px rgba(41, 171, 226, .12);
        background: var(--white);
    }

    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '▾';
        position: absolute;
        right: 1rem; top: 50%;
        transform: translateY(-50%);
        color: var(--sky-500);
        font-size: 1rem;
        pointer-events: none;
    }

    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    .divider {
        display: flex; align-items: center; gap: .8rem;
        margin: 1.8rem 0;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1; height: 1.5px; background: var(--gray-200);
    }
    .divider span { font-size: .8rem; color: var(--gray-500); font-family: var(--font-ui); white-space: nowrap; }

    /* Profesionales */
    .profesionales {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .prof-card {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        background: var(--sky-100);
        border: 2px solid rgba(41,171,226,.2);
        border-radius: 16px;
        padding: 1.1rem 1.2rem;
        transition: border-color .2s, box-shadow .2s;
    }

    .prof-icon {
        font-size: 2rem;
        line-height: 1;
        flex-shrink: 0;
        margin-top: .1rem;
    }

    .prof-info { flex: 1; }

    .prof-specialty {
        font-family: var(--font-ui);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--sky-500);
        margin-bottom: .2rem;
    }

    .prof-name {
        font-family: var(--font-title);
        font-size: 1.05rem;
        color: var(--gray-800);
        margin-bottom: .4rem;
    }

    .prof-details {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem .8rem;
        font-family: var(--font-ui);
        font-size: .78rem;
        color: var(--gray-500);
        margin-bottom: .8rem;
    }

    .prof-details span {
        display: flex;
        align-items: center;
        gap: .25rem;
    }

    .btn-reservar {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .5rem 1.1rem;
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        color: var(--white);
        border: none;
        border-radius: 99px;
        font-family: var(--font-ui);
        font-size: .82rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform .15s, box-shadow .15s;
        box-shadow: 0 3px 12px rgba(41,171,226,.35);
    }
    .btn-reservar:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(41,171,226,.4); }

    /* Calendly panel */
    .slots-panel {
        display: none;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1.5px dashed rgba(41,171,226,.3);
    }
    .slots-panel.open { display: block; animation: fadeIn .25s ease; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .calendly-inline-widget {
        min-width: 100% !important;
        width: 100% !important;
        height: 700px;
        border-radius: 12px;
        overflow: hidden;
    }

    .alert {
        display: none;
        padding: 1rem 1.2rem;
        border-radius: 12px;
        font-family: var(--font-ui);
        font-size: .9rem;
        font-weight: 600;
        margin-top: 1.2rem;
        text-align: center;
    }
    .alert.success { background: #ECFDF5; color: #065F46; border: 1.5px solid var(--accent-green); }
    .alert.error   { background: #FFF1F2; color: #9F1239; border: 1.5px solid var(--accent-coral); }
    .alert.visible { display: block; }

    @media (max-width: 480px) {
        .card-header h1 { font-size: 1.6rem; }
        .card-body { padding: 1.6rem 1.2rem; }
        .two-col { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="bubbles">
            <span></span><span></span><span></span><span></span><span></span>
        </div>
        <div class="badge">INDI</div>
        <h1>Dia del Niño</h1>
        <p>Completa el formulario y elige tu especialista</p>
    </div>

    <div class="card-body">
        <form id="registroForm" novalidate>
            @csrf

            <div class="form-group">
                <label for="nombre_nino">Nombre del niño / niña <span class="required">*</span></label>
                <input type="text" id="nombre_nino" name="nombre_nino"
                       placeholder="Nombre completo" maxlength="100" required>
            </div>

            <div class="two-col">
                <div class="form-group">
                    <label for="edad">Edad <span class="required">*</span></label>
                    <input type="number" id="edad" name="edad"
                           placeholder="Años" min="1" max="17" required>
                </div>

                <div class="form-group">
                    <label for="escolaridad">Escolaridad <span class="required">*</span></label>
                    <div class="select-wrap">
                        <select id="escolaridad" name="escolaridad" required>
                            <option value="">Seleccionar…</option>
                            @foreach([
                                'Pre-Kinder','Kinder',
                                '1° Básico','2° Básico','3° Básico','4° Básico',
                                '5° Básico','6° Básico','7° Básico','8° Básico',
                                '1° Medio','2° Medio','3° Medio','4° Medio',
                            ] as $nivel)
                                <option value="{{ $nivel }}">{{ $nivel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="tutores">Nombre del tutor / tutores <span class="required">*</span></label>
                <input type="text" id="tutores" name="tutores"
                       placeholder="Ej: María Soto / Juan Pérez" maxlength="255" required>
            </div>

            <div class="divider"><span>✦ Elige tu especialista ✦</span></div>

            <div class="profesionales">

                {{-- Pamela Mamani — Psicomotricidad --}}
                <div class="prof-card"
                     data-id="{{ $especialistas['pamela'] ?? '' }}"
                     data-especialidad="psicomotricidad"
                     data-wa="59179676634"
                     data-nombre-prof="Pamela Mamani">
                    <div class="prof-icon">🤸</div>
                    <div class="prof-info">
                        <div class="prof-specialty">Psicomotricidad</div>
                        <div class="prof-name">Pamela Mamani</div>
                        <div class="prof-details">
                            <span>📞 79676634</span>
                            <span>🕐 10:00 – 13:00</span>
                            <span>⏱ Cada 40 min</span>
                        </div>
                        <button type="button" class="btn-reservar">
                            Ver horarios disponibles ▾
                        </button>
                        <div class="slots-panel">
                            <div class="calendly-inline-widget"
                                 data-url="https://calendly.com/indilpzbo/30min">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carla Carpero — Fonoaudiología --}}

                <div class="prof-card"
                     data-id="{{ $especialistas['carla'] ?? '' }}"
                     data-especialidad="fonoaudiologia"
                     data-wa="59160638334"
                     data-nombre-prof="Carla Carpero">
                    <div class="prof-icon">🗣️</div>
                    <div class="prof-info">
                        <div class="prof-specialty">Fonoaudiología</div>
                        <div class="prof-name">Carla Carpero</div>
                        <div class="prof-details">
                            <span>📞 60638334</span>
                            <span>🕐 18:00 – 20:00</span>
                            <span>⏱ Cada 30 min</span>
                        </div>
                        <button type="button" class="btn-reservar">
                            Ver horarios disponibles ▾
                        </button>
                        <div class="slots-panel">
                            <div class="calendly-inline-widget"
                                 data-url="https://calendly.com/indilpzbo/fonoaudiologia-brittany-lara-clone">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Brittany Lara — Fonoaudiología --}}
                <div class="prof-card"
                     data-id="{{ $especialistas['brittany'] ?? '' }}"
                     data-especialidad="fonoaudiologia"
                     data-wa="59175862308"
                     data-nombre-prof="Brittany Lara">
                    <div class="prof-icon">🗣️</div>
                    <div class="prof-info">
                        <div class="prof-specialty">Fonoaudiología</div>
                        <div class="prof-name">Brittany Lara</div>
                        <div class="prof-details">
                            <span>📞 75862308</span>
                            <span>🕐 08:00 – 13:00 / 14:00 – 16:00</span>
                            <span>⏱ Cada 30 min</span>
                        </div>
                        <button type="button" class="btn-reservar">
                            Ver horarios disponibles ▾
                        </button>
                        <div class="slots-panel">
                            <div class="calendly-inline-widget"
                                 data-url="https://calendly.com/indilpzbo/fonoaudiologia-brittany-lara-clone-clone">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="alert" id="alertMsg"></div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://assets.calendly.com/assets/external/widget.js" async></script>
<script>
    const form     = document.getElementById('registroForm');
    const alertMsg = document.getElementById('alertMsg');

    document.querySelectorAll('.btn-reservar').forEach(btn => {
        btn.addEventListener('click', () => {
            hideAlert();
            const panel = btn.closest('.prof-info').querySelector('.slots-panel');

            // Cerrar otros paneles abiertos
            document.querySelectorAll('.slots-panel.open').forEach(p => {
                if (p !== panel) {
                    p.classList.remove('open');
                    p.previousElementSibling.textContent = 'Ver horarios disponibles ▾';
                }
            });

            const isOpen = panel.classList.toggle('open');
            btn.textContent = isOpen ? 'Ocultar horarios ▴' : 'Ver horarios disponibles ▾';

            // Inicializar Calendly cuando se abre por primera vez
            if (isOpen && window.Calendly) {
                Calendly.initInlineWidgets();
            }
        });
    });

    function showAlert(type, msg) {
        alertMsg.textContent = msg;
        alertMsg.className = `alert ${type} visible`;
        alertMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    function hideAlert() { alertMsg.className = 'alert'; }
</script>
@endsection
