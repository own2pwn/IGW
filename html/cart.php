<?php
    include_once 'inc/CRUD.php';
    include_once 'inc/SessionService.php';
    include_once 'presentation/CartDataProvider.php';

    $db          = new CRUD();
    $session     = SessionService::getSharedInstance();
    $cartService = new CartService($session);
    $cart        = new CartDataProvider($db, $cartService);

    $cart->fetchItems();
    if ($cart->getItemsCount() <= 0)
        exit(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата</title>
    <meta name="description" content="@Dogonasheva Online Shop"/>

    <!-- ICON -->
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="css/default.css"/>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="css/component.css"/>
    <link rel="stylesheet" type="text/css" href="css/feedback.css"/>
    <link rel="stylesheet" type="text/css" href="css/cart.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="js/modernizr.custom.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <!-- If you're using Stripe for payments -->
    <script src="js/jquery.payment.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <style>
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }

        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
        }

        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }

        .credit-card-box .payment-errors {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }

        .credit-card-box label {
            display: block;
        }

        /* The old "center div vertically" hack */
        .credit-card-box .display-table {
            display: table;
        }

        .credit-card-box .display-tr {
            display: table-row;
        }

        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }

        /* Just looks nicer */
        .credit-card-box .panel-heading img {
            min-width: 180px;
        }
    </style>
</head>
<body>
<div class="container1">

    <div class="top-header" id="home">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt=""/></a>
            </div>
        </div>
    </div>

    <div class="container wrapper">
        <div class="row cart-head">

            <div class="row">
                <p>
                <h1 style="text-align: center">Заполните информацию</h1></p>
            </div>

        </div>
        <div class="row cart-body">
            <form class="form-horizontal" method="post" action="">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Ваш заказ
                            <div class="pull-right"></div>
                        </div>
                        <div class="panel-body">

                            <?php
                                /** @var Item $item */
                                foreach ($cart->getItems() as $item) {
                                    ?>
                                    <div class="form-group" id="cart-id" value="<?php echo $item->id ?>">
                                        <div class="col-sm-3 col-xs-3">
                                            <img class="img-responsive"
                                                 src="images/<?php echo $item->getImagePath() ?>"/>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="col-xs-12"><?php echo $item->title ?></div>
                                            <div class="col-xs-12">
                                                <small>
                                                    Количество:<span><?php echo $cart->getItemQuantity($item); ?></span>
                                                    <form>
                                                        <table cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td rowspan="2"><input type="text"
                                                                                       disabled="disabled"
                                                                                       name="number"
                                                                                       id="cart-qty"
                                                                                       value="<?php echo $cart->getItemQuantity($item); ?>"
                                                                                       style="width:50px;height:23px;font-weight:bold;"/>
                                                                </td>
                                                                <td><input type="button" value=" /\ "
                                                                           onclick="if (this.form.number.value < 4){this.form.number.value++;$('#cart-item-price').text(this.form.number.value*($('#price').text()));$('#total').text(this.form.number.value*($('#price').text()) + 150);}"
                                                                           style="font-size:7px;margin:0;padding:0;width:20px;height:13px;"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type=button value=" \/ "
                                                                           onclick="if (this.form.number.value > 1)
		 	{ this.form.number.value--; $('#cart-item-price').text(this.form.number.value*($('#price').text())); $('#total').text(this.form.number.value*($('#price').text()) + 150);}"
                                                                           style="font-size:7px;margin:0;padding:0;width:20px;height:13px;"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-3 text-right"><span
                                                    id="price"><?php echo($item->price) ?></span><span>₽</span>
                                        </div>
                                    </div>

                                    <!-- HR -->
                                    <div class="form-group">
                                        <hr/>
                                    </div>

                                    <!-- Subtotal + Shipping -->
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <strong>Подытог</strong>
                                            <div class="pull-right">
                                                <span id="cart-item-price"><?php echo $cart->getItemSubtotal($item) ?></span><span>₽</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <small>Доставка</small>
                                            <div class="pull-right"><span>150₽</span></div>
                                        </div>
                                    </div>

                                    <!-- HR -->
                                    <div class="form-group">
                                        <hr/>
                                    </div>

                                    <?php
                                }
                            ?>

                            <!-- HR -->
                            <div class="form-group">
                                <hr/>
                            </div>

                            <?php
                                $order_total = $cart->getTotalSum();

                                if ($order_total > 0) {
                                    ?>
                                    <!-- Order Total -->
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <strong>Итог</strong>
                                            <div class="pull-right">

                                                <span id="total"><?php echo $order_total + 150 ?></span><span>₽</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {

                                }
                            ?>
                        </div>

                    </div>

                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Адрес</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Адрес доставки</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Имя:</strong>
                                    <input id="cart-fn" type="text" name="first_name" class="form-control" value=""/>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Фамилия:</strong>
                                    <input id="cart-ln" type="text" name="last_name" class="form-control" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Адрес:</strong></div>
                                <div class="col-md-12">
                                    <input id="cart-addr" type="text" name="address" class="form-control" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Страна:</strong></div>
                                <div class="col-md-12">
                                    <input id="cart-cntry" type="text" class="form-control" name="country" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Почтовый индекс:</strong></div>
                                <div class="col-md-12">
                                    <input id="cart-zip" type="text" name="zip_code" class="form-control" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email:</strong></div>
                                <div class="col-md-12"><input type="text" id="cart-email" name="email_address"
                                                              class="form-control"
                                                              value=""/></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <!--
                                        <div class="panel panel-info">
                                            <div class="panel-heading"> Secure Payment</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-12"><strong>Card Type:</strong></div>
                                                    <div class="col-md-12">
                                                        <select id="CreditCardType" name="CreditCardType" class="form-control">
                                                            <option value="VISA">Visa</option>
                                                            <option value="MC">MasterCard</option>
                                                            <option value="AE">American Express</option>
                                                            <option value="DSV">Discover</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                                    <div class="col-md-12"><input type="text" class="form-control" id="cart-ccn"
                                                                                  name="car_number"
                                                                                  value=""/></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12"><strong>Card CVV:</strong></div>
                                                    <div class="col-md-12"><input type="text" class="form-control" id="cart-cvv"
                                                                                  name="car_code"
                                                                                  value=""/></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <strong>Expiration Date</strong>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <select id="cart-mnth" class="form-control" name="">
                                                            <option value="">Month</option>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <select id="cart-year" class="form-control" name="">
                                                            <option value="">Year</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="gridEmail">
                                                            <label class="form-check-label" for="gridEmail">
                                                                Get our latest news
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="gridAgree">
                                                            <label class="form-check-label" for="gridAgree">
                                                                Agreed with license agreement
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <button id="send" class="btn btn-success btn-submit-fix" disabled="disabled"><a
                                                                    href="thankyou.html">Place Order</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    -->
                    <!--CREDIT CART PAYMENT END-->


                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table">
                            <div class="row display-tr">
                                <h3 class="panel-title display-td">Оплата</h3>
                                <div class="display-td">
                                    <img class="img-responsive pull-right"
                                         src="http://i76.imgup.net/accepted_c22e0.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">CARD NUMBER</label>
                                            <div class="input-group">
                                                <input
                                                        type="tel"
                                                        class="form-control"
                                                        name="cardNumber"
                                                        placeholder="Valid Card Number"
                                                        autocomplete="cc-number"
                                                        required autofocus
                                                        id="cart-ccn"
                                                />
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="cardExpiry"><span class="hidden-xs"></span><span
                                                        class="visible-xs-inline">Дата окончания обслуживания</span></label>
                                            <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardExpiry"
                                                    placeholder="MM / YY"
                                                    autocomplete="cc-exp"
                                                    required
                                                    id="frm-date"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cardCVC">CV CODE</label>
                                            <input
                                                    type="password"
                                                    class="form-control"
                                                    name="cardCVC"
                                                    placeholder="CVC"
                                                    autocomplete="cc-csc"
                                                    required
                                                    id="cart-cvv"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridEmail">
                                            <label class="form-check-label" for="gridEmail" style="display: inline">
                                                Получать новости о нас
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 15px">
                                        <!--
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" id="gridAgree">
                                                                                <label class="form-check-label" for="gridAgree" style="display: inline">
                                                                                    Agreed with license agreement
                                                                                </label>
                                                                            </div>
                                        -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <a style="text-decoration: none">
                                            <button id="frm-send" class="subscribe btn btn-success btn-lg" type="button"
                                                    style="background-color: green;">Купить
                                            </button>
                                            <label id="form-error" class="hidden" style="color: red">
                                                Не все поля заполнены!
                                            </label>
                                        </a>
                                    </div>
                                </div>
                                <div class="row" style="display:none;">
                                    <div class="col-xs-12">
                                        <p class="payment-errors"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="row cart-footer">

        </div>
    </div>

    <div class="footer" style="background: #1c242b">
        <div class="up-arrow" id="arr">
            <a class="scroll" href="#home"><img src="images/up.png" alt=""></a>
        </div>
        <div class="container">
            <div class="copyrights">
                <p>Copyright © 2018 All rights reserved | Made by <a href="https://indexStorm.com">indexStorm</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="feedback">
        <div id="feedback-form" style='z-index: 10000' class="col-xs-4 col-md-4 panel panel-default">
            <form method="POST" action="/feedback" class="form panel-body" role="form">
                <div class="form-group">
                    <input class="form-control" name="email" autofocus placeholder="Ваш e-mail" type="email"/>
                </div>
                <div class="form-group" style="z-index: 10000">
                    <textarea class="form-control" name="body" required placeholder="Введите свой вопрос..."
                              rows="5"></textarea>
                </div>
                <button class="btn btn-primary pull-right" type="submit">Отправить</button>
            </form>
        </div>
        <div id="feedback-tab" style="width: 132px;">Есть вопрос?</div>
    </div>


    <script src="js/grid.js"></script>
    <script src="js/feedback.js"></script>
    <script src="js/cart-place-order.js"></script>

    <!--
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
            });
        });
    </script>
    <script type="text/javascript">
        $("#gridAgree").click(function () {

            if ($('#gridAgree').is(":checked")) {
                $("#send").prop('disabled', false);
            } else {
                $("#send").prop('disabled', true);
            }
        });
    </script>
    <script type="text/javascript">
        $("#feedback-tab").click(function () {
            $("#feedback-form").toggle("slide");
        });
        $(document).click(function (event) {
            if (!$(event.target).closest("#feedback").length) {
                if ($('#feedback-form').is(":visible")) {
                    $('#feedback-form').toggle("slide");
                }
            }
        });
    </script>
    <script>
        var $form = $('#payment-form');
        $form.find('.subscribe').on('click', payWithStripe);

        /* If you're using Stripe for payments */
        function payWithStripe(e) {
            e.preventDefault();

            /* Abort if invalid form data */
            if (!validator.form()) {
                return;
            }

            /* Visual feedback */
            $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

            var PublishableKey = 'pk_test_6pRNASCoBOKtIshFeQd4XMUh'; // Replace with your API publishable key
            Stripe.setPublishableKey(PublishableKey);

            /* Create token */
            var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
            var ccData = {
                number: $form.find('[name=cardNumber]').val().replace(/\s/g, ''),
                cvc: $form.find('[name=cardCVC]').val(),
                exp_month: expiry.month,
                exp_year: expiry.year
            };

            Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
                if (response.error) {
                    /* Visual feedback */
                    $form.find('.subscribe').html('Try again').prop('disabled', false);
                    /* Show Stripe errors on the form */
                    $form.find('.payment-errors').text(response.error.message);
                    $form.find('.payment-errors').closest('.row').show();
                } else {
                    /* Visual feedback */
                    $form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
                    /* Hide Stripe errors on the form */
                    $form.find('.payment-errors').closest('.row').hide();
                    $form.find('.payment-errors').text("");
                    // response contains id and card, which contains additional card details
                    console.log(response.id);
                    console.log(response.card);
                    var token = response.id;
                    // AJAX - you would send 'token' to your server here.
                    $.post('/account/stripe_card_token', {
                        token: token
                    })
                    // Assign handlers immediately after making the request,
                        .done(function (data, textStatus, jqXHR) {
                            $form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            $form.find('.subscribe').html('There was a problem').removeClass('success').addClass('error');
                            /* Show Stripe errors on the form */
                            $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                            $form.find('.payment-errors').closest('.row').show();
                        });
                }
            });
        }

        function getlength(number) {
            return number.toString().length;
        }

        /* Fancy restrictive input formatting via jQuery.payment library*/
        $('input[name=cardNumber]').payment('formatCardNumber');
        $('input[name=cardCVC]').payment('formatCardCVC');
        $('input[name=cardExpiry').payment('formatCardExpiry');

        /* Form validation using Stripe client-side validation helpers */
        jQuery.validator.addMethod("cardNumber", function (value, element) {
            var len = getlength(value);
            if (len == 16) {
                return true
            }

            return this.optional(element) || Stripe.card.validateCardNumber(value);
        }, "Please specify a valid credit card number.");


        jQuery.validator.addMethod("cardExpiry", function (value, element) {
            /* Parsing month/year uses jQuery.payment library */
            value = $.payment.cardExpiryVal(value);
            return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
        }, "Invalid expiration date.");

        jQuery.validator.addMethod("cardCVC", function (value, element) {
            return this.optional(element) || Stripe.card.validateCVC(value);
        }, "Invalid CVC.");

        validator = $form.validate({
            rules: {
                cardNumber: {
                    required: true,
                    cardNumber: true
                },
                cardExpiry: {
                    required: true,
                    cardExpiry: true
                },
                cardCVC: {
                    required: true,
                    cardCVC: true
                }
            },
            highlight: function (element) {
                $(element).closest('.form-control').removeClass('success').addClass('error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-control').removeClass('error').addClass('success');
            },
            errorPlacement: function (error, element) {
                $(element).closest('.form-group').append(error);
            }
        });

        paymentFormReady = function () {
            if ($form.find('[name=cardNumber]').hasClass("success") &&
                $form.find('[name=cardExpiry]').hasClass("success") &&
                $form.find('[name=cardCVC]').val().length > 1) {
                return true;
            } else {
                return false;
            }
        }

        $form.find('.subscribe').prop('disabled', true);
        var readyInterval = setInterval(function () {
            if (paymentFormReady()) {
                $form.find('.subscribe').prop('disabled', false);
                clearInterval(readyInterval);
            }
        }, 250);
    </script>
    -->

</body>
</html>