
<?php
    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';
    include_once $ROOT_PATH . '/inc/SessionService.php';
    include_once $ROOT_PATH . '/admin/service/AuthService.php';
    include_once $ROOT_PATH . '/presentation/FeedbackDataProvider.php';
    include_once $ROOT_PATH . '/admin/service/DashboardService.php';

    $db        = new CRUD();
    $session   = SessionService::getSharedInstance();
    $auth      = new AuthService($db, $session);
    $feedback  = new FeedbackDataProvider($db);
    $dashboard = new DashboardService($db, $feedback);

    if (!$auth->isAuthorized())
        exit(0);

    $messages = $dashboard->getFeedbackMessages();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Products</title>
    <link href="/admin/css/Dashboard.css" rel="stylesheet">
    <style>
	    .widget .panel-body { padding:0px; }
		.widget .list-group { margin-bottom: 0; }
		.widget .panel-title { display:inline }
		.widget .label-info { float: right; }
		.widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
		.widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
		.widget .mic-info { color: #666666;font-size: 11px; }
		.widget .action { margin-top:5px; }
		.widget .comment-text { font-size: 12px; }
		.widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
		.glyphicon {
		    position: relative;
		    top: 1px;
		    display: inline-block;
		    font-family: 'Glyphicons Halflings';
		    -webkit-font-smoothing: antialiased;
		    font-style: normal;
		    font-weight: normal;
		    line-height: 1;
		}
		.row {
			margin-right: -15px;
			margin-left: -15px;
		}
	</style>
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
	    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Menu</a>
	    <div class=" form-control-dark w-100"></div>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/admin/logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="/admin/view/Dashboard1.php">
                  <span data-feather="file"></span>
                  Orders
<!--                   TODO DELETE -->
                  <!-- <span class="sr-only">(current)</span> -->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/view/Dashboard.php">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="inbox"></span>
                  Questions
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="container">
    	<div class="row1">
        <div class="panel panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    User's Questions</h3>
                <span class="label label-info">
                    <?php echo(sizeof($messages))?></span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
	                <?php 
		                foreach ($messages as $message) {
			                $who = $message->who;
							$feedback_message = $message->message;
			                echo "
                    <li class='list-group-item'>
                        <div class='row1'>
                            <div class='col-xs-10 col-md-11'>
                                <div>
                                    <div class='mic-info'>
                                        By: <a href='#'>$who</a>
                                    </div>
                                </div>
                                <div class='comment-text'>
                                    <p style='font-size: 1rem;font-weight: 400;'>$feedback_message</p>
                                </div>
                                <div class='action'>
                                    <button type='button' class='btn btn-primary btn-xs' title='Edit'>
                                        <span data-feather='corner-left-up'></span>
                                    </button>
                                    <button type='button' class='btn btn-danger btn-xs' title='Delete'>
                                        <span data-feather='trash-2'></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    ";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
		</div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>