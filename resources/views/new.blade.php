@extends('layout.app')

@section('titile')
    Home
@endsection

@section('content')
    <header class="flex">
        <a href="{{ route("logout") }}">
            <button class=" bg-blue-400 rounded-lg p-2 justify-end">Logout</button>
        </a>
        </a>
    </header>

    <div  class="bg-white p-20 rounded-lg">
        Create new
        @error('name')
        <div class=" text-red-500">
            Заполни поле 
        </div> 
        @enderror
        <form method="POST" action="{{ route("task.new_process") }}">
            @csrf

            <input name="name" placeholder="Name" class="border-gray-800 rounded-md bg-green-200 p-2 @error('name') border-red-500 @enderror" type="text">
            <button class=" bg-green-500 p-2 rounded-md" type="submit">
                Add
            </button>
        </form>
    </div>
@endsection