$(function() {
    $('#emailModal').on('shown.bs.modal', function(event) {
        emailName.focus();
    });

    $('#cancelSendEmail').on('click', function(event) {
        $(this).closest('form').find("input[type=text], input[type=email], textarea").val("");
    });
});