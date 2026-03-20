@extends('layouts.app')

@section('title', 'Acceso Admin — Fono Bri')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, var(--sky-100) 0%, #fff 60%, #EEF9FF 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: var(--white);
        border-radius: 28px;
        box-shadow: 0 8px 40px rgba(41, 171, 226, .15);
        overflow: hidden;
    }

    .login-header {
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        padding: 2rem;
        text-align: center;
    }

    .login-header .icon { font-size: 2.5rem; margin-bottom: .5rem; }

    .login-header h1 {
        font-family: var(--font-title);
        font-size: 1.8rem;
        color: var(--white);
    }

    .login-header p { color: var(--sky-100); font-size: .88rem; margin-top: .3rem; }

    .login-body { padding: 2rem; }

    .form-group { margin-bottom: 1.3rem; }

    label {
        display: block;
        font-family: var(--font-ui);
        font-size: .82rem;
        font-weight: 600;
        color: var(--sky-700);
        margin-bottom: .45rem;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: .75rem 1rem;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-family: var(--font-ui);
        font-size: .92rem;
        color: var(--gray-800);
        background: var(--gray-50);
        transition: border-color .2s, box-shadow .2s;
    }

    input:focus {
        outline: none;
        border-color: var(--sky-500);
        box-shadow: 0 0 0 4px rgba(41, 171, 226, .12);
        background: var(--white);
    }

    input.is-invalid { border-color: var(--accent-coral); }

    .error-msg {
        font-family: var(--font-ui);
        font-size: .8rem;
        color: var(--accent-coral);
        margin-top: .35rem;
    }

    .remember-row {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: 1.4rem;
    }

    .remember-row input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--sky-500); cursor: pointer; }
    .remember-row label {
        font-family: var(--font-ui);
        font-size: .85rem;
        color: var(--gray-700);
        margin: 0;
        cursor: pointer;
    }

    .btn-login {
        width: 100%;
        padding: .9rem;
        background: linear-gradient(135deg, var(--sky-500) 0%, var(--sky-700) 100%);
        color: var(--white);
        border: none;
        border-radius: 14px;
        font-family: var(--font-ui);
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: .04em;
        cursor: pointer;
        transition: transform .15s, box-shadow .15s;
        box-shadow: 0 4px 16px rgba(41, 171, 226, .35);
    }

    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(41, 171, 226, .4); }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 1.2rem;
        font-family: var(--font-ui);
        font-size: .85rem;
        color: var(--gray-500);
        text-decoration: none;
    }

    .back-link:hover { color: var(--sky-500); }
</style>
@endsection

@section('content')
<div class="login-card">
    <div class="login-header">
        <div class="icon">🔐</div>
        <h1>Acceso Admin</h1>
        <p>Panel de gestión Fono Bri</p>
    </div>

    <div class="login-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="admin@fonobri.cl"
                       class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                       required autofocus>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn-login">Ingresar →</button>
        </form>

        <a href="{{ route('formulario') }}" class="back-link">← Volver al formulario</a>
    </div>
</div>
@endsection
