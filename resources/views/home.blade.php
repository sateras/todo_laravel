@extends('layout.app')

@section('titile')
    Home
@endsection

@section('content')
    <header class="flex">
        <a href="{{ route("logout") }}">
            <button class=" bg-blue-400 rounded-lg p-2 justify-end">Logout</button>
        </a>
    </header>

    <div  class="bg-white p-20 rounded-lg">
        Todos list:
        <a href="{{ route("task.new") }}">
            <button class=" bg-green-500 rounded-lg p-2">New</button>
        </a>
        
        <table class="border-separate border-spacing-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Todoname</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task ->  id }}</td>
                <td>15.15.2023</td>
                <td>{{ $task -> name }}</td>
                <td>
                    <form action="{{ route('task.delete_process', $task-> id) }}" method="POST">
                        @csrf
                        <button type="submit" class=" bg-red-500 rounded-lg p-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
          </table>
    </div>
@endsection