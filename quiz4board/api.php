<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'quiz4board';
DB::$user = 'quiz4board';
DB::$password = 'vFjZftMRmV493RCQ';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die; // don't want to keep going if a query broke
}

$app = new \Slim\Slim();

\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+',
    'sellerName' => '[A-Za-z-]+'
));

$app->response->headers->set('content-type', 'application/json');

function isMessageValid($message, &$error, $skipID = FALSE) {
       
    if (!$skipID) {
        if ((!isset($message['ID']) || (!is_numeric($message['ID'])))) {
            $error = 'ID must be provided and must be a number.';
            return FALSE;
        }
    }
    if (!isset($message['sellerName']) || !isset($message['description']) || !isset($message['price'])) {
        $error = 'The passed fields do not correspond to the expected list.';
        return FALSE;
    }
    
    //sellerName check: must be between 1 and 50 characters
    if (strlen($message['sellerName']) < 1 || strlen($message['sellerName']) > 50) {
        $error = 'Seller name must be between 1 and 50 characters.';
        return FALSE;
    }
    
    //description check: must be between 5 and 500 characters    
    if (strlen($message['description']) < 5 || strlen($message['description']) > 500) {
        $error = 'Description must be between 5 and 500 characters.';
        return FALSE;
    }
    
    //price must be valid floating point and between 0$ & 99 999 999$
    if ((!is_numeric($price)) ||
            (strlen($price) < 1) || (strlen($price) > 10) ||
            ($price < 0) || ($price >= 10000000000)) {        
        $error = 'Price must be between 0$ and 99 999 999.99 $.';
        return FALSE;
    }  
    
    //In case seller did pass validation testing
    return TRUE;
}

//GET
$app->get('/messages', function() {
    $adList = DB::query("SELECT * FROM messages");
    echo json_encode($adList, JSON_PRETTY_PRINT);
});

$app->get('/messages/:ID', function($ID) use ($app) {
    $record = DB::queryFirstRow("SELECT * FROM messages WHERE ID=%d", $ID);
    // 404 if record not found
    if (!$record) {
        $app->response->setStatus(404);
        echo json_encode("Record not found.");
        return;
    }
    echo json_encode($record, JSON_PRETTY_PRINT);
});
//POST
$app->post('/messages', function() use ($app, $log) {
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    if (!isTodoItemValid($record, $error, TRUE)) {
        $app->response->setStatus(400);
        $log->debug("POST /todoitems verification failed: " . $error);
        echo json_encode($error);
        return;
    }
    DB::insert('messages', $record);
    echo DB::insertId();
    // POST / INSERT is special - returns 201
    $app->response->setStatus(201);
});

//DELETE
$app->delete('/messages/:ID', function($ID) {
    DB::delete('messages', "ID=%d", $ID);
    echo 'true';
});

$app->run();