<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Mi perfil</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="profile-page">
    <main class="profile">
        <a class="profile__back" href="{{ route('home') }}">
            ← Volver al inicio
        </a>


        <h1 class="profile__title">Mi perfil</h1>


        @if (session('status') === 'profile-updated')
            <p class="profile__message" role="status">
                Información actualizada correctamente.
            </p>
        @endif


        @if (session('status') === 'password-updated')
            <p class="profile__message" role="status">
                Contraseña actualizada correctamente.
            </p>
        @endif


        {{-- Nombre --}}
        <section class="profile__section">
            <h2 class="profile__heading">Nombre</h2>
            <p class="profile__value">{{ $user->name }}</p>


            <button
                class="profile__button"
                type="button"
                onclick="document.getElementById('modal-name').showModal()"
            >
                Editar nombre
            </button>
        </section>


        {{-- Correo --}}
        <section class="profile__section">
            <h2 class="profile__heading">Correo electrónico</h2>
            <p class="profile__value">{{ $user->email }}</p>


            <button
                class="profile__button"
                type="button"
                onclick="document.getElementById('modal-email').showModal()"
            >
                Editar correo
            </button>
        </section>


        {{-- Contraseña --}}
        <section class="profile__section">
            <h2 class="profile__heading">Contraseña</h2>
            <p class="profile__value">••••••••</p>


            <button
                class="profile__button"
                type="button"
                onclick="document.getElementById('modal-password').showModal()"
            >
                Cambiar contraseña
            </button>
        </section>


        {{-- Eliminar cuenta --}}
        <section class="profile__section profile__section--danger">
            <h2 class="profile__heading">Eliminar cuenta</h2>
            <p>Esta acción eliminará tu cuenta de forma permanente.</p>


            <button
                class="profile__button profile__button--danger"
                type="button"
                onclick="document.getElementById('modal-delete').showModal()"
            >
                Eliminar cuenta
            </button>
        </section>
    </main>


    {{-- Modal: editar nombre --}}
    <dialog class="profile-modal" id="modal-name" aria-labelledby="name-title">
        <h2 id="name-title">Editar nombre</h2>


        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')


            <input type="hidden" name="edit_section" value="name">
            <input type="hidden" name="email" value="{{ $user->email }}">


            <label for="name">Nombre</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                maxlength="255"
                autocomplete="name"
            >


            @error('name')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            @error('email')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            <div class="profile-modal__actions">
                <button
                    type="button"
                    onclick="document.getElementById('modal-name').close()"
                >
                    Cancelar
                </button>


                <button type="submit">Guardar</button>
            </div>
        </form>
    </dialog>


    {{-- Modal: editar correo --}}
    <dialog class="profile-modal" id="modal-email" aria-labelledby="email-title">
        <h2 id="email-title">Editar correo</h2>


        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')


            <input type="hidden" name="edit_section" value="email">
            <input type="hidden" name="name" value="{{ $user->name }}">


            <label for="email">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                maxlength="255"
                autocomplete="email"
            >


            @error('email')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            @error('name')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            <div class="profile-modal__actions">
                <button
                    type="button"
                    onclick="document.getElementById('modal-email').close()"
                >
                    Cancelar
                </button>


                <button type="submit">Guardar</button>
            </div>
        </form>
    </dialog>


    {{-- Modal: cambiar contraseña --}}
    <dialog class="profile-modal" id="modal-password" aria-labelledby="password-title">
        <h2 id="password-title">Cambiar contraseña</h2>


        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')


            <label for="current_password">Contraseña actual</label>
            <input
                id="current_password"
                type="password"
                name="current_password"
                required
                autocomplete="current-password"
            >
            @error('current_password', 'updatePassword')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            <label for="password">Nueva contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            >
            @error('password', 'updatePassword')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            <label for="password_confirmation">Repite la nueva contraseña</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            >


            <div class="profile-modal__actions">
                <button
                    type="button"
                    onclick="document.getElementById('modal-password').close()"
                >
                    Cancelar
                </button>


                <button type="submit">Cambiar contraseña</button>
            </div>
        </form>
    </dialog>


    {{-- Modal: eliminar cuenta --}}
    <dialog class="profile-modal" id="modal-delete" aria-labelledby="delete-title">
        <h2 id="delete-title">Eliminar cuenta</h2>


        <p>
            Esta acción es permanente. Introduce tu contraseña para confirmar.
        </p>


        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')


            <label for="delete_password">Contraseña</label>
            <input
                id="delete_password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            >


            @error('password', 'userDeletion')
                <p class="profile-modal__error" role="alert">{{ $message }}</p>
            @enderror


            <div class="profile-modal__actions">
                <button
                    type="button"
                    onclick="document.getElementById('modal-delete').close()"
                >
                    Cancelar
                </button>


                <button class="profile__button--danger" type="submit">
                    Eliminar mi cuenta
                </button>
            </div>
        </form>
    </dialog>


    {{-- Vuelve a abrir el modal correspondiente si hay errores --}}
    @if ($errors->userDeletion->any())
        <script>
            document.getElementById('modal-delete').showModal();
        </script>
    @elseif ($errors->updatePassword->any())
        <script>
            document.getElementById('modal-password').showModal();
        </script>
    @elseif ($errors->any() && old('edit_section') === 'name')
        <script>
            document.getElementById('modal-name').showModal();
        </script>
    @elseif ($errors->any() && old('edit_section') === 'email')
        <script>
            document.getElementById('modal-email').showModal();
        </script>
    @endif
</body>
</html>