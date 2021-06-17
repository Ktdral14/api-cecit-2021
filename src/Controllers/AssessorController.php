<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class AssessorController extends BaseController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    
    public function create(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}
