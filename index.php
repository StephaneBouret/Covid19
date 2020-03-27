<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'Model/Model.php';
include 'View/View.php';

include 'Controller/Controller.php';
include 'Controller/CountryController.php';
// include 'Controller/UserController.php';
// include 'Controller/SecurityController.php';

if (isset($_GET['controller'])) {
    $controllerStart = ucfirst($_GET["controller"]) . "Controller";
} else {
    $controllerStart = 'CountryController';
}

$controller = new $controllerStart();

if (isset($_GET['action'])) {
    $action = $_GET["action"];
} else {
    $action = 'list';
}

$controller->$action();