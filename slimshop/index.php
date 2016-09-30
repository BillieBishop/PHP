<?php

session_start();

//enable on-demand class loader
require_once 'vendor/autoload.php';

//Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'slimshop';
DB::$user = 'slimshop';
DB::$password = 'bSfjSf6ufGLChEq8';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: ".$params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query breaks
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: ".$params['error']);
    $log->error(" in query: ".$params['query']);
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

//Global Conditions
\Slim\Route::setDefaultConditions(array(
    'id' =>'\d+',
    'name' => '[A-Za-z-]+'
));

//Check if user is in session
if(!isset($_SESSION['user'])){
    $_SESSION['user']=array();
}

$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');

$app->get('/', function ()use ($app) {
    $productList = DB::query('SELECT * FROM products');
    $app->render('index.html.twig', 
            array('productList' => $productList,
            array('sessionUser' => $_SESSION['user'])    
                ));
});

$app->get('/emailexists/:email', function($email) use ($app, $log){
    $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
    if($user){
        echo "Email already registered";
        }
        
});


//////////////////////////////////////////////////////////////////////////////
//Sate 1: First show REGISTER
$app->get('/register', function() use ($app, $log){
    $app->render('register.html.twig');
});

//State 2: Submission REGISTER (function($id='')means 'with optional parameter'
$app->post('/register(/:id)', function($id='') use ($app, $log){
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $password2 = $app->request->post('password2');
    $valueList = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password' => $password
        );
    
    $errorList = array();

    //name check: must be 50 characters long max
    if ((strlen($name) < 1) || (strlen($name) > 50)) {
        array_push($errorList,
                "Name must be between 1 and 50 characters long.");
        unset($valueList['name']);
    }
    
    //email check: must be 250 characters long max
    if ((strlen($email) < 1) || (strlen($email) > 250)) {
        array_push($errorList,
                "Email must be between 1 and 250 characters long.");
        unset($valueList['email']);
    }
    
    //password check: must be 50 characters long max (8 min)
    if ((strlen($password) < 8) || (strlen($password) > 50)) {
        array_push($errorList,
                "Password must be between 8 and 50 characters long.");
        unset($valueList['password']);
    }
    
    //email check: looks like a valid email    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList,
                "It doesn't look like a valid email.");        
        unset($valueList['contactEmail']);
    }else{
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    
    //password check: REGEX
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    
    //password check: both passwords must be the same
    if (!$password == $password2){
        array_push($errorList,
                "Both passwords must be the same.");        
        unset($valueList['password']);
        unset($valueList['password2']);
    }    
    
    //List of errors
    if ($errorList) {
        //State 3: Failed submission
        $app->render('register.html.twig', array(
            'errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        //State 2: Successful submission
        //inserting into database
        if($id===''){
        DB::insert('users', 
                array(
            'name' => $name,
            'email' => $email,
            'password' => hash('sha256', $password)//////////////////*********
        ));
        $id=DB::insertId();
        $log->debug("User created with ID=".$id);
        }
        //Show the registration creation
        $app->render('register_success.html.twig', 
                array(
            'name' => $name,           
            'email' => $email
        ));
    }
});

/////////////////////////////////////////////////////////////////////////////
//State 1: First show LOGIN
$app->get('/login', function() use ($app, $log){
    $app->render('login.html.twig');
});

//State 2: Submission LOGIN
$app->post('/login(/:id)', function($id='') use ($app, $log){ 
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $name = $app->request->post('name');
    $valueList = array(       
        'email' => $email,
        'password' => $password       
        );
    //queryFirstRow & queryOneRow do the same
    $sql=DB::queryOneRow("SELECT * FROM users WHERE email=%s", $email);
    if(!$sql){
        $app->render("login_notfound.html.twig");        
    }else{
        //Show the registration creation
        //unset($user['password']);
        //$_SESSION['user']=$user;
        $log->debug("User login with ID=". $id."From IP:".$_SERVER['REMOTE_ADDR']);
        $app->render('login_success.html.twig', array(
            'name' => $sql['name'])
        );
    }
});

//////////////////////////////////////////////////////////////////////////////
//Logout
$app->get('/logout', function() use ($app, $log){
    if($_SESSION['user']){
    unset($_SESSION['user']);
    }
    $app->render('logout_success.html.twig');
});
    
//////////////////////////////////////////////////////////////////////////////
//Sate 1: First show ADD PRODUCT
$app->get('/addproduct', function() use ($app, $log){
    $app->render('addproduct.html.twig');
});

//State 2: Submission ADD PRODUCT
$app->post('/addproduct(/:id)', function($id='') use ($app, $log){
    $name = $app->request->post('name');
    $description = $app->request->post('description');
    $imagePath = $app->request->post('imagePath');
    $price = $app->request->post('price');
    $valueList = array(
        'name' => $name,
        'description' => $description,
        'imagePath' => $imagePath,
        'price' => $price
        );
    
    $errorList = array();

    //name check: must be 100 characters long max
    if ((strlen($name) < 1) || (strlen($name) > 100)) {
        array_push($errorList,
                "Name must be between 1 and 100 characters long.");
        //unset($valueList['name']);
    }
    
    //description check: must be 500 characters long max
    if ((strlen($description) < 1) || (strlen($description) > 500)) {
        array_push($errorList,
                "Description must be between 1 and 500 characters long.");
        //unset($valueList['description']);
    }
    
    //imagePath check: must be 250 characters long max
    if ((strlen($imagePath) < 1) || (strlen($imagePath) > 250)) {
        array_push($errorList,
                "Image path must be between 1 and 250 characters long.");
        //unset($valueList['imagePath']);
    }
    
    //price check: must be 10 characters long max 
    if ((strlen($price) < 1) || (strlen($price) > 10)) {
        array_push($errorList,
                "Price must be between 1 and 10 decimals long.");
        //unset($valueList['price']);
    }
    
    //price check: price must be numbers
    if (!is_numeric($price)) {
        array_push($errorList,
                "Price must be numbers.");
        unset($valueList['price']);
    } 
    
    //TODO: Image path checks!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    
    //List of errors
    if ($errorList) {
        //State 3: Failed submission
        $app->render('addproduct_notfound.html.twig', array(
            'errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        //State 2: Successful submission
        //inserting into database
        if($id===''){
        DB::insert('products', 
                array(
        'name' => $name,
        'description' => $description,
        'imagePath' => $imagePath,
        'price' => $price
        ));
        $id=DB::insertId();
        $log->debug("Product created with ID=".$id);
        }
        //Show the product creation
        $app->render('addproduct_success.html.twig', 
                array(
            'name' => $name,           
            'price' => $price
        ));
    }
});

$app->run();