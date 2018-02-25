$(function () {
    $(".btn").click(function (e) {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: '/api/deleteItem.php',
            data: {
                id: id
            },
            success: function () {
                location.href = '/admin/view/Dashboard1.php';
            }
        });
    })
});