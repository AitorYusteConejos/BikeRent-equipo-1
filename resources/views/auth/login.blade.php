@extends('layouts.app')

@section('content')
<div class="auth">
    <div class="auth-card">
        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" autofocus>
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" class="form-input" type="password" name="password">
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-check">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    Recordarme
                </label>
            </div>

            <p id="login-error" class="field-error"></p>

            <div class="form-actions">
                <a class="link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="btn">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection

