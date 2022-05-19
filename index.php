<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary autoload file
require_once('vendor/autoload.php');
//require_once ('model/data-layer.php'); //don't need after added to composer.json
//require_once ('model/validation.php'); //don't need after added to composer.json
//require_once ('classes/order.php'); //don't need after added to composer.json

//Start a session-has to come before any HTML OUTPUT
session_start();

//Test Order Class
/*$order = new Order();
$order->setFood("tacos");
$order->setMeal("lunch");
$order->setCondiments("salsa, guacamole");
var_dump($order);*/

//Create an instance of the Base Class
$f3 = Base::instance();

//Create an instance of the Controller class
$con = new Controller($f3);

//Define a default route
$f3->route('GET|POST /', function() {
    //global $con;
    //$con->home();
    //or
    $GLOBALS['con']->home();

    //$view = new Template();
    //echo $view->render('views/home.html');
}
);

//Define a breakfast route
$f3->route('GET|POST /breakfast', function() {
    $view = new Template();
    echo $view->render('views/breakfast.html');
}
);

//Define a lunch route
$f3->route('GET|POST /lunch', function() {
    $view = new Template();
    echo $view->render('views/lunch.html');
}
);

//Define a dinner route
$f3->route('GET|POST /dinner', function()
{
    $view = new Template();
    echo $view->render('views/dinner.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a order route
$f3->route('GET|POST /order', function($f3) {
    $GLOBALS['con']->order();
});

//Define a order2 route
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['con']->order2();
}
);

//Define a order2 route
$f3->route('POST|GET /summary', function() {
    $GLOBALS['con']->summary();
}
);

//Run fat free
$f3->run();