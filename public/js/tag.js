var csrfToken = $('meta[name="csrf-token"]').attr('content');

$( function() {
    var $select = $('#tagsMultipleSelect')
    $(function () {
        $select.multipleSelect({
            classes: 'form-control',
        })
    });
});

function addTagToTask(taskId, tagName) {
    // setLoadingStatus(true);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/tasks/' + taskId + '/tags',
        type: 'POST',
        data: { tag: tagName},
        success: function(response) {
            // setLoadingStatus(false);
        },
        error: function(error) {
            // setLoadingStatus(false);
            alert('Произошла ошибка.');
        }
    });
}

$(document)
.on("click", '.tag_plus_btn', function(e) {
    var taskListName = $(this);
    var taskListInput = taskListName.parent().next();
    
    taskListInput.css({
        top: e.pageY + 10,
        left: e.pageX
    }).show();

    taskListInput.children('.newTagInputPopupContainer').focus();
})
.on("click", '.newTagPopupContainerButton', function(e) {
    var newTagInputPopupContainer = $(this).prev();
    var tagName = newTagInputPopupContainer.val();
    var taskId = $(this).parent().parent().next().next().children().data('taskid');
    newTagInputPopupContainer.val('');
    console.log(tagName);
    addTagToTask(taskId, tagName);
})
.on("blur", '.newTagInputPopupContainer', function(e) {
    var taskListName = $('.tag_plus_btn');
    var taskListInput = taskListName.parent().next();
    setTimeout(function() {
        taskListInput.hide();
    }, 150);
});