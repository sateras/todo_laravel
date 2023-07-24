$(document).ready(function() {
    var loadingStatus = {
        isLoading: false
    };
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    function setLoadingStatus(status) {
        loadingStatus.isLoading = status;
    }

    // FUNCTIONS START===================
    function getTasks(taskListId) {
        setLoadingStatus(true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tasks/' + taskListId,
            type: 'GET',
            success: function(response) {
                var tasks = response;
                var tasksHTML = '';

                tasksHTML += '<tr>';
                tasksHTML += '<td>Task image</td>';
                tasksHTML += '<td>Tag</td>';
                tasksHTML += '<td>Name</td>';
                tasksHTML += '<td>Action</td>';
                tasksHTML += '</tr>';

                $.each(tasks, function(index, task) {
                    tasksHTML += '<tr>';
                    if (task.image == null) {
                        tasksHTML += '<td><input type="file" id="taskInputImage" style="display: none"><label for="taskInputImage"><img src="img/no-image-icon-23486.gif" alt="no_img_icon"></label></td>';
                    } else {
                        tasksHTML += '<td>' + task.image.thumbnail_path + '</td>';
                    }
                    tasksHTML += '<td>'
                    $.each(task.tags, function(index, tag) {
                        tasksHTML += '<div class="tag">' + tag.name + '</div>';
                    });
                    tasksHTML += '<div class="d-flex">';
                    tasksHTML += '<i class="bi bi-plus-square-fill tag_plus_btn"></i>';
                    tasksHTML += '<i class="bi bi-trash3-fill tag_remove_btn"></i>';
                    tasksHTML += '</div>';
                    tasksHTML += '<div class="newTagPopupContainer" style="display: none">';
                    tasksHTML += '<input id="newTagInput" class="newTagInputPopupContainer" type="text">';
                    tasksHTML += '<button class="newTagPopupContainerButton btn btn-success btn-sm">Add tag</button>';
                    tasksHTML += '</div>';
                    tasksHTML += '</td>';
                    tasksHTML += '<td>' + task.name + '</td>';
                    tasksHTML += '<td><button id="deleteTaskButton" class="btn btn-danger" data-taskid="' + task.id + '">Delete</button></td>';
                    tasksHTML += '</tr>';
                });

                tasksHTML += '<tr id="hasTaskListId" data-tasklistid="' + taskListId + '">';
                tasksHTML += '<td><input type="file" class="custom-file-input" id="newTaskInputImage" style="display: none"><label class="custom-file-label" for="newTaskInputImage">Choose file</label></td>';
                tasksHTML += '<td></td>';
                tasksHTML += '<td><input id="newTaskInput" type="text" class="input-group-sm" style="width: 100%"></td>';
                tasksHTML += '<td><button id="newTaskButton" class="btn btn-success">New</button></td>';
                tasksHTML += '</tr>';

                $('#tasks').html(tasksHTML);

                setLoadingStatus(false);
            },
            error: function(error) {
                alert('Произошла ошибка при обновлений задачи.');
                setLoadingStatus(false);
            }
        });
    }

    function getIndexTasks(tags, filter) {
        setLoadingStatus(true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tasks',
            type: 'GET',
            data: { filter: filter, tag_ids: tags},
            success: function(response) {
                var tasks = response;
                var tasksHTML = '';

                tasksHTML += '<tr>';
                tasksHTML += '<td>Task image</td>';
                tasksHTML += '<td>Tag</td>';
                tasksHTML += '<td>Name</td>';
                tasksHTML += '<td>Action</td>';
                tasksHTML += '</tr>';

                $.each(tasks, function(index, task) {
                    tasksHTML += '<tr>';
                    if (task.image == null) {
                        tasksHTML += '<td><img src="img/no-image-icon-23486.gif" alt="no_img_icon"></td>';
                    } else {
                        tasksHTML += '<td>' + task.image.thumbnail_path + '</td>';
                    }
                    tasksHTML += '<td>'
                    $.each(task.tags, function(index, tag) {
                        tasksHTML += '<div class="tag">' + tag.name + '</div>';
                    });
                    
                    tasksHTML += '</td>';
                    tasksHTML += '<td>' + task.name + '</td>';
                    tasksHTML += '<td><button id="deleteTaskButton" class="btn btn-danger" data-taskid="' + task.id + '">Delete</button></td>';
                    tasksHTML += '</tr>';
                });

                $('#tasks').html(tasksHTML);

                setLoadingStatus(false);
            },
            error: function(error) {
                alert('Произошла ошибка при обновлений задачи.');
                setLoadingStatus(false);
            }
        });
    }

    // function clearNewTaskName() {
    //     $('#newTaskName').html(taskHTML);;
    // }

    function createTask(tasklistId, title) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.post('/tasks/new', { name: title, task_list_id: tasklistId });
    }

    function deleteTask(id, tasklistId) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tasks/' + id,
            type: 'DELETE',
            success: function(response) {
                getTasks(tasklistId);
            },
            error: function(error) {
                alert('Произошла ошибка при удалении задачи.');
            }
        });
    }
    // FUNCTIONS END===================

    $(document).on('click', '#newTaskButton', function() {
        var tasklistId = $(this).parent().parent().data('tasklistid');
        var image = $('#newTaskInputImage').val();
        var title = $('#newTaskInput').val();
        console.log(image)
        createTask(tasklistId, title);
        getTasks(tasklistId);
    });

    $(document).on('click', '#deleteTaskButton', function() {
        var tasklistId = $('#hasTaskListId').data('tasklistid');
        var taskId = $(this).data('taskid');
        deleteTask(taskId, tasklistId);
    });

    $(document).on('click', '#taskList', function() {
        var tasklistId = $(this).parent().data('tasklistid');
        getTasks(tasklistId);
    });

    $(document).on('click', '.newTagPopupContainerButton', function() {
        var tasklistId = $('#hasTaskListId').data('tasklistid');
        getTasks(tasklistId);
    });

    $(document).ready(function() {
        $("#searchInput" ).autocomplete();
    });

    $('#searchButton').click(function() {
        var $select = $('#tagsMultipleSelect');
        var filter = $('#searchInput').val();
        var data = $select.multipleSelect('getData');
        selectTags = [];
        for (tag in data) {
            if (data[tag].selected == true) {
                selectTags.push(data[tag].value);
            }
        }

        if (selectTags.length > 0 && filter != '') {
            getIndexTasks(selectTags, filter);
        } else if (selectTags.length > 0) {
            getIndexTasks(selectTags);
        } else if (filter !== '') {
            getIndexTasks([], filter);
        }
    })
});