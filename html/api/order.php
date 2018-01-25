<?php2

    $first_name  = $_POST['fn'];
    $last_name   = $_POST['ln'];
    $address     = $_POST['addr'];
    $country     = $_POST['cntry'];
    $zip         = $_POST['zip'];
    $email       = $_POST['email'];
    $product_id  = $_POST['pr_id'];
    $card_issuer = $_POST['c_type'];
    $card_number = $_POST['c_num'];
    $cvv         = $_POST['cvv'];
    $exp_mon     = $_POST['exp_mon'];
    $exp_yr      = $_POST['exp_yr'];
    $qty         = $_POST['qty'];


    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
    include_once $ROOT_PATH . '/inc/CRUD.php';

    $db     = new CRUD();
    $insert = $db->prepare('INSERT INTO orders VALUES 
                          (DEFAULT, :fn,      :ln,
                          :addr, 
                          :cntry,   :zip,     :email,
                          :pr_id,   :c_type,  :c_num,
                          :cvv,     :qty)');

    $insert->bindParam('fn', $first_name);
    $insert->bindParam('ln', $last_name);
    $insert->bindParam('addr', $address);
    $insert->bindParam('cntry', $country);
    $insert->bindParam('zip', $zip);
    $insert->bindParam('email', $email);
    $insert->bindParam('pr_id', $product_id);
    $insert->bindParam('c_type', $card_issuer);
    $insert->bindParam('c_num', $card_number);
    $insert->bindParam('cvv', $cvv);
    $insert->bindParam('qty', $qty);

    $insert->execute();

    var_dump($insert->errorInfo());