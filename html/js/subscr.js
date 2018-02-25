$(function () {
    $("#btn-subscribe").click(function (e) {
        $.ajax({
            type: 'POST',
            url: '/api/subscribe.php',
            data: {email: $("#email-text").val()},
            success: function () {
                $("#email-text").val('Subscribed!');
                $('#appearThen').show();
                $('#kokes').hide();

            }
        });
    })


});
