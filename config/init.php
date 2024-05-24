<?php

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/database.php';

use Application\Router;
use Config\Database;
use Utils\Env;

try {
    Env::load(__DIR__ . '/../.env');

    $mode = getenv('APP_MODE') ?: 'production';

    if ($mode === 'development') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    $connection = Database::getConnection();

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    $router = new Router();
    $router->addRoute('GET', '/', 'Controllers\HomeController', 'index');
    $router->addRoute('POST', '/migrate', 'Controllers\MigrationController', 'migrate'); // TODO: Temporal, delete this line
    $router->addRoute('POST', '/seeder', 'Controllers\SeederController', 'seed'); // TODO: Temporal, delete this line
    $router->addRoute('POST', '/login', 'Controllers\AuthController', 'login');

    $router->addRoute('GET', '/topics', 'Controllers\TopicController', 'index');
    $router->addRoute('POST', '/topics', 'Controllers\TopicController', 'store');
    $router->addRoute('PUT', '/topics/{id}', 'Controllers\TopicController', 'update');
    $router->addRoute('DELETE', '/topics/{id}', 'Controllers\TopicController', 'delete');

    $router->addRoute('GET', '/movies', 'Controllers\MovieController', 'index');
    $router->addRoute('GET', '/movies/topic/{id}', 'Controllers\MovieController', 'findByIdTopic');
    $router->addRoute('POST', '/movies', 'Controllers\MovieController', 'store');
    $router->addRoute('GET', '/movies/findByIdMovie/{id}', 'Controllers\MovieController', 'findByIdMovie');
    $router->addRoute('PUT', '/movies/{id}', 'Controllers\MovieController', 'update');
    $router->addRoute('DELETE', '/movies/{id}', 'Controllers\MovieController', 'delete');

    //client
    $router->addRoute('GET', '/clients', 'Controllers\ClientController', 'index');
    $router->addRoute('GET', '/clients/findById/{id}', 'Controllers\ClientController', 'findById');
    $router->addRoute('POST', '/clients', 'Controllers\ClientController', 'store');
    $router->addRoute('PUT', '/clients/{id}', 'Controllers\ClientController', 'update');
    $router->addRoute('DELETE', '/clients/{id}', 'Controllers\ClientController', 'delete');

    //LoanMovie
    $router->addRoute('GET', '/loanMovies', 'Controllers\LoanMovieController', 'index');
    $router->addRoute('POST', '/loanMovies', 'Controllers\LoanMovieController', 'store');
    $router->addRoute('PUT', '/loanMovies/{id}', 'Controllers\LoanMovieController', 'update');
    $router->addRoute('DELETE', '/loanMovies/{id}', 'Controllers\LoanMovieController', 'delete');

    //ReturnMovie
    $router->addRoute('GET', '/returnMovies', 'Controllers\ReturnMovieController', 'allReturnMovie');
    $router->addRoute('POST', '/returnMovies', 'Controllers\ReturnMovieController', 'store');
    $router->addRoute('PUT', '/returnMovies/{id}', 'Controllers\ReturnMovieController', 'update');
    $router->addRoute('DELETE', '/returnMovies/{id}', 'Controllers\ReturnMovieController', 'delete');
    // Statistics
    $router->addRoute('GET', '/statistics', 'Controllers\StatisticsController', 'index');

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

    $response = $router->handleRequest($requestMethod, $requestUri);

    if ($response === false) {
        http_response_code(404);
    } else {
        echo $response;
    }
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
