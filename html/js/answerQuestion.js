$(function () {
    $(".btn-answer-q").click(function (e) {
        var form = $(this)[0].form;
        var recipient = form[0].value;
        var text = form[1].value;

        $.ajax({
            type: 'POST',
            url: '/api/mail/answerQuestion.php',
            data: {
                answer: text,
                recipient: recipient
            },
            success: function () {
                console.log('success');
                //location.href = '/admin/view/Questions.php';
            }
        });
    })
});