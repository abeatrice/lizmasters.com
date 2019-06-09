$(function() {
    $('#imageModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        $('#modalImage').attr("src", button.data('path'));
        $('#modalTitle').html(button.data('title'));
        $('#modalDescription').html(button.data('description'));
    });
});