@extends('layout.app')

@section('titile')
    Home
@endsection

@include('partials.header')
@section('content')
    <div class="bg-gray m-5 p-5 rounded-lg bg-light">
        My list:
        <input id="newTaskListName" type="text">

        <button id="createButton" class="btn btn-success" type="submit">
            Add
        </button>

        <button id="updateButton" class="btn btn-success" type="submit">
            Update
        </button>

        <table id="taskLists" class="border-separate border-spacing-4">
            <tr>
                <td>Loading...</td>
            </tr>
        </table>
    </div>
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            // FUNCTIONS START===================
            function getTaskLists() {
                $.get('{{ route('list.index') }}', function(response) {
                    var taskLists = response;
                    var taskListHTML = '';
                    $.each(taskLists, function(index, taskList) {
                        taskListHTML += '<tr>';
                        taskListHTML += '<td>' + taskList.name + '</td>';
                        taskListHTML += '<td>' + taskList.id + '</td>';
                        taskListHTML += '<td><button id="deleteListButton" class="btn btn-danger" data-tasklistid="' + taskList.id + '">Delete</button></td>';
                        taskListHTML += '</tr>';
                    });

                    $('#taskLists').html(taskListHTML);
                });
            }

            function clearNewTaskListName() {
                $('#newTaskListName').html(taskListHTML);;
            }

            function createTaskList(title) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.post('{{ route('list.create') }}', { name: title });
            }

            function deleteTaskList(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    url: '/lists/' + id,
                    type: 'DELETE',
                    // data: { id: id },
                    success: function(response) {
                        getTaskLists();
                    },
                    error: function(error) {
                        alert('Произошла ошибка при удалении листа задач.');
                    }
                });
            }
            // FUNCTIONS END===================

            $('#updateButton').click(function() {
                getTaskLists();
            });

            $('#createButton').click(function() {
                var title = $('#newTaskListName').val();
                createTaskList(title);
                getTaskLists();
                clearNewTaskListName();
            });

            $(document).on('click', '#deleteListButton', function() {
                var taskListId = $(this).data('tasklistid');
                deleteTaskList(taskListId);
            });

            getTaskLists();
        });
    </script>
@endsection