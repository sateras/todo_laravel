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
                        tasksHTML += '<td>';
                        tasksHTML += '<div class="noImageImgDiv">';
                        tasksHTML += '<img src="img/no-image-icon-23486.gif" alt="no_img_icon">';
                        tasksHTML += '<div class="noImageImgOverlayDiv"><label for="noImageImgDivInput' + task.id + '">Choose image</label><input id="noImageImgDivInput' + task.id + '" type="file" class="noImageImgDivInput"><button class="noImageImgDivButton">Upload</button></div>';
                        tasksHTML += '</div>';
                        tasksHTML += '</td>';
                    } else {
                        tasksHTML += '<td><img class="taskImg" src="' + task.image.thumbnail_path + '" alt="task_img"></td>';
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
                tasksHTML += '<td></td>';
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
                        tasksHTML += '<td><img class="taskImg" src="' + task.image.thumbnail_path + '" alt="no_img_icon"></td>';
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

    $(document).on('mouseover', '.noImageImgDiv', function() {
        var coordinates = $(this).offset();
        var noImageImgOverlayDiv = $(this).children('.noImageImgOverlayDiv');

        noImageImgOverlayDiv.css({
            top: coordinates.top,
            left: coordinates.left
        }).show();
    });

    $(document).on('mouseleave', '.noImageImgDiv', function() {
        $(".noImageImgOverlayDiv").hide();
    });

    $(document).on('click', '.noImageImgDivButton', function() {
        var image = $(this).prev();
        var formData = new FormData();
        var taskId = $(this).parent().parent().parent().next().next().next().children('#deleteTaskButton').data("taskid");
        var taskListId = $('#hasTaskListId').data('tasklistid');
        formData.append('image', image.prop('files')[0]);

        $.ajax({
            url: '/tasks/' + taskId + '/images',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                getTasks(taskListId);
            },
            error: function(error) {
                console.log('Произошла ошибка при загрузке фото.');
            }
        });
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