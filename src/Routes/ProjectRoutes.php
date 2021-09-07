<?php

use Slim\App;

$app->post('/project/create-one-author', \App\Controllers\ProjectController::class . ':createOneAuthor');
$app->post('/project/create-two-authors', \App\Controllers\ProjectController::class . ':createTwoAuthors');
$app->post('/project/upload-register-form', \App\Controllers\ProjectController::class . ':uploadRegisterForm');
$app->post('/project/get-info-one-author', \App\Controllers\ProjectController::class . ':getInfoOneAuthor');
$app->post('/project/get-info-two-authors', \App\Controllers\ProjectController::class . ':getInfoTwoAuthors');
