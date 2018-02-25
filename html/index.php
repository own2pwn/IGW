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
    <style>
        a {
            cursor: pointer;
        }
    </style>
</head>
<body <!--style="background: #1c242b"-->
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
	<section id="services" class="services bg-primary" style="background-color: #E8F2F6"> <!--#E8F2F6-->
          <div class="container">
              <div class="row text-center" style="color: black">
                  <div class="col-lg-10 col-lg-offset-1">
                      <hr class="small"> <!-- TODO: Look for hr classes -->
                      <div class="row">
                          <div class="col-md-4 col-sm-6" >
                              <div class="service-item"style="
							    border: solid 10px #B1BBBF;
							    border-radius: 30px;
							    padding: 10px;
							    border-bottom-color: #1C3DC1;">
                                  <span class="fa-stack fa-4x">
                                  <i class="fa fa-circle fa-stack-2x" style="color: #1C3DC1"></i>
                                  <i class="fa fa-user fa-stack-1x text-primary" style="color: white"></i>
                              </span>
                                  <h3>
                                      <strong>Я волонтёр</strong>
                                  </h3>
                                  <p>Примите участие в качестве волонтёра и
                                    присоединитесь к команде организаторов.</p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <div class="service-item"  style="
							    border: solid 10px #B1BBBF;
							    border-radius: 30px;
							    padding: 10px;
								border-bottom-color: #FFD700;">
                                  <span class="fa-stack fa-4x">
                                  <i class="fa fa-circle fa-stack-2x" style="color: white"></i>
                                  <i class="fa fa-trophy fa-stack-1x text-primary" style="color: #FFD700"></i>
                              </span>
                                  <h3>
                                      <strong>Я конкурсант</strong>
                                  </h3>
                                  <p style="font-size: 18px"> 
	                                  Примите непосредственное участие в фестивале и получите ценные призы.</p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <div class="service-item"  style="
								  border: solid 10px #B1BBBF;
								  border-radius: 30px;
								  padding: 10px;
								  border-bottom-color: #C40E0E;">
                                  <span class="fa-stack fa-4x">
                                  <i class="fa fa-circle fa-stack-2x" style="color: #C40E0E"></i>
                                  <i class="fa fa-thumbs-o-up fa-stack-1x text-primary" style="color: white"></i>
                              </span>
                                  <h3>
                                      <strong>Я жюри</strong>
                                  </h3>
                                  <p>Определите самые креативные и достойные проекты, которые мы наградим призами.</p>
                              </div>
                          </div>
                      </div>
                      <!-- /.row (nested) -->
                  </div>
                  <!-- /.col-lg-10 -->
              </div>
              <!-- /.row -->
          </div>
          <!-- /.container -->
      </section>
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


<div  class="container" style="width: 100%">
    <div id="feedback-form-btn" class="subscribe-section" style="font-family: sans-serif">
        <div class="subscribe text-center" id="appearThen" hidden="true">
            <h4>Спасибо!</h4>
        </div>

        <div class="subscribe text-center" id = "kokes">
            <h4>Подпишитесь на нашу рассылку</h4>
            <input type="text" class="text" value="Ваш email..." id="email-text" onfocus="this.value = '';"
                   onblur="if (this.value == '') {this.value = 'Ваш email...';}">
            <input type="submit" value="Подписаться" id="btn-subscribe">
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
        if (!$(event.target).closest("#feedback").length && !$(event.target).closest("#btn-subscribe").length) {
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