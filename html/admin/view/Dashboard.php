
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

    /** @var FeedbackMessage $message */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file      = $_FILES['userfile'];
        
        $path_parts = pathinfo($_FILES["userfile"]["name"]);
		$extension = $path_parts['extension'];
        
        $file_type = substr($file['type'], 6);
        $file_name = $_POST['img_name'] . '.' . $extension;

        if ($dashboard->saveUploadedFile($file, $file_name)) {
            if ($dashboard->addItem($_POST, $file_name))
				echo "<script type='text/javascript'>alert('File was saved!');</script>";
            else
                echo 'No Entry added!<br>';
        } else {
	        echo "Can't move file!<br>";
        }
    }
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
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">
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
                <a class="nav-link" href="/admin/view/Questions.php">
                  <span data-feather="inbox"></span>
                  Questions
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="text-align: center">
            <h1 class="h2">Add product</h1>
          </div>
          <div class="container">
		  	<div class="bd-example" style="position: relative;
		    padding: 1rem;
		    margin: 1rem -15px 0;
		    border: solid #f7f7f9;
		    border-width: .2rem 0 0;
			padding: 1.5rem;
		    margin-right: 0;
		    margin-left: 0;
		    border-width: .2rem;">
				<form action="/admin/view/Dashboard.php?a=add" method="post" enctype="multipart/form-data">
					<div class="form-group row">
					<label class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" name="name" value="">
						</div>
					</div>
					<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
						<textarea class="form-control" name="desc" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group row">
					<label class="col-sm-2 col-form-label">Price</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" name="price" value="">
						</div>
					</div>
		
					<div class="form-group row">
					<label class="col-sm-2 col-form-label">Image name</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" name="img_name" value="">
						</div>
					</div>
		
					<div class="form-group row">
					<label class="col-sm-2 col-form-label">Image</label>
						<div class="col-sm-10">
						<input type="hidden" name="MAX_FILE_SIZE" value="3000000" class="form-control"/>
						<input type="file" class="form-control" name="userfile">
						</div>
					</div>
					<input class ="btn btn-primary" type="submit" value="Submit">
				</form>
			</div>
		</div>
		<form enctype="multipart/form-data" action="__URL__" method="POST"></form>

        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>

