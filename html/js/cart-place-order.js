$(function () {
    $("#frm-send").click(function (e) {
        var ret = validate();

        if (!ret) {
            $("#form-error").attr('class', 'mem');
        } else {
            send();
        }
    })
});

function send() {
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
}

function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
            return false;
    }

    return true;
}

function validate() {
    var data = {
        fn: $("#cart-fn").val(),
        ln: $("#cart-ln").val(),
        addr: $("#cart-addr").val(),
        cntry: $("#cart-cntry").val(),
        zip: $("#cart-zip").val(),
        email: $("#cart-email").val(),
        pr_id: $("#cart-id").attr('value'),
        //c_type: $("#CreditCardType").val(),
        c_num: $("#cart-ccn").val(),
        cvv: $("#cart-cvv").val(),
        // exp_mon: $("#cart-mnth").val(),
        //exp_yr: $("#cart-year").val(),
        qty: $("#cart-qty").val(),
        exp: $("#frm-date").val()
    };

    console.log(data);

    // var keys = Object.keys(data);
    // keys.forEach(function (key) {
    //     var val = data[key];
    //     if (val == '') {
    //         return false;
    //     }
    //
    //     if (val === undefined) {
    //         return false;
    //     }
    //
    //     console.log(key, val);
    // });

    for (var e in data) {
        var v = data[e];
        if (v === undefined) {
            $("#form-error").attr('class', '');
            return false;
        }

        if (v == '') {
            return false;
        }


    }
    return true;
}