<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customers</title>
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
                        <a class="nav-link" href="/admin/view/Dashboard.php">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom"
                 style="text-align: center">
                <h1 class="h2">Customers</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
                        include_once $ROOT_PATH . '/inc/CRUD.php';
                        include_once 'Subscriber.php';

                        $db = new CRUD();

                        $select = $db->prepare("SELECT * FROM subscribers");
                        $select->execute();

                        $select->setFetchMode(PDO::FETCH_CLASS, 'Subscriber');
                        $subscribers = array();

                        while ($subscriber = $select->fetch())
                            array_push($subscribers, $subscriber);


                        /** @var Subscriber $fetched_subscriber */
                        $i = 0;
                        foreach ($subscribers as $fetched_subscriber) {
                            $i += 1;
                            //echo 'Ma email - ' . $fetched_subscriber->email . '<br>';
                            echo "
                            <tr>
				            <td>$i</td>
					        <td>-</td>
					        <td>$fetched_subscriber->email</td>
					
					<td><button id='$fetched_subscriber->id' class='btn btn-danger'>Delete</button></td>
					</tr>
                            
                            
                            ";
                        }
                    ?>

                    </tbody>


                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="/js/deleteCustomer.js"></script>
<script>
    feather.replace()
</script>

</body>
</html>
