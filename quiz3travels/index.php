<?php

session_start();

// enable on-demand class loader
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'quiz3travels';
DB::$user = 'quiz3travels';
DB::$password = 'dZCGTnw5YbTb7V9N';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query breaks
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

//Default conditions
\Slim\Route::setDefaultConditions(array(
    'id' => '\d+',
    'name' => '[A-Za-z-]+',
    'from' => '[A-Z]{3}',
    'to' => '[A-Z]{3}'
));

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

$app->get('/', function() use ($app) {    
    $app->render('index.html.twig',
            array('sessionUser' => $_SESSION['user']));
});

// State 1: first show
$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $passport = $app->request->post('passport');
    $password = $app->request->post('password');
    $password2 = $app->request->post('password2');
    $valueList = array ('name' => $name, 'passport' => $passport);
    // submission received - verify
    $errorList = array();
    //name check: between 2 and 50 characters
    if ((strlen($name) < 2)||(strlen($name) > 50)) {
        array_push($errorList, "Name must be between 2 and 50 characters long.");
        unset($valueList['name']);
    }
    
    //passport check: 2 uppercase letters + 6 numbers
    if (!preg_match('/[A-Z]{2}[0-9]{6,8}/', $passport)){
        array_push($errorList, "Passport must start with 2 uppercase letters, " .
                "followed by 6 to 8 numbers.");
    }else {//passport check: already registered in database
        $user = DB::queryFirstRow("SELECT ID FROM passenger WHERE passport=%s", $passport);        
        if ($user) {
            array_push($errorList, "Passport already registered.");
            unset($valueList['passport']);
        }
    }
    
    //I bet with Gregory at least half the class would forget about the max 50 here
    //password check: 8 caracters minimum, 50 maximum
    if ((strlen($password) < 8)||(strlen($password) > 50)) {
        array_push($errorList, "Password must be at least 8 characters long, but 50 characters maximum.");
    }
    
    //password check: containing at least 1 lowercase, 1 uppercase, 1 number and 1 special character       
    $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!#$%^&*()+=<>?]).+$/';
    if (!preg_match($regexPassword, $password)) {
            array_push($errorList, "Password must contains at least 1 lowercase, 1 uppercase, 1 number and 1 specialcharacter.");
    }
    
    //password check: both passwords must be the same
    if (!$password === $password2){
        array_push($errorList,
                "Both passwords must be the same.");        
        unset($valueList['password']);
        unset($valueList['password2']);
    }  
        
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('passenger', array(
            'name' => $name, 'passport' => $passport, 'password' => $password
        ));
        $id = DB::insertId();
        $log->debug(sprintf("Passenger %s created", $id));
        
        //Show the registration creation
        $app->render('register_success.html.twig', 
                array(
            'name' => $name,           
            'passport' => $passport
        ));
    }
});

// State 1: first show
$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig');
});
// State 2: submission
$app->post('/login', function() use ($app, $log) {
    $name = $app->request->post('name');
    $passport = $app->request->post('passport');
    $password = $app->request->post('password');
    $user = DB::queryFirstRow("SELECT * FROM passenger WHERE passport=%s", $passport);    
    if (!$user) {
        $log->debug(sprintf("User failed for passport %s from IP %s",
                    $passport, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        if ($user['password'] == $password) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s",
                    $user['ID'], $_SERVER['REMOTE_ADDR']));
            //Show the login creation
            $app->render('login_success.html.twig', 
                     array(
            'name' => $name,           
            'passport' => $passport
                    ));            
            
        } else {
            $log->debug(sprintf("User failed for passport %s from IP %s",
                    $passport, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));            
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['user'] = array();
    $app->render('logout_success.html.twig');
});

// State 1: first show
$app->get('/book', function() use ($app, $log) {
    $app->render('book.html.twig');
});
// State 2: submission
$app->post('/book', function() use ($app, $log) {
    $name = $app->request->post('name');
    $passport = $app->request->post('passport');
    $from = $app->request->post('from');
    $to = $app->request->post('to');
    $valueList = array ('name' => $name, 'passport' => $passport);
    // submission received - verify
    $errorList = array();
    //from/to check: 3 uppercase characters
    if ((!preg_match('/[A-Z]{3}/', $from) || (!preg_match('/[A-Z]{3}/', $to)))){
        array_push($errorList, "Airports must be made of 3 uppercase letters.");
    }    
    //TODO: CREATE A JOIN    
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('booking.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('bookings', array(
            'fromAirport' => $fromAirport, 'toAirport' => $toAirport
        ));
        $id = DB::insertId();
        $log->debug(sprintf("Booking %s created", $id));
        
        //Show the booking creation
        $app->render('booking_success.html.twig', 
                array(
            'name' => $name,           
            'passport' => $passport
        ));
    }
});


$app->run();
