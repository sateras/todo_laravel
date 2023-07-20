@extends('layout.app')

@section('title')
    Login
@endsection

@section('content')
    <div style="padding-top: 150px">
        <div class="d-flex justify-content-center align-items-center">
            <form method="POST" action="{{ route('login_process') }}" class="d-flex flex-column">
                @csrf
                <h1 class="m-2">Вход</h1>
                <input name="email" type="text" class="border border-gray-800 p-2 mt-2 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                    <p class="text-muted">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="border border-gray-800 p-2 mt-2 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                    <p class="text-muted">{{ $message }}</p>
                @enderror

                <div>
                    <a href="#" class="m-2">Забыли пароль?</a>
                </div>

                <div>
                    <a href="{{ route("register") }}" class="m-2">Регистрация</a>
                </div>

                <button type="submit" class="mx-auto btn btn-primary m-2">Войти</button>
            </form>
        </div>
    </div>
@endsection