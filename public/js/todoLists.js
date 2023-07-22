$(document).ready(function() {
    var loadingStatus = {
        isLoading: false
    };
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    function setLoadingStatus(status) {
        loadingStatus.isLoading = status;
        console.log('setLoadingStatus:' + status);
    }

    // FUNCTIONS START===================
    function getTaskLists() {
        $.get('/lists', function(response) {
            var taskLists = response;
            var taskListHTML = '';

            $.each(taskLists, function(index, taskList) {
                taskListHTML += '<tr>';
                taskListHTML += '<td>' + taskList.id + '</td>';
                taskListHTML += '<td style="width: 50%" data-tasklistid="' + taskList.id + '"><span id="taskListName">' + taskList.name + '</span><input id="editTaskListInput" type="text" class="input-group-sm" value="' + taskList.name + '" style="display: none; width: 100%"></td>';
                taskListHTML += '<td><button id="deleteTaskListButton" class="btn btn-danger" data-tasklistid="' + taskList.id + '">Delete</button></td>';
                taskListHTML += '</tr>';
            });

            $('#taskLists').html(taskListHTML);
        });
    }

    function clearNewTaskListName() {
        $('#newTaskListName').html(taskListHTML);;
    }

    function createTaskList(title) {
        setLoadingStatus(true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/lists/new',
            type: 'POST',
            success: function(response) {
                // Обработка успешного ответа от сервера

                setLoadingStatus(false);
            },
            error: function(error) {
                // Обработка ошибки запроса

                setLoadingStatus(false);
            }
        });
        $.post('/lists/new', { name: title });
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
            success: function(response) {
                getTaskLists();
            },
            error: function(error) {
                alert('Произошла ошибка при удалении листа задач:' + error);
            }
        });
    }

    function updateTaskList(taskListId, newTitle) {
        setLoadingStatus(true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/lists/' + taskListId,
            type: 'PUT',
            data: { name: newTitle },
            success: function(response) {
                // Успешное обновление, можно обновить список листов задач
                getTaskLists();
                setLoadingStatus(false);
            },
            error: function(error) {
                setLoadingStatus(false);
                alert('Произошла ошибка при обновлении имени листа задач.');
            }
        });
    }
    // FUNCTIONS END===================

    $('#updateTaskListButton').click(function() { // Обнуление инпута для добавления
        getTaskLists();
    });

    $('#createTaskListButton').click(function() { // Кнопка создания
        var title = $('#newTaskListName').val();
        createTaskList(title);
        getTaskLists();
    });

    $(document).on('click', '#deleteTaskListButton', function() { // Кнопка удаления
        var taskListId = $(this).data('tasklistid');
        deleteTaskList(taskListId);
    });

    $(document).on('click', '#taskListName', function() { // Когда кликаем на имя показываем инпут
        var taskListName = $(this);
        var taskListInput = taskListName.next('#editTaskListInput');

        taskListName.hide();
        taskListInput.show();

        taskListInput.focus().select();
    });

    $(document).on('blur', '#editTaskListInput', function() {
        var taskListInput = $(this);
        var taskListName = taskListInput.prev('#taskListName');
        var newTitle = taskListInput.val();
        var taskListId = taskListInput.parent().data('tasklistid')

        taskListName.text(newTitle).show();
        taskListInput.hide();

        updateTaskList(taskListId, newTitle);
    });

    getTaskLists();
});