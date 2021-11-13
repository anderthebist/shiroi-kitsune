@extends('layouts.app')

@section('title','Восстановление пароля')

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/forget.css") }}>
@endpush

@section('content')
    <main class="main">
        <div class="alert">
            <form action={{ route('forget_process') }} method="POST">
                @csrf
                <h2 class="auth-block__title">
                    Восстановление пароля
                </h2>
                @if ($errors->any())
                    <p class="auth-block__error">{{ $errors->all()[0] }}</p>
                @endif
                @if(session()->has('success'))
                    <p class="auth-block__success">{{ session()->get('success') }}</p>
                @endif
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "email" id = "email" type="email"  placeholder="Адрес электроной почты">
                </div>
                <div class="auth-block__submit-container">
                    <button class="auth-block__btn btn" type="submit" name = "auth_submit" id = "auth_submit">Войти</button>
                    <div class="auth-block__preloader preloader">
                        <img src={{ asset("/images/preloader_back_gray.gif") }} alt="Preloader"/>
                    </div> 
                </div>
            </form>
        </div>
    </main>
@endsection