$(function() {
    $('#editModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        console.log(button.data('published'));
        
        $('#editTitle').val(button.data('title'));
        $('#editDescription').val(button.data('description'));
        $('#editPublished').prop("checked", button.data('published'));
        $('#editImage').attr("src", button.data('image'));

        $('#edit-form-action').attr("action", "posts/" + button.data('id'));
    });
});