@extends('layout.app')

@section('titile')
    Reg
@endsection

@section('content')
<div style="padding-top: 150px">
    <div class="d-flex justify-content-center align-items-center">
        <form action="{{ route("register_process") }}" class="d-flex flex-column" method="POST">
            @csrf
            <h1 class="text-3xl font-medium">Регистрация</h1>
            <input name="name" type="text" class="border border-gray-800 rounded p-2 mt-2 @error('name') border-red-500 @enderror" placeholder="Имя" />

            @error('name')
            <p class="text-muted">{{ $message }}</p>
            @enderror

            <input name="email" type="text" class="border border-gray-800 rounded p-2 mt-2 @error('email') border-red-500 @enderror" placeholder="Email" />

            @error('email')
                <p class="text-muted">{{ $message }}</p>
            @enderror

            <input name="password" type="password" class="border border-gray-800 rounded p-2 mt-2 @error('password') border-red-500 @enderror" placeholder="Пароль" />

            @error('password')
                <p class="text-muted">{{ $message }}</p>
            @enderror

            <input name="password_confirmation" type="password" class="border border-gray-800 rounded p-2 mt-2 @error('password_confirmation') border-red-500 @enderror" placeholder="Подтверждение пароля" />

            @error('password_confirmation')
                <p class="text-muted">{{ $message }}</p>
            @enderror

            <div>
                <a href="{{ route("login") }}" class="m-2">Есть аккаунт?</a>
            </div>

            <button type="submit" class="mx-auto btn btn-primary m-2">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection