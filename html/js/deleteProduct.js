$(function () {
    $(".btn-danger").click(function (e) {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: '/api/deleteProduct.php',
            data: {
                id: id
            },
            success: function () {
                location.href = '/admin/view/Dashboard.php';
            }
        });
    })
});