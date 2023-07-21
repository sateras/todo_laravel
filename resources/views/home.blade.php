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

        @if ( count($tasks) > 0)
            <table class="border-separate border-spacing-4">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Дата создания</th>
                        <th>Название</th>
                        <th>(Action)</th>
                    </tr>
                </thead>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task ->  id }}</td>
                    <td>{{ $task ->  id }}</td>
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
        @endif
        @if ( count($tasks) == 0)
            To-Do список пусой, <a href="{{ route("task.new") }}">создайте</a> новую задачу
        @endif
    </div>
@endsection