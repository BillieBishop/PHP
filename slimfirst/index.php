<?php
//enable on-demand class loader
require_once 'vendor/autoload.php';

DB::$dbName = 'ipd8slimfirst';
DB::$user = 'ipd8slimfirst';
DB::$password = 'H3uxQHJZxFNWn7Ay';
//DB::$host = '127.0.0.1'; //sometimes needed on mac OSX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler='nonsql_error_handler';
 
function sql_error_handler($params) {
  echo "Error: " . $params['error'] . "<br>\n";
  echo "Query: " . $params['query'] . "<br>\n";
  die; // don't want to keep going if a query broke
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

//Global Conditions
\Slim\Route::setDefaultConditions(array(
    'name' =>'[A-Za-z-]+'
));

$app->get('/', function ()use ($app){
    echo "Welcome to slim.";
    $adList = DB::query('SELECT * FROM ad');
    $app->render('index.html.twig', array('adList' => $adList));
});


$app->post('/postadform', function() use ($app){
    $name = $app->request->post('name');
    $age = $app->request->post('age');
    $valueList=array('name'=>$name, 'age'=>$age);
    $errorList = array();
    if(strlen($name) <2){
        array_push($errorList, "Name must be at least 2 characters long.");
        unset($valueList['name']);
    }
    if ($age==""){
           array_push($errorList, "Age must be provided.");
    }    
    if(($age<0)||($age>150)){
        array_push($errorList, "Age must be between 0 and 150.");
        unset($valueList['age']);
    }
    if($errorList){
        //State 3: failed submission
        $app->render('postadform.html.twig', 
                array('errorList'=>$errorList, 
                    'v'=>$valueList
                ));
    }else{
        //State 2:successful submission
        $app->render('sayhello_success.html.twig', array('name'=>$name, 'age'=>$age));
    }    
});



$app->run();