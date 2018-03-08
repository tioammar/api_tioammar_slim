<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'model/Name.php';
require 'modules/BlogController.php';

$app = new \Slim\App;

$app->get('/test', function (Request $request, Response $response){
  $name = new Name();
  return $response->write($name->responses());
});

$app->get('/{count}', function (Request $request, Response $response){
  $blogController = new BlogController();
  $count = $request->getAttribute("count");
  return $response->write($blogController->get(BlogController::ALL, $count));
});

$app->get('/id/{id}', function (Request $request, Response $response){
  $blogController = new BlogController();
  $id = $request->getAttribute("id");
  $count = null;
  return $response->write($blogController->get(BlogController::SINGLE, $count, $id));
});

$app->run();
?>