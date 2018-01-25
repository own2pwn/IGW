$(function () {
    $("#send").click(function (e) {
        $.ajax({
            type: 'POST',
            url: '/api/order.php',
            data: {
                fn: $("#cart-fn").val(),
                ln: $("#cart-ln").val(),
                addr: $("#cart-addr").val(),
                cntry: $("#cart-cntry").val(),
                zip: $("#cart-zip").val(),
                email: $("#cart-email").val(),
                pr_id: $("#cart-id").attr('value'),
                c_type: $("#CreditCardType").val(),
                c_num: $("#cart-ccn").val(),
                cvv: $("#cart-cvv").val(),
                exp_mon: $("#cart-mnth").val(),
                exp_yr: $("#cart-year").val(),
                qty: $("#cart-qty").val()
            },
            success: function () {
                location.href = 'thankyou.html';
                $("#email-text").html('Subscribed!');
            }
        });
    })
});