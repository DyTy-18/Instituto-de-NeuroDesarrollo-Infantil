@extends('layouts.app')

@section('title', 'Pago de Reserva — Fono Bri')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, var(--sky-100) 0%, #fff 60%, #EEF9FF 100%);
        min-height: 100vh;
        padding: 2rem 1rem 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        max-width: 500px;
        width: 100%;
        background: var(--white);
        border-radius: 28px;
        box-shadow: 0 8px 40px rgba(41, 171, 226, .15);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        padding: 2rem;
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

    .check-icon {
        font-size: 3rem;
        margin-bottom: .5rem;
        display: block;
    }

    .card-header h1 {
        font-family: var(--font-title);
        font-size: 1.8rem;
        color: var(--white);
        line-height: 1.2;
    }

    .card-header p {
        color: var(--sky-100);
        font-size: .9rem;
        margin-top: .4rem;
        font-family: var(--font-ui);
    }

    .card-body {
        padding: 2rem;
        text-align: center;
    }

    .monto {
        background: var(--sky-100);
        border: 2px solid rgba(41,171,226,.25);
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .monto .lbl {
        font-family: var(--font-ui);
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--sky-500);
        margin-bottom: .3rem;
    }

    .monto .valor {
        font-family: var(--font-title);
        font-size: 2.4rem;
        color: var(--sky-700);
        line-height: 1;
    }

    .instruccion {
        font-family: var(--font-ui);
        font-size: .9rem;
        color: var(--gray-500);
        margin-bottom: 1.2rem;
        line-height: 1.5;
    }

    .qr-wrap {
        display: inline-block;
        padding: 1rem;
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        margin-bottom: 1.5rem;
    }

    .qr-wrap img {
        width: 240px;
        height: 240px;
        object-fit: contain;
        display: block;
        border-radius: 8px;
    }

    .pasos {
        text-align: left;
        background: #F0FDF4;
        border: 1.5px solid var(--accent-green);
        border-radius: 14px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.2rem;
    }

    .pasos .pasos-title {
        font-family: var(--font-ui);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #065F46;
        margin-bottom: .7rem;
    }

    .pasos ol {
        padding-left: 1.2rem;
        margin: 0;
    }

    .pasos li {
        font-family: var(--font-ui);
        font-size: .85rem;
        color: #065F46;
        margin-bottom: .35rem;
        line-height: 1.4;
    }

    /* Aviso de política */
    .aviso {
        text-align: left;
        background: #FFF7ED;
        border: 1.5px solid var(--accent-orange);
        border-radius: 14px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.5rem;
    }

    .aviso .aviso-title {
        font-family: var(--font-ui);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #92400E;
        margin-bottom: .5rem;
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .aviso p {
        font-family: var(--font-ui);
        font-size: .84rem;
        color: #78350F;
        line-height: 1.55;
        margin: 0;
    }

    /* Contacto WhatsApp */
    .contactos {
        text-align: left;
        margin-bottom: 1.5rem;
    }

    .contactos .contactos-title {
        font-family: var(--font-ui);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--sky-700);
        margin-bottom: .8rem;
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .contacto-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .8rem;
        padding: .7rem .9rem;
        background: var(--sky-100);
        border: 1.5px solid rgba(41,171,226,.2);
        border-radius: 12px;
        margin-bottom: .5rem;
    }

    .contacto-info {
        flex: 1;
    }

    .contacto-nombre {
        font-family: var(--font-ui);
        font-size: .88rem;
        font-weight: 600;
        color: var(--gray-800);
        line-height: 1.2;
    }

    .contacto-especialidad {
        font-family: var(--font-ui);
        font-size: .72rem;
        color: var(--sky-500);
        font-weight: 500;
    }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .45rem 1rem;
        background: #25D366;
        color: #fff;
        border-radius: 99px;
        text-decoration: none;
        font-family: var(--font-ui);
        font-size: .8rem;
        font-weight: 600;
        white-space: nowrap;
        transition: background .15s, transform .15s;
        flex-shrink: 0;
    }
    .btn-wa:hover { background: #1ebe5d; transform: translateY(-1px); }

    .btn-volver {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .7rem 1.6rem;
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        color: var(--white);
        border: none;
        border-radius: 99px;
        font-family: var(--font-ui);
        font-size: .9rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(41,171,226,.35);
        transition: transform .15s, box-shadow .15s;
    }
    .btn-volver:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(41,171,226,.4); }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="bubbles">
            <span></span><span></span><span></span><span></span>
        </div>
        <span class="check-icon">🎉</span>
        <h1>¡Cita agendada!</h1>
        <p>Solo falta confirmar tu reserva con el pago</p>
    </div>

    <div class="card-body">

        {{-- Monto --}}
        <div class="monto">
            <div class="lbl">Monto de reserva</div>
            <div class="valor">Bs. 20</div>
        </div>

        <p class="instruccion">
            Escanea el QR desde tu app de banco o billetera digital para realizar el pago de la reserva.
        </p>

        {{-- QR --}}
        <div class="qr-wrap">
            <img src="{{ asset('QR/WhatsApp Image 2026-03-20 at 12.59.49 PM.jpeg') }}"
                 alt="QR de pago Fono Bri">
        </div>

        {{-- Pasos --}}
        <div class="pasos">
            <div class="pasos-title">Cómo confirmar tu reserva</div>
            <ol>
                <li>Abre tu app de banco o billetera digital</li>
                <li>Selecciona <strong>Pagar con QR</strong> y escanea el código</li>
                <li>Confirma el monto de <strong>Bs. 20</strong></li>
                <li>Toma una captura del comprobante</li>
                <li>Envíalo al WhatsApp de tu especialista</li>
            </ol>
        </div>

        {{-- Aviso de política --}}
        <div class="aviso">
            <div class="aviso-title">⚠️ Información importante</div>
            <p>
                Por favor, <strong>asiste puntualmente a tu hora agendada</strong>.
                El pago de reserva no es reembolsable en caso de inasistencia o cancelación
                con menos de 24 horas de anticipación.
                ¡Valoramos tu tiempo y el de nuestras especialistas!
            </p>
        </div>

        {{-- Contactos WhatsApp --}}
        <div class="contactos">
            <div class="contactos-title">Consultas y envío de comprobante</div>

            <div class="contacto-item">
                <div class="contacto-info">
                    <div class="contacto-nombre">Pamela Mamani</div>
                    <div class="contacto-especialidad">Psicomotricidad · 79676634</div>
                </div>
                <a href="https://wa.me/59179676634?text=Hola%20Pamela%2C%20acabo%20de%20agendar%20una%20cita%20y%20quiero%20enviar%20mi%20comprobante%20de%20pago."
                   target="_blank" class="btn-wa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>

            <div class="contacto-item">
                <div class="contacto-info">
                    <div class="contacto-nombre">Carla Carpero</div>
                    <div class="contacto-especialidad">Fonoaudiología · 60638334</div>
                </div>
                <a href="https://wa.me/59160638334?text=Hola%20Carla%2C%20acabo%20de%20agendar%20una%20cita%20y%20quiero%20enviar%20mi%20comprobante%20de%20pago."
                   target="_blank" class="btn-wa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>

            <div class="contacto-item">
                <div class="contacto-info">
                    <div class="contacto-nombre">Brittany Lara</div>
                    <div class="contacto-especialidad">Fonoaudiología · 75862308</div>
                </div>
                <a href="https://wa.me/59175862308?text=Hola%20Brittany%2C%20acabo%20de%20agendar%20una%20cita%20y%20quiero%20enviar%20mi%20comprobante%20de%20pago."
                   target="_blank" class="btn-wa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>

        <a href="{{ route('formulario') }}" class="btn-volver">
            ← Volver al inicio
        </a>

    </div>
</div>
@endsection
