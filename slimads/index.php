<?php

//enable on-demand class loader
require_once 'vendor/autoload.php';

DB::$dbName = 'slimads';
DB::$user = 'slimads';
DB::$password = 'hBxTsjtSTt5ZWnEQ';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function sql_error_handler($params) {
    echo "Error: " . $params['error'] . "<br>\n";
    echo "Query: " . $params['query'] . "<br>\n";
    die;
}

// instantiate Slim - router in front controller (this file)
// Slim creation and setup
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
        ));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);

$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');

function nonsql_error_handler($params) {
    echo "Error: " . $params['error'] . "<br>\n";
    die; // don't want to keep going if a query broke
}

$app->get('/', function ()use ($app) {
    $adList = DB::query('SELECT * FROM ad');
    $app->render('index.html.twig', array('adList' => $adList));
});

$app->get('/postadform', function() use ($app) {
    $app->render('postadform.html.twig');
});

$app->post('/postadform', function() use ($app) {
    $msg = $app->request->post('msg');
    $price = $app->request->post('price');
    $contactEmail = $app->request->post('contactEmail');
    $valueList = array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail);
    $errorList = array();

    //message check:must be between 5 and 300 characters long
    if ((strlen($msg) < 5) || (strlen($msg) > 300)) {
        array_push($errorList, "Message must be between 5 and 300 characters long.");
        unset($valueList['msg']);
    }
    //price check: price must be provided
    if ($price == "") {
        array_push($errorList, "Price must be provided.");
    }
    //price check: price must be numbers
    if (!is_numeric($price)) {
        array_push($errorList, "Price must be numbers.");
    }
    //price check: price must be between 0 and 1 million dollars
    if (($price < 0) || ($price > 1000000)) {
        array_push($errorList, "Price must be between 0 and 1 million dollars.");
        unset($valueList['price']);
    }
    //email check: looks like a valid email
    if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email.");
        unset($valueList['contactEmail']);
    }
    if ($errorList) {
        //State 3: failed submission
        $app->render('postadform.html.twig', array('errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        //inserting into database
        if(){
        DB::insert('ad', array(
            'msg' => $msg,
            'price' => $price,
            'contactEmail' => $contactEmail
        ));
        }else{
             DB::update('ad', array(
            'msg' => $msg,
            'price' => $price,
            'contactEmail' => $contactEmail
        ));
            
        }
        }
        //State 2:successful submission
        $app->render('postadform_success.html.twig', 
                array(
                    'msg' => $msg, 
                    'price' => $price, 
                    'contactEmail' => $contactEmail));
    }
});

//Edit ad
$app->get('/postadform:ID', function($ID) use ($app) {
    $ad = DB::queryFirstRow("SELECT * FROM ad WHERE ID=%s", $ID);
    $app->render('postadform.html.twig', array('v'=>$ad));
        
    
})->conditions(array('id' =>'\d+'));

$app->run();