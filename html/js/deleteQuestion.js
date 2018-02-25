$(function () {
    $(".btn-danger").click(function (e) {
        var id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '/api/deleteQuestion.php',
            data: {
                id: id
            },
            success: function () {
                location.href = '/admin/view/Questions.php';
            }
        });
    })
});