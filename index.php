<?php
//turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require autoload file
require_once('vendor/autoload.php');
require_once('model/validation-functions.php');

//session start
session_start();

//create instance of the base class
$f3 = Base::instance();

//Set debug level
$f3->set('DEBUG', 3);

$f3->set('colors', array('pink', 'green', 'blue'));

//define a default route
$f3->route('GET /', function(){
    $view = new Template();
//    echo $view->render('views/home.html');
    echo "<h1>MY PETS</h1>";
    echo "<a href = 'order'>Order a Pet</a>";
});

$f3->route('GET|POST /order', function($f3){
    session_unset();

    if (isset($_POST['animal'])){
        $animal = $_POST['animal'];

        if (validName($animal)) {
//            $_SESSION['animal'] = $animal;

            if ($animal == "dog") {
                $animal = new dog($animal);
            } else if ($animal == "cat") {
                $animal = new cat($animal);
            } else {
                $animal = new pet($animal);
            }

            $_SESSION['animal'] = $animal;

            $f3->reroute('/order2');
        } else {
            $f3->set("errors['animal']", "Please enter an animal.");
        }
    }

    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('GET|POST /order2',
    function($f3) {

        if (isset($_POST['submit'])) {
            $color = $_POST['color'];
            if (validColor($color)) {
                $_SESSION['animal']->setColor($color);
                $f3->reroute('/results');
            } else {
                $f3->set("errors['color']", "Please select a color.");
            }
        }

        $template = new Template();
        echo $template->render('views/form2.html');
    });

$f3->route('GET /results', function (){
    $view = new Template();
    echo $view->render('views/results.html');
});

//run fat free
$f3->run();