@extends('layouts.app')

@section('content')
<div class="auth">
    <div class="auth-card">
        <form id="register-form" method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" autofocus>
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}">
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

            <div class="form-group">
                <label for="password_confirmation">Repetir contraseña</label>
                <input id="password_confirmation" class="form-input" type="password" name="password_confirmation">
            </div>

            <p id="register-error" class="field-error"></p>

            <div class="form-actions">
                <a class="link" href="{{ route('login') }}">¿Ya tienes cuenta?</a>
                <button type="submit" class="btn">Registrarse</button>
            </div>
        </form>
    </div>
</div>
@endsection