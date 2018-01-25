<?php
    include 'inc/CRUD.php';
    include_once 'presentation/MainPageDataProvider.php';

    $db            = new CRUD();
    $data_provider = new MainPageDataProvider($db);

    $data_provider->fetchItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@Dogonasheva Online Shop</title>
    <meta name="description" content="@Dogonasheva Online Shop"/>

    <!-- ICON -->
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/default.css"/>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="css/component.css"/>
    <link rel="stylesheet" type="text/css" href="css/feedback.css"/>
    <script src="js/modernizr.custom.js"></script>
</head>
<body>
<div class="container1">
    <div class="header" id="home">
        <div class="top-header">
            <div class="container">
                <div class="logo">
                    <a href="index.php"><img src="images/logo.png" alt=""/></a>
                </div>
            </div>
        </div>
        <div class="banner">
            <div class="banner-info text-center">
                <h3>@Dogonasheva Online Shop</h3>
            </div>
        </div>
    </div>

    <div class="main" id="kok">
        <ul id="og-grid" class="og-grid">

            <?php
                $items = $data_provider->getItems();

                /** @var Item $item */
                foreach ($data_provider->getItems() as $item) {
                    ?>

                    <li class="koks" id="main-li-img">
                        <a data-largesrc="images/<?php echo $item->getImagePath() ?>"
                           data-title="<?php echo $item->title ?>"
                           data-description="<?php echo $item->description ?>"
                           data-id="<?php echo $item->id ?>"
                           data-price="<?php echo $item->price ?>">
                            <img src="images/<?php echo $item->getImagePath() ?>" class="testImage" alt="img01"/>
                        </a>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>
</div><!-- /container -->


<div class="container" style="width: 100%">
    <div id="feedback-form-btn" class="subscribe-section" style="font-family: lato">
        <div class="subscribe text-center">
            <h4>Subscribe To Our Newsletter</h4>
            <input type="text" class="text" value="Your email..." id="email-text" onfocus="this.value = '';"
                   onblur="if (this.value == '') {this.value = 'Your email...';}">
            <input type="submit" value="Subscribe" id="btn-subscribe">
        </div>
        <div class="social-icons text-center">
            <i class="pinterest"></i>
        </div>
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
        <form method="POST" action="/api/feedback.php" class="form panel-body" role="form">
            <div class="form-group">
                <input class="form-control" name="email" autofocus placeholder="Your e-mail" type="email"/>
            </div>
            <div class="form-group" style="z-index: 10000">
                <textarea class="form-control" name="body" required placeholder="Please write your feedback here..."
                          rows="5"></textarea>
            </div>
            <button class="btn btn-primary pull-right" type="submit">Send</button>
        </form>
    </div>
    <div id="feedback-tab">Feedback</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="js/grid.js"></script>
<script src="js/feedback.js"></script>
<script src="js/subscr.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
        });
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
<script type="text/javascript">
    //     $(".koks").click(function(e){
    // // 	    console.log("kek");
    // 	    alert("lols");
    //     });
</script>
<script>
    $(function () {
        Grid.init();
    });
</script>

</body>
</html>