$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function getIndexTasksForSearch(availableTasks) {
        var availableTasks = [];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tasks',
            type: 'GET',
            success: function(response) {
                var tasks = response;
                $.each(tasks, function(index, task) {
                    availableTasks.push(task.name);
                });
                $("#searchInput").autocomplete( "option", "source", availableTasks );
            },
        });
    }

    function getIndexTagsForSearch() {
        var availableTags = [];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/tags',
            type: 'GET',
            success: function(response) {
                var tags = response;

                $.each(tags, function(index, tag) {
                    var $opt = $('<option />', {
                        value: tag.id,
                        text: tag.name
                    })
                    var $select = $('#tagsMultipleSelect')
                    $select.append($opt).multipleSelect('refresh')
                });
            },
        });
    }

    getIndexTasksForSearch();
    getIndexTagsForSearch();
});