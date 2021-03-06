<?php

//enable on-demand class loader
require_once 'vendor/autoload.php';

//Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));


DB::$dbName = 'slimads';
DB::$user = 'slimads';
DB::$password = 'hBxTsjtSTt5ZWnEQ';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: ".$params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query break
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: ".$params['error']);
    $log->error(" in query: ".$params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query break
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

//Global Conditions
\Slim\Route::setDefaultConditions(array(
    'id' =>'\d+'
));

$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');

$app->get('/', function ()use ($app) {
    $adList = DB::query('SELECT * FROM ad');
    $app->render('index.html.twig', array('adList' => $adList));
});

//Submission (function($id='')means 'with optional parameter'
$app->post('/postadform(/:id)', function($id='') use ($app, $log){
    $msg = $app->request->post('msg');
    $price = $app->request->post('price');
    $contactEmail = $app->request->post('contactEmail');
    $valueList = array(
        'msg' => $msg,
        'price' => $price,
        'contactEmail' => $contactEmail);
    $errorList = array();

    //message check:must be between 5 and 300 characters long
    if ((strlen($msg) < 5) || (strlen($msg) > 300)) {
        array_push($errorList,
                "Message must be between 5 and 300 characters long.");
        //unset($valueList['msg']);
    }
    //price check: price must be provided
    if ($price == "") {
        array_push($errorList, 
                "Price must be provided.");
    }
    //price check: price must be numbers
    if (!is_numeric($price)) {
        array_push($errorList,
                "Price must be numbers.");
        unset($valueList['price']);
    }
    //price check: price must be between 0 and 1 million dollars
    if (($price < 0) || ($price > 1000000)) {
        array_push($errorList,
                "Price must be between 0 and 1 million dollars.");
        unset($valueList['price']);
    }
    //email check: looks like a valid email
    if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList,
                "Email does not look like a valid email.");
        unset($valueList['contactEmail']);
    }
    if ($errorList) {
        //State 3: failed submission
        $app->render('postadform.html.twig', array(
            'errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        //State 2:successful submission
        //inserting into database
        if($id===''){
        DB::insert('ad', array(
            'msg' => $msg,
            'price' => $price,
            'contactEmail' => $contactEmail
        ));
        $id=DB::insertId();
        $log->debug("Ad created with ID=".$id);
        }else{
        DB::update('ad', array(
            'msg' => $msg,
            'price' => $price,
            'contactEmail' => $contactEmail
        ), 
                'ID=%s', $id);
        $log->debug("Ad updated with ID=".$id);
        } 
        //Show the user his creation
        $app->render('postadform_success.html.twig', 
                array(
                    'msg' => $msg, 
                    'price' => $price, 
                    'contactEmail' => $contactEmail));
    }
});

//Edit ad
$app->get('/postadform(/:id)', function($id='') use ($app){
    if ($id === ''){
        $app->render('postadform.html.twig');
        return;
    }
    $ad=DB::queryOneRow("SELECT * FROM ad WHERE ID=%d", $id);
    if(!$ad){
        $app->render("editad_notfound.html.twig");        
    }else{
        $app->render("postadform.html.twig", array("v" => $ad));
    }
});

$app->post('/editad/:id', function($id) use ($app) {    
});

$app->run();