$(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        
        $('#deleteTitle').val(button.data('title'));
        $('#deleteDescription').val(button.data('description'));
        $('#deletePublished').prop("checked", button.data('published'));
        $('#deleteImage').attr("src", button.data('image'));

        $('#delete-form-action').attr("action", "posts/" + button.data('id'));
    });
});