@extends('layout.app')

@section('titile')
    Home
@endsection

@include('partials.header')
@section('content')
    <div class="bg-gray m-5 p-5 rounded-lg bg-light">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="List name, task name, tag name" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
          </div>
        <span class="bg-gray">My lists:</span> 
        
        <br />
        <input placeholder="Add new list" id="newTaskListName" type="text">

        <button id="createTaskListButton" class="btn btn-success" type="submit">
            Add
        </button>

        <button id="updateTaskListButton" class="btn btn-success" type="submit">
            Update
        </button>

        <div class="d-flex justify-content-between">
            <div style="width: 49%">
                <table class="table table-hover">
                    <tbody id="taskLists">
                        <tr>
                            <td>Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 49%">
                <table id="tasks" class="table rounded" style="background-color: rgb(231, 231, 231)">
                    <tr>
                        <td></td>
                        <td>Task Name</td>
                        <td>Task ID</td>
                        <td><button id="deleteTaskListButton" class="btn btn-danger" data-tasklistid="' + tasklist.id + '">Delete</button></td>
                    </tr>
                </table>
            </div>
        </div>
        
        
        
    </div>
    <script>
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // FUNCTIONS START===================
    function getTasks() {
        $.get('/tasks', function(response) {
            var tasks = response;
            var tasksHTML = '';
            $.each(tasks, function(index, task) {
                tasksHTML += '<tr>';
                tasksHTML += '<td >' + task.name + '</td>';
                tasksHTML += '<td>' + task.id + '</td>';
                tasksHTML += '<td><button id="deleteTaskButton" class="btn btn-danger" data-taskid="' + task.id + '">Delete</button></td>';
                tasksHTML += '</tr>';
            });

            $('#tasks').html(taskHTML);
        });
    }

    function clearNewTaskName() {
        $('#newTaskName').html(taskHTML);;
    }

    function createTask(title) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.post('/tasks/new', { name: title });
    }

    function deleteTask(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tasks/' + id,
            type: 'DELETE',
            success: function(response) {
                getTasks();
            },
            error: function(error) {
                alert('Произошла ошибка при удалении задачи.');
            }
        });
    }
    // FUNCTIONS END===================

    $('#updateTaskButton').click(function() {
        getTasks();
    });

    $('#createTaskButton').click(function() {
        var title = $('#newTaskName').val();
        createTask(title);
        getTasks();
        clearNewTaskName();
    });

    $(document).on('click', '#deleteTaskButton', function() {
        var taskId = $(this).data('taskid');
        deleteTask(taskId);
    });
});
    </script>
    <script src="{{ URL::asset('js/todoLists.js') }}"></script>
@endsection