@extends('layouts.app')

@section('title','Изменение пароля')

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/forget.css") }}>
@endpush

@section('content')
    <main class="main">
        <div class="auth-block">
            <div class="auth-block__forms forget__block">
                <form action={{ route('reset_password_process') }} method="POST" class="auth-block__form">
                    @csrf
                    <h2 class="auth-block__title">
                        Изменение пароля
                    </h2>
                    @if ($errors->any())
                        <p class="auth-block__error">{{ $errors->all()[0] }}</p>
                    @endif
                    <div class="auth-block__field">
                        <input class="auth-block__input input" name = "password" type="password"  placeholder="Пароль">
                    </div>
                    <div class="auth-block__field">
                        <input class="auth-block__input input" name = "password_confirmation" type="password"  placeholder="Повторите пароль">
                    </div>
                    <input name = "token" type="hidden" value="{{ $token }}">
                    <div class="auth-block__submit-container">
                        <button class="auth-block__btn btn" type="submit" name = "auth_submit" id = "auth_submit">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection