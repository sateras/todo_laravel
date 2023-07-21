@extends('layout.app')

@section('titile')
    Home
@endsection

@section('content')
    <div class="bg-gray m-5 p-5 rounded-lg bg-light">
        Todos list:
        <a href="{{ route("task.new") }}">
            <button class="btn btn-success">New</button>
        </a>
        <br />

        Create new
        @error('name')
            <div>
                Название
            </div> 
        @enderror
        <form method="POST" action="{{ route("task.new_process") }}">
            @csrf

            <input name="name" placeholder="Name" class="border border-gray-800 p-2 mt-3 @error('name') border-red-500 @enderror" type="text">
            <button class="btn btn-success" type="submit">
                Add
            </button>
        </form>
    </div>
@endsection